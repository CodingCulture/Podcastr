<?php echo $this->Html->css('admin');?>
<header style="background-color: #808080;">
    <div class="container">
        <div class="logosmall"><a href="/"><img src="<?php echo $logo;?>" width="100%"></a></div>
        <div class="pull-left">
            <ul class="header-admin">
                <li><a href="/pages/about">Over</a></li>
                <li><?php echo $this->Html->link(__('Podcast'), array('controller' => 'podcasts', 'action' => 'index'));?></li>
                <li><?php echo $this->Html->link(__('Videos'), array('controller' => 'videos', 'action' => 'index'));?></li>
            </ul>
        </div>
        <div class="pull-right">
            <ul class="header-admin">
                <li><a href="https://plus.google.com/105563955921753026445" rel="publisher">Google+</a></li>
                <li><a href="https://www.facebook.com/gamehourpodcast">Facebook</a></li>
                <li><a href="https://twitter.com/GamehourBE">Twitter</a></li>
            </ul>
        </div>
        <div class="logo"><a href="/"><img src="<?php echo $logo;?>" width="150px"></a></div>
    </div>
</header>