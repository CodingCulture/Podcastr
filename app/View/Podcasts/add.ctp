<?php echo $this->Html->script('tinymce/tinymce.min');?>
<?php echo $this->Html->script('mceConfig');?>
<?php echo $this->Html->script('toc');?>
<script>var json = null;</script>
<h2>Een podcast toevoegen</h2>
<?php echo $this->Form->create('Podcast', array('type' => 'file')); ;?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->Form->input('title', array('label' => __('Title'), 'type' => 'text', 'class' => 'form-control'));?>
            <div class="input textarea">
                <label for="PostcastDescription"><?php echo __('Description');?></label>
                <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control mceEditor'));?>
            </div>
        </div>



        <div class="col-md-6">
            <?php echo $this->Form->input('mp3', array('label' => __('Podcast Mp3'), 'type' => 'file', 'class' => 'form-control', 'value' => '/files/podcasts/'));?>
            <div class="flat">
                <p><?php echo __('Read the docs about large file uploads.');?> <?php echo __('View');?> <?php echo $this->Html->link(__('this page'), array('controller' => 'docs', 'action' => 'mp3uploads'));?> <?php echo __('to learn more.');?></p>
            </div>
            <?php echo $this->Form->input('image', array('label' => __('Banner image'), 'type' => 'file', 'class' => 'form-control'));?>
            <hr />
            <div class="input textarea" id="tocText">
                <label for="PostcastDescription"><?php echo __('Table of contents');?></label>
                <?php echo $this->Form->textarea('toc', array('class' => 'form-control', 'style' => 'max-width: 100%; min-width: 100%; height: 100px; display: none;'));?>
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
            <div class="multiselect-wrapper">
                <?php echo $this->Form->hidden('authors');?>
                <div class="multiselect-label"><?php echo __('Authors');?></div>
                <select class="multiselect-authors" multiple="multiple" onChange="updateAuthors()">
                    <?php foreach($authors as $author){ ?>
                        <option value="<?php echo $author["Author"]["id"];?>"><?php echo $author["Author"]["name"];?> <?php echo $author["Author"]["surname"];?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="multiselect-wrapper">
                <div class="multiselect-label"><?php echo __('Tags');?></div>
                <?php echo $this->Form->hidden('tags');?>
                <select class="multiselect-tags" multiple="multiple" onChange="updateTags()">
                    <?php foreach($tags as $tag){ ?>
                        <option value="<?php echo $tag["PodcastTag"]["id"];?>"><?php echo $tag["PodcastTag"]["name"];?></option>
                    <?php } ?>
                </select>
            </div>
            <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary fullwidth'));?>

        </div>
    </div>
<?php echo $this->Form->end();?>
<?php echo $this->Html->script('bootstrap-multiselect');?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.multiselect-authors').multiselect({
            enableFiltering: true,
            buttonWidth: Math.floor(1170 / 2) - 30
        });

        $('.multiselect-tags').multiselect({
            enableFiltering: true,
            buttonWidth: Math.floor(1170 / 2) - 30
        });
    });

    function updateAuthors(){
        var authors = $('.multiselect-authors').val();
        authors = authors.join();
        $('#PodcastAuthors').val(authors);
    }

    function updateTags(){
        var tags = $('.multiselect-tags').val();
        tags = tags.join();
        $('#PodcastTags').val(tags);
    }
</script>
<script>

</script>
