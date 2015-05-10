<?php
App::uses('Xml', 'Utility');
class PostsController extends AppController{

    public $components = array('Paginator');
    public $paginate = array('order' => array('Post.created' => 'desc'), 'limit' => 10);

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'read');
    }

    public function beforeRender(){
        $this->beforePublicContent();
    }

    //Public view
    public function index(){
        $this->Paginator->settings = $this->paginate;
        $posts = $this->Paginator->paginate('Post');
        $this->set('posts', $posts);
        $this->set('introduction', $this->admin_var('introduction'));
        if($this->Session->read('Auth.User')){
            $this->set('admin', true);
        }
    }


    public function read($id = null){
        if($id != null){
            $this->layout = 'single-podcast';
            $post = $this->Post->findById($id);
            if(!empty($post)){
                $this->set('post', $post);
            } else {
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
        } else {
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
    }


    //Admin view
    public function add(){
        $this->layout = 'admin';

        if($this->request->is('post')){
            $post = $this->request->data;

            //Save the graphic
            $img = $this->saveGraphicSource($post["Post"]["image"]);

            //Save the post record
            $this->Post->create();
            $post = array('Post' => array('title' => $post["Post"]["title"], 'created' => date('Y-m-d'), 'image' => $img, 'description' => $post["Post"]["description"]));
            $post = $this->Post->save($post);


            if(!empty($post)){
                //Let the user know everything went Okay
                $this->Session->setFlash('De post is opgeslagen');
                $this->redirect(array('controller' => 'facebook', 'action' => 'post', 'Post', $post["Post"]["id"]));
            } else {
                $this->Session->setFlash('Het opslaan van de post is mislukt.');
                $this->redirect(array('controller' => 'admin', 'action' => 'posts'));

            }
        }
    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $post = $this->Post->findById($id);

        if(!empty($post)){
            $this->set('post', $post);
        } else {
            throw new NotFoundException(__('Invalid post'));
        }

        if($this->request->is('post')){
            if (!$this->Post->exists($this->request->data["Post"]["id"])) {
                throw new NotFoundException(__('Invalid post'));
            }
            if ($this->Post->delete($this->request->data["Post"]["id"])) {
                $this->PostConnectedTag->delete(array('post_id' => $this->request->data["Post"]["id"]));
                $this->PostConnectedAuthor->delete(array('post_id' => $this->request->data["Post"]["id"]));
                $this->Session->setFlash(__('Post deleted'));
                return $this->redirect(array('controller' => 'admin', 'action' => 'posts'));
            }
            $this->Session->setFlash(__('Post was not deleted'));
            return $this->redirect(array('controller' => 'admin', 'action' => 'posts'));
        }
    }

    public function edit($id){
        if($id != null){
            $post = $this->Post->findById($id);
            $this->set('post', $post);

            if($this->request->is('post')){
                $edit = $this->request->data;
                $post["Post"]["title"] = $edit["Post"]["title"]; $post["Post"]["description"] = $edit["Post"]["description"];
                if($this->Post->save($post)){
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