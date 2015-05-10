<?php
class ApiController extends AppController{
    public $layout = 'api';
    public $uses = array('Podcast');

    public function beforeFilter(){
        $this->Auth->allow();
    }

    public function get_posts(){
        $podcasts = $this->Podcast->find('all');
        $this->set('json', json_encode($podcasts, JSON_HEX_QUOT | JSON_HEX_TAG));
    }
}