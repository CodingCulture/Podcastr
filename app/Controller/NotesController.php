<?php
class NotesController extends AppController{

    public function edit(){
        $note = $this->Note->findById(1);
        $this->set('note', $note);
        if($this->request->is('post')){
            $note["Note"]["content"] = $this->request->data["Note"]["content"];
            $note["Note"]["id"] = 1;
            if($this->Note->save($note)){
                $this->redirect(array('controller' => 'admin', 'action' => 'dashboard'));
            }
        }
    }

    public function collab(){
        $note = $this->Note->findById(2);
        $this->set('note', $note);
        if($this->request->is('post')){
            $note["Note"]["content"] = $this->request->data["Note"]["content"];
            $note["Note"]["id"] = 2;
            if($this->Note->save($note)){
                $this->redirect(array('controller' => 'notes', 'action' => 'linkDump'));
            }
        }
    }

    public function linkDump(){
        $note = $this->Note->findById(2);
        $this->set('note', $note);
    }

}