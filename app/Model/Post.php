<?php
App::uses('AppModel', 'Model');
class Post extends AppModel {
	public $displayField = 'title';
   public $belongsTo = array('Location', 'Trip');
}
