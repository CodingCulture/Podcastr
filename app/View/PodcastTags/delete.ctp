<div class="row">
    <div class="col-md-3"> </div>
    <div class="col-md-6">
        <div class="alert alert-warning" role="alert"><strong><?php echo __('Whoa!');?></strong><?php echo __('This action can not be undone');?></div>
        <div class="flat">
            <h2>Deleting an tag</h2>
            <p>Are you sure you want to delete the tag <strong><?php echo $tag["PodcastTag"]["title"];?></strong>?</p>
            <?php echo $this->Form->create('PodcastTag', array('url' => '/PodcastTags/delete/' . $tag["PodcastTag"]["id"]));?>
            <?php echo $this->Form->hidden('id', array('value' => $tag["PodcastTag"]["id"]));?>
            <?php echo $this->Form->submit(__('I am sure that I want to delete this!'), array('class' => 'btn btn-danger fullwidth spaced'));?>
            <?php echo $this->Form->end();?>
            <?php echo $this->Html->link(__('Take me away from here'), array('action' => 'index'), array('class' => 'btn btn-success fullwidth spaced'));?>
        </div>
    </div>
    <div class="col-md-3"> </div>
</div>


