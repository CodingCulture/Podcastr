<!DOCTYPE html>
<html>
    <head>
        <?php
            $filePresent = true;
            if (!file_exists('..\..\Config\database.php')) {
                $filePresent = false;
            };
        ?>

        <?php
            $podcastrinfo = fopen("..\\..\\..\\podcastr.json", "r");
            $podcastrinfo = json_decode(fread($podcastrinfo,filesize("..\\..\\..\\podcastr.json")), true);
        ;?>

        <?php

            if($_GET == null){
                $step = 1;
            } else {
                $step = $_GET["step"];
            }


        ?>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/jquery.githubRepoWidget.min.js"></script>
    </head>
    <body>

           <div class="container">
               <?php if($step == 1){;?>
               <div class="jumbotron">
                   <h2>Hello!</h2>
                   <p>
                       You've reached the installer for Podcastr, an independant and awesome tool to create and broadcast
                       your podcast easily, without being tied. You'll be installing version <?= $podcastrinfo["version"];?>.
                   </p>
                   <p>
                       You can check if this is the latest version on our Github repository, linked down below.
                   </p>
               </div>

               <div class="github-widget" data-repo="nielsvermaut/gamehour.be"></div>
               <br />
               <div class="panel panel-default">
                   <div class="panel-body text-center">
                       <h3>
                           If you are ready to install Podcastr, hit the install button!
                       </h3>
                       <a class="btn btn-default" href="?step=2"> Install </a>
                   </div>
               </div>
               <?php };?>
               <?php if($step == 2){ ;?>
                   <?php include('database.php');?>
               <?php } ;?>
               <?php if($step == 3){;?>
                   <div class="jumbotron">
                       <h2>You've installed Podcastr!</h2>
                       <p>
                           Awesome, you are part of the crew now! You can now just
                           head over to your installation and get podcasting.
                           <a href="<?php echo str_replace('/install/install.php', "", "http://" . $_SERVER["HTTP_HOST"] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]);?>">Go to you installation</a>
                       </p>
                   </div>
               <?php };?>
           </div>


    </body>
</html>