<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2><?php echo __('Edit an author');?></h2>
        <hr />
        <?php echo $this->Form->create('Author', array('type' => 'file'));?>
        <div class="row">
            <div class="col-md-6 formspaced-left">
                <?php echo $this->Form->input('name', array('label' => __('Name'), 'class' => 'form-control', 'value' => $author["Author"]["name"]));?>
            </div>
            <div class="col-md-6 forspaced-right">
                <?php echo $this->Form->input('surname', array('label' => __('Surname'), 'class' => 'form-control', 'value' => $author["Author"]["surname"]));?>
            </div>
        </div>
        <?php echo $this->Form->input('profile_image', array('label' => __('Profile picture'), 'class' => 'form-control', 'type' => 'file', 'placeholder' => __('Gravatar url, Facebook url or remote url'), 'value' => $author["Author"]["profile_image"]));?>
        <?php echo $this->Form->input('email', array('label' => __('Email'), 'class' => 'form-control', 'value' => $author["Author"]["email"]));?>
        <div class="input">
            <label for="AuthorBio"><?php echo __('Bio');?></label>
            <?php echo $this->Form->textarea('bio', array('class' => 'form-control', 'style' => 'min-width: 100%; max-width: 100%; height: 100px;', 'value' => $author["Author"]["bio"]));?>
        </div>
        <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-success fullwidth'));?>
        <?php echo $this->Form->end();?>
    </div>
    <div class="col-md-3"></div>
</div>