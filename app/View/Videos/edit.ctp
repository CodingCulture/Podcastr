<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
<h2><?php echo $video["Video"]["title"];?><small> aanpassen</small></h2>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->create('Video', array('type' => 'file', 'url' => array('controller' => 'videos', 'action' => 'edit', $video["Video"]["id"])));?>
            <?php echo $this->Form->input('title', array('label' => __('Title'), 'type' => 'text', 'class' => 'form-control', 'value' => $video["Video"]["title"]));?>
            <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control mceEditor', 'value' => $video["Video"]["description"]));?>
            <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?>
        <?php echo $this->Form->end();?>
    </div>
    <div class="col-md-6">
        <img class="img-rounded" src="<?php echo $video["Video"]["image"];?>" width="100%"/>
        <hr />
        <h3>Video data</h3>
        <ul class="nulled">
            <li><strong>Mysql id:</strong> <?php echo $video["Video"]["id"];?></li>
            <li><strong>Youtube id:</strong> <?php echo $video["Video"]["youtube_id"];?></li>
        </ul>
    </div>
</div>