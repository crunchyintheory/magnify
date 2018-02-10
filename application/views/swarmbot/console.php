<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main class="center">
    <h1>Console</h1>
    <section class="console bg-light border border-dark" id="console">
    </section>
    <aside class="buttons">
        <a href="json/download">
            <button type="button" class="btn btn-primary">Export to JSON</button>
        </a>
        <a href="text/download">
            <button type="button" class="btn btn-primary">Export to Text</button>
        </a>
    </aside>
    <script src="//<?php echo $_SERVER['HTTP_HOST'] ?>:3000/socket.io/socket.io.js" rel="text/javascript"></script>
    <script>
        $(document).ready(function() {
            console.log('foo');
            let ns = 'swarmbot';
            let mod = 'console';

            var socket = io(`<?php echo $_SERVER['HTTP_HOST'] ?>:3000/${ns}`);
            socket.emit('join', mod);

            socket.on('console', function (data) {
                removeChildren(0);
                parseConsoleJSON(data);
            });
            socket.on('log', function (data) {
                parseConsoleJSON(data);
            });
            socket.on('disconnect', function (data) {
                log('Disconnected from server');
            });
            socket.on('reconnect', function (data) {
                socket.emit('join', mod);
                log('Reconnected to server');
            })
            socket.on('error', function (data) {
                log(`Error: ${data}`);
            })
            function parseConsoleJSON(json) {
                if (json === null) {
                    throw new Error('Unable to parse console JSON');
                } else {
                    let con = $('#console');
                    for (var i = 0; i < json.length; i++) {
                        let span = document.createElement('span');
                        span.className = `console-line console-${json[i].level.toLowerCase()}`;
                        span.innerText = ` ${json[i].message}`;
                        let levelSpan = document.createElement('span');
                        levelSpan.className = `console-line-level console-${json[i].level.toLowerCase()}-level`;
                        if(json[i].level == 'WebSocket') levelSpan.innerText = json[i].level;
                        else levelSpan.innerText = json[i].level.substring(0, 3);
                        span.prepend(levelSpan);
                        con.append(span);
                    }
                    if (con.childElementCount > 200) {
                        removeChildren(50);
                    }
                }
            }
            function log(msg) {
                parseConsoleJSON([{message: msg, level: 'WebSocket'}])
            }
            function removeChildren(len) {
                let con = $('#console')
                let num = con.childElementCount;

                for (var i = 0; i < num - len; i++) {
                    con.removeChild(con.children[0]);
                }
            }
        })
    </script>
</main>