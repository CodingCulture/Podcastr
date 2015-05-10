<h2><?php echo __('Podcasts');?></h2>
<hr />
<div class="row">
    <div class="col-md-9">
        <?php foreach($podcasts as $podcast){;?>
            <div class="row">
                <div class="col-md-2"><div style="background-image: url('<?php echo $podcast["Podcast"]["image"];?>')" class="img-circle div-circle"></div></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8">
                            <p><strong><?php echo $this->Html->link($podcast["Podcast"]["title"], array('controller' => 'podcasts', 'action' => 'listen', $podcast["Podcast"]["id"]));?> | <?php echo $podcast["Podcast"]["created"];?>  </strong></p>
                        </div>
                        <div class="col-md-4 right">
                            <?php echo $this->Html->link(__('Edit'),array('controller' => 'podcasts', 'action' => 'edit', $podcast["Podcast"]["id"]));?> | <?php echo $this->Html->link(__('Remove'),array('controller' => 'podcasts', 'action' => 'delete', $podcast["Podcast"]["id"]));?>
                        </div>
                    </div>
                    <p><?php echo strip_tags(substr($podcast["Podcast"]["description"],0,400)) . '...';?></p>
                    <p>iTunes <?php echo $podcast["Stat"]["itunes"];?>  |  On-site <?php echo $podcast["Stat"]["site"];?></p>
                </div>
            </div>
            <hr />
        <?php } ?>
    </div>
    <div class="col-md-3">
        <ul class="nulled">
            <li><?php echo $this->Html->link(__('View on frontend'), array('controller' => 'podcasts', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link(__('Add Podcast'), array('controller' => 'podcasts', 'action' => 'add'));?></li>
            <li><?php echo $this->Html->link(__('Documentation'), array('controller' => 'docs', 'action' => 'podcasts'));?></li>
        </ul>
    </div>
</div>