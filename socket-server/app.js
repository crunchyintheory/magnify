const http = require('http').Server();
const io = require('socket.io')(http);
const port = 3000;

const config = [
    {
        namespace: 'swarmbot',
        rooms: [
            {
                name: 'console',
                consoleData: [{message: 'message', level: 'DEBUG'}],
                onJoin: function(socket, r) {
                    socket.emit('console', r.consoleData);
                }.bind(this)
            }
        ],
        onConnection: (socket, mod, r) => {
            socket.on('console log', function (json) {
                r.consoleData.push(json);

                while (r.consoleData.length > 200) {
                    r.consoleData.shift();
                }

                io.of(`/${mod.namespace}`).in('console').emit('log', [json]);
            });
        }
    }
];

config.forEach((mod) => {
    mod.rooms.forEach(function(room) {
        if(room.init) room.init(this);
    }.bind(mod));
    io.of(mod.namespace).on('connection', function (socket) {
        socket.on('join', (data) => {
            let r = mod.rooms.find(function(x) { return this == x.name; }.bind(data));
            if(r) {
                socket.join(data);
                mod.onConnection(socket, mod, r);
                r.onJoin(socket, r);
            }
            else {
                console.log('Connection Refused');
            }
        });
    });
});

http.listen(port, function() {
    console.log(`listening on *:${port}`);
});