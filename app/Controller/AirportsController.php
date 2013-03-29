<?php
class AirportsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Airports';

	function index() {
		$this->set('airports', $this->Airport->find('all', array('limit' => 1000)));
	}
}
?>