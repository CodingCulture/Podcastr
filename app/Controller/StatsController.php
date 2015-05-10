<?php
class StatsController extends AppController{
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add');
    }   

    public function add($type = null){

        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data;
            $stats = $this->Stat->find('first', array('conditions' => array('podcast_id' => $data["id"])));
            if(!empty($stats)){
                $stats['Stat']['site']++;
                $this->Stat->save($stats);
            }
        }
    }
}
