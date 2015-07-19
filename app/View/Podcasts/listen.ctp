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
    var podcast;

    $(document).ready(function(){
        w = soundManager.setup({
            url: '/js/lib/swf/',
            onready: function(){
                podcast = soundManager.createSound({
                    url: '<?php echo $podcast["PodcastFile"]["path"];?>'
                });
                console.log(podcast);
            }
        });
    })
</script>
<article class="single">
    <div class="header" style="background-image: url('<?php echo $podcast["Podcast"]["image"];?>');">
        <div class="container">
            <div class="center"><h2><?php echo $podcast["Podcast"]["title"];?></h2></div>
            <div class="audioplayer">

                <div class="mediacontrols">
                    <div id="play"><a onClick="play('aSound')"><img src="/img/player/play.png"></a></div>
                    <div id="pause"><a onClick="pause('aSound')"><img src="/img/player/pause.png"></a></div>
                    <div id="reset"><a onClick="restart()"><h2>Replay</h2></a></div>

                    <div id="progress" class="gamehour-progress">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        </div>
                    </div>
                    <hr/>
                    <a class="trigger-toc" data-toggle="modal" data-target="#myModal"><div id="forward"><small><?php echo __('Table of contents');?></small></div></a>
                    <span id="time"><?php echo __('Click play to start listening');?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="meta">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tags">
                    <?php foreach($tags as $tag){ ;?>
                        <a href="<?php echo $this->base . '/PodcastTags/view/' . $tag["PodcastTag"]["name"];?>">
                            <div class="tag" style="border-color: <?php echo $tag["PodcastTag"]["colour"];?>">
                                <span style="color: <?php echo $tag["PodcastTag"]["colour"];?>;">#<?php echo $tag["PodcastTag"]["name"];?></span>
                            </div>
                        </a>
                    <?php } ;?>
                </div>
                <div class="col-md-6 authors">
                    <?php foreach($authors as $author){ ?>
                        <img src="<?php echo $author["Author"]["profile_image"];?>" alt="..." class="img-circle" width="75px">
                    <?php } ;?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <p><?php echo $podcast["Podcast"]["description"];?></p>
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
                <p><?php echo __('Skip to a certain point in the podcast');?></p>
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
                        if(!empty($podcast["Podcast"]["toc"])){
                            $json = $podcast["Podcast"]["toc"];
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
</body>
</html>
