<?php
class AdminController extends AppController{

    public $uses = array('Podcast', 'AdminVariable', 'Stat', 'Note', 'Video');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->layout = 'admin';
        $this->Auth->allow('');
    }
    
    public function beforeRender(){}


    public function podcasts(){
        $this->set('podcasts', $this->Podcast->find('all', array('order' => 'created DESC')));
    }

    public function videos(){
        $this->set('videos', $this->Video->find('all', array('order' => 'created DESC')));
    }

    public function index(){
        $this->set('adminvars', $this->AdminVariable->find('all', array('conditions' => array('has_ui' => 0))));
        foreach($this->AdminVariable->find('all', array('conditions' => array('has_ui' => 1))) as $adminvar){
            $named[$adminvar["AdminVariable"]["name"]] = array('id' => $adminvar["AdminVariable"]["id"], 'content' => $adminvar["AdminVariable"]["content"]);
        }
        $this->set('named', $named);

        if($this->request->is('post')){
            $options = $this->request->data["Podcast"];
            if(isset($options["logo"])){
                if($options["logo"]["name"] != ''){
                    $upload = $this->saveGraphicSource($options["logo"]);
                    $options["logo"] = $upload;
                } else {
                    unset($options["logo"]);
                }
            }

            foreach($options as $name => $setting){

                $adminVar = $this->AdminVariable->find('first', array('conditions' => array('name' => $name)));
                if(!empty($adminVar)){
                    $adminVar["AdminVariable"]["content"] = $setting;
                    $adminVars[] = $adminVar;
                }
            }

            if(!empty($adminVars)){
                if($this->AdminVariable->saveMany($adminVars)){
                    $this->Session->setFlash(__('Settings saved'));
                }
            } else {
                $this->Session->setFlash(__('Settings could not be saved'));
            }

            $this->redirect('/admin/', 302);
        }

        $this->set('themes', $this->getThemes());
        $this->set('currentTheme', $this->admin_var('theme'));

    }

    public function dashboard(){
        $podcasts = $this->Podcast->find('all', array('order' => 'Podcast.created DESC'));
        $total = 0; $median = 0; $highest = 0; $lowest = null;
        $this->set('graphLength', 12);

        foreach($podcasts as $podcast){
            $itunes = $podcast["Stat"]["itunes"];
            $total += $itunes;
            $numbers[] = $itunes;
        }

        $highest = array("Podcast" => $this->Podcast->find('first', array('conditions' => array('Stat.itunes' => max($numbers)))), "count" => max($numbers));
        $lowest = array("Podcast" => $this->Podcast->find('first', array('conditions' => array('Stat.itunes' => min($numbers)))), "count" => min($numbers));


        $median = floor(($total / sizeof($podcasts)));
        $this->set('note', $this->Note->findById(1));
        $this->set('general', array("total" => $total, "highest" => $highest, "lowest" => $lowest, "median" => $median));
        $this->set('stats', $podcasts);
    }

    private function getThemes(){
        $target = $this->admin_var('os_link') . 'app/View/Themed/';
        $dirs = scandir($target);

        //Hide hidden folders
        for($i = 0; $i < sizeof($dirs); $i++){
            if(substr($dirs[$i], 0, 1) == '.'){
                unset($dirs[$i]);
            }
        }

        foreach($dirs as $theme){
            $themes[$theme] = $theme;
        }

        return $themes;

    }
}
