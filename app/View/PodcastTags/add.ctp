<?php echo $this->element('admin_menu');?>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2><?php echo __('Add tag');?></h2>
        <hr />
        <?php echo $this->Form->create('PodcastTag');?>
        <?php echo $this->Form->input('name', array('label' => __('Tag'), 'class' => 'form-control'));?>
        <?php echo $this->Form->input('colour', array('label' => __('UI colour'), 'class' => 'form-control', 'type' => 'color'));?>
        <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-success fullwidth'));?>
        <?php echo $this->Form->end();?>
    </div>
    <div class="col-md-3"></div>
</div>