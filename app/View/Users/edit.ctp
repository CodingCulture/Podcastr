<?php echo $this->Html->css('user');?>
<h2><?php echo __('Edit User:');?> <?php echo $user["User"]["username"];?></h2>
<hr />
<div class="row">
    <div class="col-md-6">
        <label><?php echo __('Login Credentials');?></label>
        <?php echo $this->Form->create('User', array('novalidate' => true));?>
        <?php echo $this->Form->input('username', array('label' => __('Username'), 'class' => 'form-control', 'value' => $user["User"]["username"]));?>
        <?php echo $this->Form->input('password', array('label' => __('Password'), 'class' => 'form-control', 'value' => '', 'placeholder' => __('Unchanged')));?>
        <?php echo $this->Form->hidden('author_id', array('value' => $user["User"]["author_id"]));?>
        <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary fullwidth'));?>
    </div>
    <div class="col-md-6">
        <div class="authors">
            <label><?php echo __('Author');?></label>
            <?php echo $this->Form->hidden('author_id', array('value' => 0, 'id' => 'author_id'));?>
            <?php if(!empty($authors)){ ;?>
                <div class="authors-wrapper">
                    <?php foreach($authors as $author){ ?>
                        <div class="author" onClick="setAuthor(<?php echo $author["Author"]["id"];?>)" ">
                            <img src="<?php echo $author["Author"]["profile_image"];?>" width="100%" class="img-circle" id="image-<?php echo $author["Author"]["id"];?>">
                            <span class="name"><?php echo $author["Author"]["name"] . ' ' . $author["Author"]["surname"];?></span>
                        </div>
                    <?php } ;?>
                </div>
            <?php } else {;?>
                <div class="alert alert-warning" role="alert"><?php echo __('There aren\'t any authors defined.');?></div>
            <?php } ;?>
        </div>
    </div>
</div>

<?php echo $this->Html->script('users/edit');?>
<?php echo $this->Html->script('users/add');?>
