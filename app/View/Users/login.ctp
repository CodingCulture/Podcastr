<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        <div class="users form">

            <div id="jsAlert" class="alert alert-info alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span id="message"></span>
            </div>

            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend>
                    <?php echo __('Login'); ?>
                </legend>
                <?php
                    echo $this->Form->input('username', array('class' => 'form-control'));
                    echo $this->Form->input('password', array('class' => 'form-control'));
                ?>
                <?php echo $this->Form->hidden('remember_me', array('value' => '0'));?>
            </fieldset>

            <?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-primary fullwidth')); ?>
            <?php echo $this->Form->end(); ?>
            <button id="rememberMeCheck" class="btn btn-default fullwidth" style="margin: 6px 0;" onClick="changeRememberMe()">Remember me</button>
        </div>
        <hr />
        <div class="flat">
            <p><strong><?php echo __('User self checkout is disabled!');?></strong> <?php echo __('This means users can\'t reset passwords themselves. If you want to reset you password, contact the admin.');?></p>
        </div>

    </div>
    <div class="col-md-3"></div>
</div>

<script>
    function changeRememberMe(){
        var current = $('#UserRememberMe').val();

        if(current == 0){
            $('#rememberMeCheck').removeClass('btn-default').toggleClass('btn-success').html('We\'ll remember you!');
            $('#UserRememberMe').val(1);
        } else {
            $('#rememberMeCheck').removeClass('btn-success').toggleClass('btn-default').html('Remember me');
            $('#UserRememberMe').val(0);
        }

    }

    $(document).ready(function(){
        if(window.location.hash == "#loggedout"){
            $('#jsAlert #message').html('You have succesfully been logged out!');
            $('#jsAlert').fadeIn();
        }
    });
</script>