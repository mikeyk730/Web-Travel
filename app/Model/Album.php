<?php
App::uses('AppModel', 'Model');
class Album extends AppModel {
	public $displayField = 'id';
   public $belongsTo = 'Trip';
}
