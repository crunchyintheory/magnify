<?php
    function nav_curpage($url) {
        if($url == current_url()) echo "active";
    }
?>
<nav class="nav flex-column nav-pills">
    <a class="nav-link <?php nav_curpage($baseurl.'swarmbot')?>" href="<?php echo $baseurl?>swarmbot">SwarmBot</a>
        <a class="nav-link sub <?php nav_curpage($baseurl.'swarmbot/status')?>" href="<?php echo $baseurl?>swarmbot/status">Status</a>
        <a class="nav-link sub <?php nav_curpage($baseurl.'swarmbot/console')?>" href="<?php echo $baseurl?>swarmbot/console">Console</a>
</nav>