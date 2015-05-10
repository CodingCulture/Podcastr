<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<?php echo $this->Html->charset(); ?>
    <?php echo $this->Html->css('bootstrap.min');?>
    <?php echo $this->Html->css('gamehour');?>
    <?php echo $this->Html->css('bootstrap-multiselect');?>
    <?php echo $this->Html->script('jquery-1.11.1.min');?>
    <?php echo $this->Html->script('bootstrap.min');?>

	<title>
        GameHour
	</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300|Montserrat:400,700" rel="stylesheet" type="text/css">
</head>
<body>
    <?php if($this->Session->read('Auth.User') !== null){
        echo $this->element('header-admin');
    } else {
        echo $this->element('header');
    }?>
    <!-- Use clearfix if no image is present (homepage)-->
    <div class="clearfix"></div>
    <div class="container first-spaced">
        <?php echo $this->element('flash');?>
        <?php echo $this->fetch('content'); ?>
    </div>

    <?php echo $this->element('footer');?>
</body>
</html>
