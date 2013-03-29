<?php
class SegmentsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Segments';
   //public $scaffold;

   public function get_json($id = null)
   {
      $this->Segment->id = $id;
      $this->set('json', $this->Segment->read());
   }

	/* function index() { */
	/* 	$this->set('segments', $this->Segment->find('all')); */
	/* } */
}
?>