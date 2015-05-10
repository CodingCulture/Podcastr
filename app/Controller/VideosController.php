<?php
class VideosController extends AppController{

    public $components = array('Paginator');
    public $paginate = array('order' => array('Video.created' => 'desc'), 'limit' => 10);


    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'open');
    }

    public function beforeRender(){
        $this->beforePublicContent();
    }

    public function index(){
        $this->Paginator->settings = $this->paginate;
        $videos = $this->Paginator->paginate('Video');
        $this->set('videos', $videos);
        $this->set('introduction', $this->admin_var('introduction'));
        $this->set('youtube_link', $this->admin_var('youtube_link'));
    }

    public function view($id = null){
        $this->layout = 'single-podcast';
        if($id != null){
            $video = $this->Video->findById($id);
            if(!empty($video)){
                $this->set('video', $video);
            } else {
                $this->redirect(array('controller' => 'videos', 'action' => 'index'));
            }
        } else {
            $this->redirect(array('controller' => 'videos', 'action' => 'index'));
        }
    }

    public function open($id = null){
        $this->redirect(array('action' => "view", $id));
    }

    //Admin view
    public function add(){
        $this->layout = 'admin';

        if($this->request->is('post')){
            $video = $this->request->data;

            //Save the graphic
            $img = $this->saveGraphicSource($video["Video"]["image"]);

            //Save the podcast record
            $this->Video->create();
            $video = array('Video' => array('title' => $video["Video"]["title"], 'created' => date('Y-m-d H:i:s'), 'image' => $img, 'description' => $video["Video"]["description"], 'youtube_id' => $video["Video"]["youtube_id"]));
            $video = $this->Video->save($video);

            if(!empty($video)){
                //Let the user know everything went Okay
                $this->Session->setFlash('De video is opgeslagen');
                $this->redirect(array('controller' => 'facebook', 'action' => 'post', 'Video', $video["Video"]["id"]));
            } else {
                $this->Session->setFlash('Het opslaan van de video is mislukt.');
                $this->redirect(array('controller' => 'admin', 'action' => 'videos'));
            }
        }
    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $video = $this->Video->findById($id);

        if(!empty($video)){
            $this->set('video', $video);
        } else {
            throw new NotFoundException(__('Invalid video'));
        }

        if($this->request->is('post')){
            if (!$this->Video->exists($this->request->data["Video"]["id"])) {
                throw new NotFoundException(__('Invalid video'));
            }

            if ($this->Video->delete($this->request->data["Video"]["id"])) {
                $this->Session->setFlash(__('Video deleted'));
                return $this->redirect(array('controller' => 'admin', 'action' => 'videos'));
            }

            $this->Session->setFlash(__('Video was not deleted'));
            return $this->redirect(array('controller' => 'admin', 'action' => 'videos'));
        }
    }

    public function edit($id){
        if($id != null){
            $video = $this->Video->findById($id);
            $this->set('video', $video);

            if($this->request->is('post')){
                $edit = $this->request->data;
                $video["Video"]["title"] = $edit["Video"]["title"]; $video["Video"]["description"] = $edit["Video"]["description"];
                if($this->Video->save($video)){
                    $this->Session->setFlash('Het opslaan is geslaagd');
                    $this->redirect($this->here);
                } else {
                    $this->Session->setFlash('Er ging iets mis met het opslaan');
                    $this->redirect($this->here);
                }
            }
        } else{
            $this->redirect('/');
        }

    }
}