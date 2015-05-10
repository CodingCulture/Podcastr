<?php
class FacebookController extends AppController{

    public $uses = array('Podcast', 'Video');

    public function post($type = null, $id = null){
        if(($type != null) and ($id != null)){
            $data = $this->$type->findById($id);
            if($data != null){

                //Get the Facebook Globals from the fb
                $fbSettings = array("pageId" => $this->admin_var('facebook_pageId'), "appId" => $this->admin_var('facebook_appId'));
                $this->set('fbSettings', $fbSettings);

                //Public var baselink
                $baselink = "http://" . $_SERVER["SERVER_NAME"] . $this->base . "/";

                //Get the data object values and build the message
                $message = array("message" => "", "name" => $data[$type]["title"],"link" => $baselink . $type . "s/open/" . $id, "picture" => $baselink  . $data[$type]["image"], "description" => strip_tags($data[$type]["description"]));

                //If custom text is added, expose to js API
                if($this->request->is('post')){
                    $incomingData = $this->request->data;
                    $message["message"] = $incomingData["facebook"]["message"];
                    $this->set("fbObject", json_encode($message));
                    $this->set("type", $type);
                    $this->set("id", $id);
                }
            } else {
                $this->redirect(array('controller' => 'admin', 'action' => 'index'));
            }
        } else {
            $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

}