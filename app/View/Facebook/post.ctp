<?php if(isset($fbObject)){?>

    <div class="loader" style="width: 100%; padding: 20rem; text-align: center;">
        <div class="loader-content">
            <?php echo $this->Html->image('ajax-loader.gif');?>
            <h3>Posting to Facebook</h3>
            <h4>Please follow the steps in the pop-up</h4>
        </div>
    </div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '<?php echo $fbSettings["appId"];?>',
                xfbml      : true,
                version    : 'v2.1',
                status     : 'true'
            });

            FB.login(function(){

                var accessToken = "null";
                FB.api(
                    "/me/accounts", function(response) {
                        accessToken = jQuery.map(response.data, function(obj) {
                            if(obj.id == "<?php echo $fbSettings["pageId"];?>"){
                                return obj.access_token; // or return obj.name, whatever.
                            }
                        });

                        console.log(accessToken);

                        FB.api(
                            "/<?php echo $fbSettings["pageId"];?>/feed?access_token=" + accessToken,
                            "POST",
                            <?php echo $fbObject;?>,
                            function (response) {
                                if (response && !response.error) {
                                    $('.loader-content').fadeOut(500, function(){
                                        $('.loader-content').html('<h2>Post was succesfull</h2><?php echo $this->Html->link("Post on Twitter as well", array("controller" => "Twitter", "action" => "post", $type, $id), array("class" => "btn btn-primary"));?>').fadeIn(1000);
                                    })
                                }
                            }
                        );
                    }
                );

            }, {scope: 'publish_actions,manage_pages'});
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


    </script>
<?php } else {?>
    <h2>Facebook Propagator</h2>
    <div class="row">
        <div class="col-md-9">
            <?php echo $this->Form->create('facebook');?>
            <?php echo $this->Form->input('message', array('class' => 'form-control', 'type' => 'textarea'));?>
            <?php echo $this->Form->submit('Post to Facebook', array('class' => 'btn btn-primary btn-block'));?>
            <?php echo $this->Form->end();?>
        </div>
        <div class="col-md-3">
            <div class="well">
                <?php echo __('Add a message and a caption and we\'ll post your new content to Facebook!');?>
            </div>
        </div>
    </div>
<?php } ?>