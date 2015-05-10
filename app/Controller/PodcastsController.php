<?php
App::uses('Xml', 'Utility');
class PodcastsController extends AppController{

    public $uses = array('Podcast', 'PodcastTag', 'Author', 'PodcastConnectedAuthor', 'PodcastConnectedTag', 'PodcastFile', 'AdminVariable', 'Stat');
    public $components = array('Paginator');
    public $paginate = array('order' => array('Podcast.created' => 'desc'), 'limit' => 10);

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index', 'listen', 'itunes', 'access', 'open');
    }

    public function beforeRender(){
	parent::beforeRender();
        $this->beforePublicContent();
    }

    //Public view
    public function index(){
        $this->Paginator->settings = $this->paginate;
        $podcasts = $this->Paginator->paginate('Podcast');
        $this->set('podcasts', $podcasts);
        $this->set('introduction', $this->admin_var('introduction'));
        $this->set('itunes', $this->admin_var('itunes_link'));
        if($this->Session->read('Auth.User')){
            $this->set('admin', true);
        }
    }


    public function listen($id = null){
        if($id != null){
            $this->layout = 'single-podcast';
            $podcast = $this->Podcast->findById($id);
            if(!empty($podcast)){
                $this->set('podcast', $podcast);
                //Find the tags
                foreach($podcast["PodcastConnectedTags"] as $tag){
                    $tags[] = $this->PodcastTag->findById($tag["podcast_tag_id"]);
                }
                $this->set('tags', $tags);

                //Find the authors
                foreach($podcast["PodcastConnectedAuthors"] as $author){
                    $authors[] = $this->Author->findById($author["author_id"]);
                }
                $this->set('authors', $authors);
            } else {
                $this->redirect(array('controller' => 'podcasts', 'action' => 'index'));
            }
        } else {
            $this->redirect(array('controller' => 'podcasts', 'action' => 'index'));
        }
    }


    //Admin view
    public function add(){
        $this->layout = 'admin';
        $this->set('authors', $this->Author->find('all'));
        $this->set('tags', $this->PodcastTag->find('all'));

        if($this->request->is('post')){
            $podcast = $this->request->data;
            $authors = explode(',', $podcast["Podcast"]["authors"]);
            $tags = explode(',', $podcast["Podcast"]["tags"]);

            //Save the audio file
            $mp3 = $this->saveAudioSource($podcast["Podcast"]["mp3"]);

            $this->PodcastFile->create();
            $mp3 = $this->PodcastFile->save(array('path' => $mp3));

            if(empty($mp3)){
                $this->Session->setFlash('Het uploaden van de file is mislukt');
                $this->redirect('/add');
            }

            //Save the graphic
            $img = $this->saveGraphicSource($podcast["Podcast"]["image"]);

            //Save the podcast record
            $this->Podcast->create();
            $podcast = array('Podcast' => array('title' => $podcast["Podcast"]["title"], 'created' => date('Y-m-d'), 'image' => $img, 'description' => $podcast["Podcast"]["description"], 'toc' => $podcast["Podcast"]["toc"], 'podcast_file_id' => $mp3["PodcastFile"]["id"]));
            $podcast = $this->Podcast->save($podcast);


            if(!empty($podcast)){
                //Create a record for stats
                $this->Stat->create();
                $stat = array('Stat' => array('podcast_id' => $podcast["Podcast"]["id"], 'itunes' => 0, 'site' => 0));
                $this->Stat->save($stat);

                //Populate the connection with authors and tags
                $authLink = array();

                foreach($authors as $author){
                    $authLink[$author] = array('podcast_id' => $podcast["Podcast"]["id"], 'author_id' => $author);
                }

                $this->PodcastConnectedAuthor->saveMany($authLink);

                $tagLink = array();

                foreach($tags as $tag){
                    $tagLink[$tag] = array('podcast_id' => $podcast["Podcast"]["id"], 'podcast_tag_id' => $tag);
                }

                $this->PodcastConnectedTag->saveMany($tagLink);

                //Let the user know everything went Okay
                $this->Session->setFlash('De podcast is opgeslagen');
                $this->redirect(array('controller' => 'facebook', 'action' => 'post', 'Podcast', $podcast["Podcast"]["id"]));
            } else {
                $this->Session->setFlash('Het opslaan van de podcast is mislukt.');
                $this->redirect(array('controller' => 'admin', 'action' => 'podcasts'));

            }
        }
    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $podcast = $this->Podcast->findById($id);

        if(!empty($podcast)){
            $this->set('podcast', $podcast);
        } else {
            throw new NotFoundException(__('Invalid podcast'));
        }

        if($this->request->is('post')){
            if (!$this->Podcast->exists($this->request->data["Podcast"]["id"])) {
                throw new NotFoundException(__('Invalid podcast'));
            }
            if ($this->Podcast->delete($this->request->data["Podcast"]["id"])) {
                $this->PodcastConnectedTag->delete(array('podcast_id' => $this->request->data["Podcast"]["id"]));
                $this->PodcastConnectedAuthor->delete(array('podcast_id' => $this->request->data["Podcast"]["id"]));
                $this->Session->setFlash(__('Podcast deleted'));
                return $this->redirect(array('controller' => 'admin', 'action' => 'podcasts'));
            }
            $this->Session->setFlash(__('Podcast was not deleted'));
            return $this->redirect(array('controller' => 'admin', 'action' => 'podcasts'));
        }
    }

    public function open($id = null){
        $this->redirect(array("action" => "listen", $id));
    }

    public function edit($id){
        if($id != null){
            $podcast = $this->Podcast->findById($id);
            $this->set('podcast', $podcast);

            if($this->request->is('post')){
                $edit = $this->request->data;
                $podcast["Podcast"]["title"] = $edit["Podcast"]["title"]; $podcast["Podcast"]["description"] = $edit["Podcast"]["description"]; $podcast["Podcast"]["toc"] = $edit["Podcast"]["toc"];
                if($this->Podcast->save($podcast)){
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

    public function iTunes(){

        //Tell the controller this is a feed
        $this->viewClass = 'Xml';

        //Where are the XML/Feed-templates stored?
        $os_link = $this->admin_var('os_link');
        $xml_link = '/app/webroot/xml/';
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $xml_link = '\app\webroot\xml\\';
        }
        $itunes = file_get_contents( $os_link . $xml_link .'channel.xml');

        //Find all the setting for the feeds
        $variables = $this->AdminVariable->find('all', array('conditions' => array('name LIKE' => 'itunes_%')));
        foreach($variables as $variable){
            $processor['{{' . str_replace('itunes_', '', $variable["AdminVariable"]["name"] . '}}')] = $variable["AdminVariable"]["content"];
        }

        //Let the XML Processor run over the channel info
        foreach($processor as $keyword => $value){
            $itunes = str_replace($keyword, htmlentities($value), $itunes);
        }

        $itunes = str_replace("{{pubdate}}", date('D, d M Y H:i:s') . ' EST', $itunes);

        //Let the XML Processor run over the items;
        $items = '';
        $podcasts = $this->Podcast->find('all');
        foreach($podcasts as $podcast){

            $item = file_get_contents( $os_link . $xml_link . 'item.xml');

            $keywords = array(
                'title' => $podcast["Podcast"]["title"],
                'description' => $podcast["Podcast"]["description"],
                'summary' => $podcast["Podcast"]["description"],
                'subtitle' => substr($podcast["Podcast"]["description"], 0, 300),
                'category' => 'fill',
                'enclosure' => 'http://'. $_SERVER["HTTP_HOST"] . $this->base . '/podcasts/access.mp3?url=' . rawurlencode($podcast["PodcastFile"]["path"]) . '&amp;id=' . $podcast["Podcast"]["id"],
                'guid' => 'http://'. $_SERVER["HTTP_HOST"] . $this->base . $podcast["PodcastFile"]["path"], 'duration' => '0:50:00',
                'pubdate' => date('D, d M Y H:i:s', strtotime($podcast["Podcast"]["created"])) . ' EST');

            foreach($keywords as $keyword => $value){
                if($keyword !== 'enclosure'){
                    $item = str_replace('{{' . $keyword . '}}', htmlentities($value), $item);
                } else {
                    $item = str_replace('{{' . $keyword . '}}', $value, $item);
                }
            }

            //Of course, append this item to all the items
            $items .= $item;
        }

        //Append the item list to the feed
        $itunes = str_replace("{{items}}", $items, $itunes);

        //Expose the XML
        $xml = Xml::build($itunes);
        $this->set('xml', $xml->asXML());
    }

    public function access(){
        $url = $this->request->query["url"];
        $id = $this->request->query["id"];
        $stats = $this->Stat->find('first', array('conditions' => array('podcast_id' => $id)));

        if(!empty($stats)){
            $stats['Stat']['itunes']++;
            $this->Stat->save($stats);
        }
        $this->redirect('http://'. $_SERVER["HTTP_HOST"] . str_replace('%2F', '/',rawurlencode($url)), 302);
    }
}
