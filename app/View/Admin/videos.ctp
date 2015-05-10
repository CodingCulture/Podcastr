<h2><?php echo __('Videos');?></h2>
<hr />
<div class="row">
    <div class="col-md-9">
        <?php foreach($videos as $video){;?>
            <div class="row">
                <div class="col-md-2"><div style="background-image: url('<?php echo $video["Video"]["image"];?>')" class="img-circle div-circle"></div></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8">
                            <p><strong><?php echo $this->Html->link($video["Video"]["title"], array('controller' => 'videos', 'action' => 'view', $video["Video"]["id"]));?> | <?php echo $video["Video"]["created"];?>  </strong></p>
                        </div>
                        <div class="col-md-4 right">
                            <?php echo $this->Html->link(__('Edit'),array('controller' => 'videos', 'action' => 'edit', $video["Video"]["id"]));?> | <?php echo $this->Html->link(__('Remove'),array('controller' => 'videos', 'action' => 'delete',$video["Video"]["id"]));?>
                        </div>
                    </div>
                    <p><?php echo strip_tags(substr($video["Video"]["description"],0,400)) . '...';?></p>
                </div>
            </div>
            <hr />
        <?php } ?>
    </div>
    <div class="col-md-3">
        <ul class="nulled">
            <li><?php echo $this->Html->link(__('View on frontend'), array('controller' => 'videos', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link(__('Add Video'), array('controller' => 'videos', 'action' => 'add'));?></li>
            <li><?php echo $this->Html->link(__('Documentation'), array('controller' => 'docs', 'action' => 'videos'));?></li>
        </ul>
    </div>
</div>