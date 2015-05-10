<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56987170-1', 'auto');
    ga('send', 'pageview');

</script>


<?php if(isset($admin)){?>
    <div class="flat">
        <div class="row">
            <div class="col-md-9"><strong><?php echo __('Howdy admin');?></strong>, <?php echo __('to manage post, you\'ll want to follow this link');?></div>
            <div class="col-md-3"><?php echo $this->Html->link(__('Post Administration'), array('controller' => 'admin', 'action' => 'posts'), array('class' => 'btn btn-success fullwidth'));?></a></div>
        </div>
    </div>
<?php } ;?>

<!-- Say Hello -->
<div class="flat">
    <div class="row">
        <div class="col-md-12"><?php echo $introduction;?></div>
    </div>
</div>

<?php if(empty($posts)){ ?>
    <div class="flat">
        <div class="row">
            <div class="col-md-12"><?php echo __('Whoa, there aren\'t any posts published yet.');?></div>
        </div>
    </div>
<?php } else {?>
    <div class="row">
        <div class="col-md-9">
            <!-- Start iterating -->
            <?php foreach($posts as $post){?>
                <article>
                    <div class="header" style="background-image: url('<?php echo $post["Post"]["image"];?>');">
                        <div class="center"><h2><?php echo $post["Post"]["title"];?></h2></div>
                    </div>
                    <div class="content">
                        <?php echo $post["Post"]["description"];?>
                    </div>
                    <div class="controls">
                        <div class="row custom">
                            <a href="<?php echo $this->base;?>/Posts/read/<?php echo $post["Post"]["id"];?>"><div class="col-md-6 control"><?php echo __('Play Online');?></div></a>
                            <a href="<?php echo $itunes;?>"><div class="col-md-6 control"><span class="blue"><?php echo __('iTunes Feed');?></span></div></a>
                        </div>
                    </div>
                </article>
            <?php } ?>

            <nav>
                <ul class="pagination">
                    <?php echo $this->Paginator->numbers(array('tag' => 'li', 'currentClass' => 'active', 'separator' => '', 'first' => true, 'currentTag' => 'a'));?>
                </ul>
            </nav>
        </div>
        <div class="col-md-3">
            <a class="twitter-timeline" href="https://twitter.com/GamehourBE" data-widget-id="535455998614732801">Tweets by @GamehourBE</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
    </div>
<?php }?>