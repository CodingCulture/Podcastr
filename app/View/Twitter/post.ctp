<div class="step-one center">
    <h3>Step One:</h3>
    <h4>Log in as your channel's Twitter account</h4>
</div>
<hr />
<div class="step-two center">

    <h3>Step Two:</h3>
    <h4>Press this nice, little button</h4>

    <a class="twitter-share-button"
       href="https://twitter.com/share"
       data-url="<?php echo $message['url']?>"
       data-text="<?php echo $message['text']?>">
        Tweet
    </a>
    <script type="text/javascript">
        window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
    </script>
</div>