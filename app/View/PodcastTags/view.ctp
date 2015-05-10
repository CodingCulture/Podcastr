<div class="tag" style="color: <?php echo $tag["PodcastTag"]["colour"];?>; border: 2px solid <?php echo $tag["PodcastTag"]["colour"];?>;"><h2><?php echo __('Everything tagged under: ');?> #<?php echo $tag["PodcastTag"]["name"];?></h2></div>

<?php foreach($podcasts as $podcast){ if(!empty($podcast)){?>
    <article>
        <div class="header" style="background-image: url('<?php echo $this->base . $podcast["Podcast"]["image"];?>');">
            <div class="center"><h2><?php echo $podcast["Podcast"]["title"];?></h2></div>
        </div>
        <div class="content">
            <?php echo nl2br($podcast["Podcast"]["description"]);?>
        </div>
        <div class="controls">
            <div class="row custom">
                <a href="<?php echo $this->base;?>/Podcasts/listen/<?php echo $podcast["Podcast"]["id"];?>"><div class="col-md-6 control"><?php echo __('Play Online');?></div></a>
                <div class="col-md-6 control"><span class="blue"><?php echo __('iTunes Feed');?></span></div>
            </div>
        </div>
    </article>
<?php } } ?>
