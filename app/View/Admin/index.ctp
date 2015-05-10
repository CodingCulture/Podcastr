<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#general" role="tab" data-toggle="tab"><?php echo __('General');?></a></li>
    <li><a href="#itunes" role="tab" data-toggle="tab"><?php echo __('iTunes');?></a></li>
    <li><a href="#theme" role="tab" data-toggle="tab"><?php echo __('Theme');?></a></li>
    <li><a href="#api" role="tab" data-toggle="tab"><?php echo __('API');?></a></li>
    <li><a href="#other" role="tab" data-toggle="tab"><?php echo __('Other');?></a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="general">
        <br />
        <?php echo $this->Form->create('', array('url' => '/admin/index', 'type' => 'file'));?>
        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('Naming');?></h4>
                <p><?php echo __('Everthing about brand and titles');?></p>
                <p><?php echo $this->Html->link(__('About logo\'s'), array('controller' => 'docs', 'action' => 'logos'));?></p>
                <?php if($named["logo"] != null){ ?>
                    <p><?php echo $this->Html->link(__('View current logo'), $named["logo"]['content']);?></p>
                <?php };?>
            </div>
            <div class="col-md-8">
                <?php echo $this->Form->input('title', array('label' => __('Title'), 'class' => 'form-control', 'value' => $named["title"]["content"]));?>
                <div class="input">
                    <label for="Description"><?php echo __('Podcast description');?></label>
                    <?php echo $this->Form->textarea('introduction', array('label' => __('introduction'), 'class' => 'form-control', 'style' => 'height: 150px;', 'value' => $named["introduction"]["content"]));?>
                </div>
                <?php echo $this->Form->input('logo', array('label' => __('Logo'), 'class' => 'form-control', 'type' => 'file'));?>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('Files');?></h4>
                <p><?php echo __('Where should things be stored');?></p>
                <p><?php echo $this->Html->link(__('About files'), array('controller' => 'docs', 'action' => 'files'));?></p>
            </div>
            <div class="col-md-8">
                <?php echo $this->Form->input('os_link', array('label' => __('Install folder on disk'), 'class' => 'form-control', 'value' => $named["os_link"]["content"]));?>
                <?php echo $this->Form->input('podcast_files', array('label' => __('Podcasts folder'), 'class' => 'form-control', 'value' => $named["podcast_files"]["content"]));?>
                <?php echo $this->Form->input('image_files', array('label' => __('Images folder'), 'class' => 'form-control', 'value' => $named["image_files"]["content"]));?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('Youtube');?></h4>
                <p><?php echo __('Where can we send the users to for your Youtube channel');?></p>
            </div>
            <div class="col-md-8">
                <?php echo $this->Form->input('youtube_link', array('label' => __('Youtube Link'), 'class' => 'form-control', 'value' => $named["youtube_link"]["content"]));?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 right">
                <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
    <div class="tab-pane" id="other">
        <br />
        <div class="flat">
            <p><?php echo __('Uncategorised options are features that haven\'t got an explicit menu option. These could be introduced by plugins or developers. To make sure you always could change these, we\'ve added this page, but normally you shouldn\'t find anything here.' );?></p>
        </div>
        <?php echo $this->Form->create('', array('url' => $this->here));?>
            <?php foreach($adminvars as $adminvar){
                echo $this->Form->input($adminvar["AdminVariable"]["name"], array('label' => $adminvar["AdminVariable"]["name"], 'value' => $adminvar["AdminVariable"]["content"], 'class' => 'form-control'));
            };?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 right">
                <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
    <div class="tab-pane" id="itunes">
        <br />
        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('iTunes');?></h4>
                <p><?php echo $this->Html->link(__('About iTunes'), array('controller' => 'docs', 'action' => 'itunes'));?></p>
            </div>
            <?php echo $this->Form->create('', array('url' => '/admin/index', 'type' => 'file'));?>
            <div class="col-md-8">
                <?php echo $this->Form->input('itunes_link', array('label' => __('iTunes link'), 'class' => 'form-control', 'value' => $named["itunes_link"]["content"]));?>
                <?php echo $this->Form->input('itunes_title', array('label' => __('Podcast title'), 'class' => 'form-control', 'value' => $named["itunes_title"]["content"]));?>
                <?php echo $this->Form->input('itunes_lang', array('label' => __('Podcast language'), 'class' => 'form-control', 'value' => $named["itunes_lang"]["content"]));?>
                <?php echo $this->Form->input('itunes_email', array('label' => __('Podcast email'), 'class' => 'form-control', 'value' => $named["itunes_email"]["content"]));?>
                <?php echo $this->Form->input('itunes_name', array('label' => __('Podcasts owner name'), 'class' => 'form-control', 'value' => $named["itunes_name"]["content"]));?>
                <?php echo $this->Form->input('itunes_category', array('label' => __('Podcasts main category'), 'class' => 'form-control', 'value' => $named["itunes_category"]["content"]));?>
                <?php echo $this->Form->input('itunes_subcat', array('label' => __('Podcasts subcategory'), 'class' => 'form-control', 'value' => $named["itunes_subcat"]["content"]));?>
                <?php echo $this->Form->input('itunes_keywords', array('label' => __('Podcasts keyword (,)'), 'class' => 'form-control', 'value' => $named["itunes_keywords"]["content"]));?>
                <?php echo $this->Form->input('itunes_explicit', array('label' => __('Podcast explicity?'), 'options' => array(array('value' => 'yes', 'name' => 'yes'), array('value' => 'no', 'name' => 'no')), 'class' => 'form-control', 'value' => $named["itunes_explicit"]["content"]));?>
                <?php echo $this->Form->input('itunes_image', array('label' => __('Podcast image'), 'class' => 'form-control', 'value' => $named["itunes_image"]["content"]));?>
                <?php echo $this->Form->input('itunes_image_alt', array('label' => __('Podcast image alt'), 'class' => 'form-control', 'value' => $named["itunes_image_alt"]["content"]));?>
                <?php echo $this->Form->input('itunes_url', array('label' => __('Podcast url'), 'class' => 'form-control', 'value' => $named["itunes_url"]["content"]));?>
                <?php echo $this->Form->input('itunes_site_feed', array('label' => __('Podcast site feeds location'), 'class' => 'form-control', 'value' => $named["itunes_site_feed"]["content"]));?>
                <?php echo $this->Form->input('itunes_tagline', array('label' => __('Podcast tagline'), 'class' => 'form-control', 'value' => $named["itunes_tagline"]["content"]));?>
                <?php echo $this->Form->input('itunes_description', array('label' => __('Podcast description'), 'class' => 'form-control', 'value' => $named["itunes_description"]["content"]));?>
                <?php echo $this->Form->input('itunes_subtitle', array('label' => __('Podcast subtitle'), 'class' => 'form-control', 'value' => $named["itunes_subtitle"]["content"]));?>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 right"><?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?></div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
        <hr />
    </div>
    <div class="tab-pane" id="theme">
        <br />
        <div class="row">
            <div class="col-md-4">
                <div class="well">
                    <p>Themes are located in the app/View/Themed directory. To create your own theme, just copy the default theme Folder, rename it and edit the view files. CSS/JS files can be found under /themefolder/webroot/</p>
                </div>
            </div>
            <div class="col-md-8">
                <?php echo $this->Form->create('', array('url' => '/admin/index'));?>
                <?php $indexCurrentTheme = array_search($currentTheme, $themes);?>
                <?php echo $this->Form->input('theme', array('label' => __('Theme'), 'options' => $themes, 'class' => 'form-control', 'default' => $indexCurrentTheme));?>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 right"><?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?></div>
                </div>
                <?php echo $this->Form->end();?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="api">
        <br />
        <?php echo $this->Form->create('', array('url' => '/admin/index', 'type' => 'file'));?>
        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('Facebook API');?></h4>
                <p>To enable Facebook API support, please register an application on <a href="http://developers.facebook.com">Facebook Developer Network</a>. If you don't know your Page Id, you can use <a href="http://findmyfacebookid.com/">this tool</a>.</p>
            </div>
            <div class="col-md-8">

                <?php echo $this->Form->input('facebook_pageId', array('label' => __('Facebook Page Id'), 'class' => 'form-control', 'value' => $named["facebook_pageId"]["content"]));?>
                <?php echo $this->Form->input('facebook_appId', array('label' => __('Facebook App Id'), 'class' => 'form-control', 'value' => $named["facebook_appId"]["content"]));?>


            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-4 right">
                <h4 class="first"><?php echo __('Twitter API');?></h4>
            </div>
            <div class="col-md-8">
                <p>Support coming soon</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4 right"><?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary'));?></div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>