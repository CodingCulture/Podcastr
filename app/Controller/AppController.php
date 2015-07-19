<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::import('Lib', 'Facebook.FB');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('AdminVariable', 'User', 'StatsReferral');

    public $components = array(
        'Session',
        'Cookie',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        )
    );

    public function beforeFilter() {
        //Fetch the logo and expose
        $logo = $this->admin_var('logo');
        if($logo != null){
            $this->set('logo', $logo);
        } else {
            $this->Session->setFlash(__('You haven\'t completed the settings page. Please do!') . ' <a href="' . $this->webroot .'/admin">' . __('Update Settings') . '</a>');
            $this->set('logo', 'http://cdn.flaticon.com/png/256/8235.png');
        }

        //Should we init admin creation?
        if($this->User->find('count') == 0){
           if($this->request->params['action'] != 'add' and $this->request->params['controller'] != 'users'){
               $this->redirect(array('controller' => 'users', 'action' => 'add'));
           }
            $this->Auth->allow();
        }

        $this->Cookie->httpOnly = true;

        if (!$this->Auth->loggedIn() && $this->Cookie->read('remember_me')) {
            $cookie = $this->Cookie->read('remember_me');

            $this->loadModel('User'); // If the User model is not loaded already
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $cookie['username'],
                    'User.password' => $cookie['password']
                )
            ));

            if ($user && !$this->Auth->login($user['User'])) {
                $this->redirect('/users/logout'); // destroy session & cookie
            }
        }

    }

    public function beforeRender(){
        /*
         *
         * Disabled themes to help icons load
         *
         */
        $this->theme = $this->admin_var('theme');

        //Load the disqus ID
        $this->set('disqus_channel', $this->admin_var('disqus_channel'));
    }

    public function beforePublicContent(){
        if(sizeof($this->request->params["pass"]) == 1){
            if(isset($this->request->query["ref"])){
                $referralName = $this->request->query["ref"];
                $typeReference = $this->request->params["pass"][0];

                $referral = $this->StatsReferral->find('first', array('conditions' => array('StatsReferral.name' => $referralName, 'StatsReferral.type' => $this->params['controller'], 'StatsReferral.type_id' => $typeReference)));

                if(!empty($referral)){
                    $referral["StatsReferral"]["count"]++;
                } else {
                    $referral["StatsReferral"] = array('name' => $referralName, 'count' => 1, 'type' => $this->params['controller'], 'type_id' => $typeReference);
                }

                $this->StatsReferral->save($referral);
            }
        }
    }


    //Helper functions
    public function admin_var($name){
        if($name != null){
            $finds = $this->AdminVariable->find('first', array('conditions' => array('name' => $name)));
            if(!empty($finds)){
                $var = $finds["AdminVariable"]["content"];
            } else {
                $this->AdminVariable->save(array('name' => $name, 'content' => ''));
                $var = '';
            }
        }
        return $var;
    }

}
