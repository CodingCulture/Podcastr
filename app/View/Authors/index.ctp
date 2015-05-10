<h2><?php echo __('Authors');?></h2>
<hr />
<div class="row">
    <div class="col-md-9">
        <?php foreach($authors as $author){;?>
            <div class="row">
                <div class="col-md-2"><img src="<?php echo $author["Author"]["profile_image"];?>" class="img-circle" width="120px"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-8">
                            <p><strong><?php echo $author["Author"]["name"];?> <?php echo $author["Author"]["surname"];?></strong></p>
                        </div>
                        <div class="col-md-4 right">
                            <?php echo $this->Html->link(__('Edit'),array('controller' => 'authors', 'action' => 'edit', $author["Author"]["id"]));?> | <?php echo $this->Html->link(__('Remove'), array('controller' => 'authors', 'action' => 'delete', $author["Author"]["id"]));?>
                        </div>
                    </div>
                    <p><?php echo $author["Author"]["bio"];?></p>

                </div>
            </div>
            <hr />
        <?php } ?>
    </div>
    <div class="col-md-3">
        <ul class="nulled">
            <li><?php echo $this->Html->link(__('Add an author'), array('controller' => 'authors', 'action' => 'add'));?></li>
            <li><?php echo $this->Html->link(__('Documentation'), array('controller' => 'docs', 'action' => 'authors'));?></li>
        </ul>
    </div>
</div>