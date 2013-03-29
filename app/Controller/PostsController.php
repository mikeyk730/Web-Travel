<?php
class PostsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Posts';
   var $components = array('Session');
   //public $scaffold;

   public function get_json($id = null)
   {
      $this->Post->id = $id;
      $this->set('json', $this->Post->read());
   }

	/* function index() { */
	/* 	$this->set('posts', $this->Post->find('all')); */
	/* } */

	/* function view($id = null) { */
   /*    $this->Post->id = $id; */
   /*    $this->set('post', $this->Post->read()); */
	/* } */

	/* function add() { */
   /*    if ($this->request->is('post')) { */
   /*       if ($this->Post->save($this->request->data)) { */
   /*          $this->Session->setFlash('Your post has been saved'); */
   /*          $this->redirect(array('action' => 'index')); */
   /*       } */
   /*    } */
	/* } */
   
	/* function edit($id = null) { */
   /*    if ($this->request->is('get')){ */
   /*       $this->Post->id = $id; */
   /*       $this->request->data = $this->Post->read(); */
   /*    } */
   /*    else { */
   /*       if ($this->Post->save($this->request->data)) { */
   /*          $this->Session->setFlash('Your post has been saved'); */
   /*          $this->redirect(array('action' => 'index')); */
   /*       } */
   /*    } */
	/* } */

	/* function delete($id = null) { */
   /*    if ($this->Post->delete($id)) { */
   /*       $this->Session->setFlash('The post was deleted'); */
   /*       $this->redirect(array('action' => 'index')); */
   /*    } */
	/* } */
}
?>