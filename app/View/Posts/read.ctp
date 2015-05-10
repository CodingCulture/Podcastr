<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56987170-1', 'auto');
    ga('send', 'pageview');

</script>

<script>
    var w;
    var post;

    $(document).ready(function(){
        w = soundManager.setup({
            url: '/js/lib/swf/',
            onready: function(){
                post = soundManager.createSound({
                    url: '<?php echo $post["PostFile"]["path"];?>'
                });
                console.log(post);
            }
        });
    })
</script>

<article class="single">
    <div class="header" style="background-image: url('<?php echo $post["Post"]["image"];?>');">
        <div class="container">
            <div class="center"><h2><?php echo $post["Post"]["title"];?></h2></div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <p><?php echo $post["Post"]["description"];?></p>
            <div id="disqus_thread"></div>
        </div>
    </div>
</article>

<!-- Having a table of contents is also possible thanks to .setPosition(milliseconds)-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __('Close');?></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Skip');?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo __('Skip to a certain point in the post');?></p>
                <span id="error-text"></span>
                <div class="row">
                    <div class="col-md-8 formspaced-left">
                        <form>
                            <input type="text" placeholder="<?php echo __('e.g. 02:01');?>" class="form-control" id="skip-time" onChange="validate()">
                        </form>
                    </div>
                    <div class="col-md-4 formspaced-right">
                        <a onClick="setPosition('this')" class="btn btn-warning fullwidth"><?php echo __('Skip');?></a>
                    </div>
                </div>
                <hr />
                <h4><?php echo __('Table of contents');?></h4>
                <ul class="nulled">
                    <?php
                        if(!empty($post["Post"]["toc"])){
                            $json = $post["Post"]["toc"];
                            $toc = json_decode($json, true);

                            foreach($toc as $tocItem){
                                echo '<li><a onClick="setPosition(\'' . $tocItem["timestamp"] . '\')">';
                                echo $tocItem["title"];
                                echo '<i> - ' . $tocItem["timestamp"] . '</i>';
                                echo '</a></li>';
                            }
                        } else {
                            echo __('No table of contents was set.');
                        }

                    ?>
                </ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $("#play").click(function(){
        $.post("<?php echo $this->base . "/Stats/add/post";?>", {"id": <?php echo $post["Post"]["id"];?>});
    });
</script>

</body>
</html>