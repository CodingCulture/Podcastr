<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
<script src="https://togetherjs.com/togetherjs-min.js"></script>
<?php echo $this->Form->create('Note');?>
<?php echo $this->Form->input('content', array('type' => 'textarea', 'class' => 'form-control mceEditor', 'value' => $note["Note"]["content"]));?>
<div class="row">
    <div class="col-md-3">
        <?php echo $this->Form->submit('Save', array('class' => 'btn btn-primary fullwidth'));?>
    </div>
    <div class="col-md-3">
        <button onclick="TogetherJS(this); return false;" class="btn btn-success fullwidth">Start TogetherJS</button>
    </div>
</div>
<?php echo $this->Form->end();?>