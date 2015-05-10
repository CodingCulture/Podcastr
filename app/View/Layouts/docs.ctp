<!DOCTYPE html>
<html>
<head>
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
<!-- Use
<!-- Use clearfix if no image is present (homepage)-->
    <div class="clearfix"></div>
    <div class="container first-spaced">
        <div class="row">
            <div class="col-md-9">
                <?php echo $this->fetch('content'); ?>
            </div>
            <div class="col-md-3">
                <?php echo $this->element('docsmenu');?>
                <?php echo $this->element('docslinks');?>
            </div>
        </div>
    </div>
</body>
</html>
