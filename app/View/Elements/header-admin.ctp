<?php echo $this->Html->css('admin');?>

<header style="background-color: #808080;">
    <div class="container">
    <div class="pull-left">
        <ul class="header-admin">
            <li><a href="/admin/dashboard" alt="Dashboard"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><?php echo $this->Html->link(__('Config'), array('controller' => 'admin', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link(__('Podcasts'), array('controller' => 'admin', 'action' => 'podcasts'));?></li>
            <li><?php echo $this->Html->link(__('Videos'), array('controller' => 'admin', 'action' => 'videos'));?></li>
            <li><?php echo $this->Html->link(__('Authors'), array('controller' => 'authors', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link(__('Tags'), array('controller' => 'PodcastTags', 'action' => 'index'));?></li>
            <li></li>
        </ul>
    </div>
    <div class="pull-right">
        <ul class="header-admin">
            <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));?></li>
        </ul>
    </div>

    <div class="logo"><a href="/"><img src="<?php echo $logo;?>" width="150px"></a></div>
    </div>
</header>