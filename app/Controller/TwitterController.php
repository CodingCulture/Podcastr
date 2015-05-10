<?php
class TwitterController extends AppController{

    public $uses = array('Podcast', 'Video');

    public function post($type = null, $id = null){
        if (($type != null) and ($id != null)) {
            $data = $this->$type->findById($id);
            if ($data != null) {
                //Public var baselink
                $baselink = "http://" . $_SERVER["SERVER_NAME"] . $this->base . "/";

                //Get the data object values and build the message
                $message = array("via" => "nielsvermaut", "url" => $baselink . $type . "s/open/" . $id, "text" => "#Contentupdate: " . $data[$type]["title"]);
                $this->set("message", $message);
            } else {
                $this->redirect(array('controller' => 'admin', 'action' => 'index'));
            }
        } else {
            $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }
}


