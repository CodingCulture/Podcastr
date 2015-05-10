<?php if($this->Session->check('Message.flash')):?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <?php echo $this->Session->flash(); ?>
    </div>


<?php endif;?>