<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
<h2>Een video toevoegen</h2>
<?php echo $this->Form->create('Video', array('type' => 'file')); ;?>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->input('title', array('label' => __('Title'), 'type' => 'text', 'class' => 'form-control'));?>
        <div class="input textarea">
            <label for="PostcastDescription"><?php echo __('Description');?></label>
            <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control mceEditor'));?>
        </div>
    </div>



    <div class="col-md-6">
        <?php echo $this->Form->input('image', array('label' => __('Banner image'), 'type' => 'file', 'class' => 'form-control'));?>
        <?php echo $this->Form->input('youtube_id', array('label' => __('Youtube Video ID'), 'type' => 'text', 'class' => 'form-control'));?>
        <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary fullwidth'));?>
    </div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->Html->script('bootstrap-multiselect');?>
