<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array('User', 'Author');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout');
    }

    public function login() {
        if ($this->request->is('post')) {
            if($this->Auth->loggedin()){
                return $this->redirect('/');
            }

            if ($this->Auth->login()) {
                if($this->request->data['User']['remember_me'] == 1) {
                    $cookieTime = "1 week";
                    unset($this->request->data['User']['remember_me']);
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                    $this->Cookie->write('remember_me', $this->request->data['User'], true, $cookieTime);
                }
                return $this->redirect('/admin/dashboard');
            }

            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->Cookie->delete('remember_me');
        $this->Auth->logout();
        return $this->redirect('/users/login#loggedout');
    }


    public function index() {
        $this->layout = 'admin';
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all'));
    }

    public function view($id = null) {
        $this->layout = 'admin';
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }

        $this->set('authors', $this->Author->find('all'));
    }

    public function edit($id = null) {
        $this->layout = 'admin';
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $callback = true;
            if($this->request->data['User']['password'] == ''){
                $user = $this->User->findById($id);
                $this->request->data['User']['password'] = $user['User']['password'];
                $callback = false;
            }
            if ($this->User->save($this->request->data, array('callbacks' => $callback))) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
            $this->set('user', $this->User->findById($id));
            $this->set('authors', $this->Author->find('all'));
        }
    }

    public function delete($id = null) {
        $this->layout = 'admin';
        $user = $this->User->findById($id);

        if(!empty($user)){
            $this->set('user', $user);
        } else {
            throw new NotFoundException(__('Invalid user'));
        }

        if($this->request->is('post')){
            if (!$this->User->exists($this->request->data["User"]["id"])) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->User->delete($this->request->data["User"]["id"])) {
                $this->Session->setFlash(__('User deleted'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('User was not deleted'));
            return $this->redirect(array('action' => 'index'));
        }
    }

}