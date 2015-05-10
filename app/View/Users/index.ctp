<h2><?php echo __('Users');?></h2>
<hr />
<div class="row">
    <div class="col-md-9">
        <table class="table">
            <tr><th><?php echo __('Username');?></th><td><?php echo __('Linked');?></td><th><?php echo __('Created');?></th><th><?php echo __('Actions');?></th></tr>
            <?php if(!empty($users)){ foreach($users as $user){;?>
                <tr>
                    <td><?php echo $user["User"]["username"];?></td>
                    <td><?php echo $user["Author"]["name"];?> <?php echo $user["Author"]["surname"];?></td>
                    <td><?php echo date('Y-m-d', strtotime($user["User"]["created"]));?></td>
                    <td><?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user["User"]["id"]));?>  |  <?php echo $this->Html->link(__('Remove'), array('controller' => 'users', 'action' => 'delete', $user["User"]["id"]));?></td>
                </tr>
            <?php } } ?>
        </table>
    </div>
    <div class="col-md-3">
        <ul class="nulled">
            <li><?php echo $this->Html->link(__('Add an user'), array('controller' => 'users', 'action' => 'add'));?></li>
            <li><?php echo $this->Html->link(__('Documentation'), array('controller' => 'docs', 'action' => 'users'));?></li>
        </ul>
    </div>
</div>