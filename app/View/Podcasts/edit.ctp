<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
<?php echo $this->Html->script('toc');?>
<script>
        var json = <?php if(strlen($podcast["Podcast"]["toc"]) <= 0){ echo "\"\"";} else { echo $podcast["Podcast"]["toc"];};?>;
</script>
<h2><?php echo $podcast["Podcast"]["title"];?><small> aanpassen</small></h2>
<div class="row">
    <div class="col-md-6">
        <?php echo $this->Form->create('Podcast', array('type' => 'file', 'url' => array('controller' => 'Podcasts', 'action' => 'edit', $podcast["Podcast"]["id"])));?>
            <?php echo $this->Form->input('title', array('label' => __('Title'), 'type' => 'text', 'class' => 'form-control', 'value' => $podcast["Podcast"]["title"]));?>
            <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control mceEditor', 'value' => $podcast["Podcast"]["description"]));?>
        <div class="input textarea" id="tocText">
            <label for="PostcastDescription"><?php echo __('Table of contents');?></label>
            <?php echo $this->Form->textarea('toc', array('class' => 'form-control', 'value' => $podcast["Podcast"]["toc"],  'style' => 'max-width: 100%; min-width: 100%; height: 100px; display: none;'));?>
            <div class="toc-wrapper">
                <div class="toc-controls">
                    <div class="container-fluid">
                        <div class="pull-left"><a onClick="tocAddRow()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></div>
                        <div class="pull-right"><a onClick="tocPaste()">Paste JSON</a></div>
                    </div>
                </div>
                <div class="toc-entries">

                </div>
            </div>
        </div>
            <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?>
        <?php echo $this->Form->end();?>
    </div>
    <div class="col-md-6">
        <img class="img-rounded" src="<?php echo $podcast["Podcast"]["image"];?>" width="100%"/>
        <hr />
        <h3>Mp3 data</h3>
        <ul class="nulled">
            <li><strong>Mysql id:</strong> <?php echo $podcast["PodcastFile"]["id"];?></li>
            <li><strong>Location:</strong> <?php echo $podcast["PodcastFile"]["path"];?></li>
            <li><strong>iTunes Downloads:</strong> <?php echo $podcast["Stat"]["itunes"];?></li>
        </ul>
    </div>
</div>