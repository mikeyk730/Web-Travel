<?php
App::uses('AppController', 'Controller');
class AlbumsController extends AppController {
   //public $scaffold;

   public function get_json($trip_id = null)
   {
      $conditions = array('Album.trip_id' => $trip_id);
      $albums = $this->Album->find('all', array('conditions' => $conditions));
      $this->set('json', $albums);
   }
}
