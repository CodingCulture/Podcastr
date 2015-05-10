<?php
class PodcastTagsController extends AppController{

    public $uses = array('PodcastTag', 'Podcast', 'PodcastConnectedTag');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

    public function index(){
        $this->layout = 'admin';
        $this->set('tags', $this->PodcastTag->find('all'));
    }

    public function add(){
        if($this->request->is('post')){
            $tag = $this->request->data;
            $this->PodcastTag->create();
            if($this->PodcastTag->save($tag)){
                $this->Session->setFlash('Het opslaan van de tag is gelukt.');
            } else {
                $this->Session->setFlash('Het opslaan van de tag is mislukt.');
            }
        }
    }

    public function view($tag = null){
        if($tag != null){

            //Get the tag
            $tag = $this->PodcastTag->find('first', array('conditions' => array('name' => $tag)));
            $this->set('tag', $tag);

            //Find all the posts with the tag
            $connects = $this->PodcastConnectedTag->find('all', array('conditions' => array('podcast_tag_id' => $tag["PodcastTag"]["id"])));
            foreach($connects as $tag){
                $podcasts[] = $this->Podcast->findById($tag["PodcastConnectedTag"]["podcast_id"]);
            }
            $this->set('podcasts', $podcasts);

        }
    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $tag = $this->PodcastTag->findById($id);

        if(!empty($tag)){
            $this->set('tag', $tag);
        } else {
            throw new NotFoundException(__('Invalid tag'));
        }

        if($this->request->is('post')){
            if (!$this->PodcastTag->exists($this->request->data["PodcastTag"]["id"])) {
                throw new NotFoundException(__('Invalid podcast'));
            }
            if ($this->PodcastTag->delete($this->request->data["PodcastTag"]["id"])) {
                $this->PodcastConnectedTag->delete(array('author_id' => $this->request->data["PodcastTag"]["id"]));
                $this->Session->setFlash(__('Tag deleted'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Podcast was not deleted'));
            return $this->redirect(array('action' => 'index'));
        }
    }

}