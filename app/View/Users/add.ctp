<?php echo $this->Html->css('user');?>

<div class="row">
    <h2><?php echo __('Add an user');?></h2>
    <?php echo $this->Form->create('User'); ?>
    <hr/>
    <div class="col-md-6">

        <div class="users form">
            <label><?php echo __('Login credentials');?></label>

            <?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => __('Username')));?>
            <?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => __('Password')));?>
            <?php echo $this->Form->submit(__('Save user'), array('class' => 'btn btn-primary fullwidth'));?>
        </div>

    </div>
    <div class="col-md-6">
        <div class="authors">
            <label><?php echo __('Connect to an author');?></label>
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

<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('users/add');?>