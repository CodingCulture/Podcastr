<?php
class AuthorsController extends AppController{

    public $uses = array('Author', 'PodcastConnectedAuthor');

    public function beforeFilter(){
        parent::beforeFilter();

        //Only logged in users may access these pages
        $this->Auth->allow('');
        $this->layout = 'admin';
        $this->set('admin', true);
    }

    public function index(){
        $this->set('authors', $this->Author->find('all'));
    }

    public function add(){
        if($this->request->is('post')){
            $author = $this->request->data;
            $this->Author->create();

            //Upload the profile picture
            if($author["Author"]["profile_image"]["name"] != ''){
                $author["Author"]["profile_image"] = $this->saveGraphicSource($author["Author"]["profile_image"]);
            }

            if($this->Author->save($author)){
                $this->Session->setFlash('Het opslaan van de auteur is gelukt.');
            } else {
                $this->Session->setFlash('Het opslaan van de auteur is mislukt.');
            }
        }
    }

    public function edit($id = null){
        if($id != null){
            $author = $this->Author->findById($id);
            if(!empty($author)){
                $this->set('author', $author);

                if($this->request->is('post')){
                    $this->Author->id = $id;
                    $author = $this->request->data;

                    //Upload the profile picture
                    if($author["Author"]["profile_image"]["name"] != ''){
                        $author["Author"]["profile_image"] = $this->saveGraphicSource($author["Author"]["profile_image"]);
                    }

                    if($this->Author->save($author)){
                        $this->Session->setFlash('Het opslaan van de auteur is gelukt.');
                    } else {
                        $this->Session->setFlash('Het opslaan van de auteur is mislukt.');
                    }
                }
            } else {
                $this->Session->setFlash('Je moet een bestaande gebruiker opgeven om aan te passen');
                $this->redirect(array('controller' => 'authors'));
            }
        } else {
            $this->Session->setFlash('Je moet een gebruiker opgeven om aan te passen');
            $this->redirect(array('controller' => 'authors'));
        }


    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $author = $this->Author->findById($id);

        if(!empty($author)){
            $this->set('author', $author);
        } else {
            throw new NotFoundException(__('Invalid author'));
        }

        if($this->request->is('post')){
            if (!$this->Author->exists($this->request->data["Author"]["id"])) {
                throw new NotFoundException(__('Invalid podcast'));
            }
            if ($this->Author->delete($this->request->data["Author"]["id"])) {
                $this->PodcastConnectedAuthor->delete(array('author_id' => $this->request->data["Author"]["id"]));
                $this->Session->setFlash(__('Author deleted'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Podcast was not deleted'));
            return $this->redirect(array('action' => 'index'));
        }
    }

}