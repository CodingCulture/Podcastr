<?php echo $this->Html->script('charts');?>
<script>
    $(document).ready(function(){
        var itunes =  document.getElementById('itunes').getContext('2d');
        var itunesData = {
            labels : ["<?php echo substr(htmlentities($stats[4]["Podcast"]["title"]), 0, $graphLength);?>","<?php echo substr(htmlentities($stats[3]["Podcast"]["title"]), 0, $graphLength);?>","<?php echo substr(htmlentities($stats[2]["Podcast"]["title"]), 0, $graphLength);?>","<?php echo substr(htmlentities($stats[1]["Podcast"]["title"]), 0, $graphLength);?>","<?php echo substr(htmlentities($stats[0]["Podcast"]["title"]), 0, $graphLength);?>"],
            datasets : [
                {
                    fillColor : "rgba(172,194,132,0.4)",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [<?php echo $stats[4]["Stat"]["itunes"];?>,<?php echo $stats[3]["Stat"]["itunes"];?>,<?php echo $stats[2]["Stat"]["itunes"];?>,<?php echo $stats[1]["Stat"]["itunes"];?>,<?php echo $stats[0]["Stat"]["itunes"];?>]
                }
            ]
        }
        new Chart(itunes).Line(itunesData);
    })
</script>

<h2>Hello <?php echo $this->Session->read('Auth.User.Author.name');?></h2>
<div class="row">
    <div class="col-md-8">
        <div class="well note">
            <?php echo $note["Note"]["content"];?>
            <p><?php echo $this->Html->link('Edit note', array('controller' => 'notes', 'action' => 'edit'));?></p>
        </div>

        <h3>iTunes downloads (laatste vijf)</h3>
        <canvas id="itunes" width="750" height="400"></canvas>

        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">

            </div>
        </div>


    </div>
    <div class="col-md-4">
        <div class="well">
            <ul class="nulled">
                <li><?php echo $this->Html->link('Add a podcast', array('controller' => 'podcasts', 'action' => 'add'));?></li>
                <li><?php echo $this->Html->link('Edit prep', array('controller' => 'notes', 'action' => 'collab'));?>  |  <?php echo $this->Html->link('View prep', array('controller' => 'notes', 'action' => 'linkDump'));?> </li>
                <li><a href="http://mail.zoho.com">Read mail</a></li>
                <li><a href="https://www.google.com/analytics/web/?hl=nl&pli=1#home/a56987170w90558498p94224812/">View Analytics</a></li>
                <li><a href="http://tools.gamehour.be/chronos">Chronos</a></li>
            </ul>
        </div>

        <div class="well" style="text-align: center;">
            <h3>iTunes General</h3>
            <div class="row">
                <div class="col-md-6">
                    <h4><?php echo $general["total"];?></h4>
                    <small>Totale downloads</small>
                </div>
                <div class="col-md-6">
                    <h4><?php echo $general["highest"]["count"];?></h4>
                    <small>Populairste podcast<br /><?php echo $this->Html->link($general["highest"]["Podcast"]["Podcast"]["title"], array('controller' => 'podcasts', 'action' => 'listen',$general["highest"]["Podcast"]["Podcast"]["id"]));?></small>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <h4><?php echo $general["median"];?></h4>
                    <small>Gemiddelde downloads</small>
                </div>
                <div class="col-md-6">
                    <h4><?php echo $general["lowest"]["count"];?></h4>
                    <small>Minst populaire podcast<br /><?php echo $this->Html->link($general["lowest"]["Podcast"]["Podcast"]["title"], array('controller' => 'podcasts', 'action' => 'listen',$general["lowest"]["Podcast"]["Podcast"]["id"]));?></small>
                </div>
            </div>
        </div>
    </div>
</div>
