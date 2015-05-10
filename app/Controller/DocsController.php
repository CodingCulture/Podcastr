<?php
class DocsController extends AppController{

    public function beforeFilter(){
        parent::beforeFilter();
        $this->layout = 'docs';
        $this->Auth->allow('');
    }

    public function json(){

    }

    public function itunes(){

    }

    public function mp3uploads(){

    }

}