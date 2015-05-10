<script type="text/javascript" src="//cdn.sublimevideo.net/js/0ybqt6h6.js"></script>
<style>
    .sublime{
        width: 100%;
    }
</style>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56987170-1', 'auto');
    ga('send', 'pageview');

</script>

<article class="single">
    <div class="header" style="margin-bottom: 2rem; background-image: url('<?php echo $video["Video"]["image"];?>');">
        <video id="<?php echo $video["Video"]["youtube_id"];?>" class="sublime" data-settings="uid:demo-responsive-fill-resizing; autoresize:fill;" data-uid="<?php echo $video["Video"]["youtube_id"];?>" data-youtube-id="<?php echo $video["Video"]["youtube_id"];?>" preload="none" data-sharing-url="http://gamehour.be<?php echo $this->here;?>"></video>
    </div>
    <div class="container">
        <div class="content">
            <p><?php echo $video["Video"]["description"];?></p>
            <div id="disqus_thread"></div>
        </div>
    </div>
</article>

</body>
</html>