<h2><?php echo __('Tags');?></h2>
<hr />
<div class="row">
    <div class="col-md-9">
        <table class="table">
            <tr><th><?php echo __('Tag');?></th><th><?php echo __('Actions');?></th></tr>
            <?php if(!empty($tags)){ foreach($tags as $tag){;?>
                <tr>
                    <td><?php echo $tag["PodcastTag"]["name"];?></td>
                    <td><?php echo $this->Html->link(__('Remove'), array('controller' => 'PodcastTags', 'action' => 'delete', $tag["PodcastTag"]["id"]));?></td>
                </tr>
            <?php } } ?>
        </table>
    </div>
    <div class="col-md-3">
        <ul class="nulled">
            <li><?php echo $this->Html->link(__('Add a tag'), array('action' => 'add'));?></li>
            <li><?php echo $this->Html->link(__('Documentation'), array('controller' => 'docs', 'action' => 'tags'));?></li>
        </ul>
    </div>
</div>