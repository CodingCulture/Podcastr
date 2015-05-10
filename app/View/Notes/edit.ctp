<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
    <?php echo $this->Form->create('Note');?>
    <?php echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'form-control mceEditor', 'value' => $note["Note"]["content"]));?>
    <?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary'));?>
    <?php echo $this->Form->end();?>