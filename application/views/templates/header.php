<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$baseurl = base_url()
?>
<!DOCTYPE html>
<html>
        <head>
                <title>Magnify<?php if(isset($title)) echo ' &mdash; '.$title;?></title>
                <link rel="shortcut icon" href="<?php echo $baseurl?>/static/images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="<?php echo $baseurl?>/static/styles/bootstrap.css"/>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                <link rel="stylesheet" href="<?php echo $baseurl?>/static/styles/global.css"/>
        </head>
        <body>
            <?php
                if(!isset($nosidebar) || $nosidebar) {
            ?>
                <nosidebar></nosidebar>
            <?php
                }
            ?>
            <div class="wrapper">
                <div class="stripe bg-gradient"></div>
                <header class="navbar navbar-dark bg-dark">
                    <a href="<?php echo $baseurl?>" class="navbar-brand">
                        <img class="header-icon" src="<?php echo $baseurl?>/static/images/ic_appicon.svg" alt="M" width="32"/>
                        <span class="title--text">
                            Magnify
                            <?php
                                if(isset($title)) {
                            ?>
                                <span class="page-title"><?php echo $title;?></span>
                            <?php } ?>
                        </span>
                    </a>
            </header>
            <?php
                if(isset($nosidebar) && !$nosidebar) {
            ?>
                <section class="sidebar border-right border-dark bg-light">
                        <?php 
                            ob_start();
                            include('sidebar.php');
                            $buffer = ob_get_contents();
                            ob_end_clean();
                            echo $buffer;
                        ?>
                        <?php /*<ul>
                            <?php
                                foreach($sidebar as $stask) {
                            ?>
                                <li>
                                    <a href="/<?php echo $stask->name;?>"><?php echo $stask->fancyName;?></a>
                                    <?php
                                        if($stask->children) {
                                            foreach($stask->children as $subtask) {
                                    ?>
                                        <ul>
                                            <li>
                                                <a href="<?php echo $stask->name . '/' . $subtask->name?>"><?php echo $subtask->fancyName;?></a>
                                            </li>
                                        </ul>
                                    <?php
                                            }
                                        }
                                }
                            ?>
                        </ul>
                        */?>
                </section>
            <?php
                }
            ?>
            <section class="content">
                
