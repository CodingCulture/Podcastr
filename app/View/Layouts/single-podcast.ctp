<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $this->Html->charset(); ?>
    <?php echo $this->Html->css('bootstrap.min');?>
    <?php echo $this->Html->css('gamehour');?>
    <?php echo $this->Html->css('podcast');?>
    <?php echo $this->Html->script('jquery-1.11.1.min');?>
    <title>
        GameHour
    </title>
    <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300|Montserrat:400,700" rel="stylesheet" type="text/css">
    <?php if($this->name == "Podcasts"){;?>
        <meta property="og:title" content="<?php echo $podcast["Podcast"]["title"];?>" />
        <meta property="og:image" content="http://<?php echo $_SERVER["SERVER_NAME"];?><?php echo $podcast["Podcast"]["image"];?>" />
        <meta property="og:description" content="<?php echo strip_tags($podcast["Podcast"]["description"]);?>" />
        <meta property="og:url" content="http://<?php echo $_SERVER["SERVER_NAME"];?><?php echo $this->here;?>" />
        <meta property="twitter:site" content="@gamehourbe" />
    <?php };?>
</head>
<body>
<?php if($this->Session->read('Auth.User') !== null){
    echo $this->element('header-admin');
} else {
    echo $this->element('header');
}?>
<!-- Use
<!-- Use clearfix if no image is present (homepage)-->

    <?php echo $this->fetch('content'); ?>

    <?php

        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('lib/script/soundmanager2');
        echo $this->Html->script('moment');
        echo $this->Html->script('disqus');
        echo $this->Html->script('sm2');
    ?>

</body>
</html>
