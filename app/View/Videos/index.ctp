<div class="flat">
    <div class="row">
        <div class="col-md-9"><?php echo $introduction;?></div>
        <div class="col-md-3"><a href="<?php echo $youtube_link;?>" class="btn btn-primary fullwidth"><?php echo __('Subscribe on YouTube');?></a></div>
    </div>
</div>

<?php if(empty($videos)){ ?>
    <div class="flat">
        <div class="row">
            <div class="col-md-12"><?php echo __('Whoa, there aren\'t any videos published yet.');?></div>
        </div>
    </div>
<?php } else {?>
    <div class="row">
        <div class="col-md-9">
            <!-- Start iterating -->
            <?php foreach($videos as $video){?>
                <article>
                    <div class="header" style="background-image: url('<?php echo $video["Video"]["image"];?>');">
                        <div class="center"><h2><?php echo $video["Video"]["title"];?></h2></div>
                    </div>
                    <div class="content">
                        <?php echo $video["Video"]["description"];?>
                    </div>
                    <div class="controls">
                        <div class="row custom">
                            <a href="<?php echo $this->base;?>/Videos/view/<?php echo $video["Video"]["id"];?>"><div class="col-md-6 control"><?php echo __('Play Online');?></div></a>
                            <a href=""><div class="col-md-6 control"><span class="blue"><?php echo __('View on YouTube');?></span></div></a>
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
<?php } ?>