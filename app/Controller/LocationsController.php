<?php
class LocationsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Locations';
   //public $scaffold;

   public function get_json($id = null){
      $this->Location->id = $id;
      $this->set('json', $this->Location->read());
   }
}
?>