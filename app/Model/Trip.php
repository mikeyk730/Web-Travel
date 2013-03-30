<?php
App::uses('AppModel', 'Model');
class Trip extends AppModel {
   public $displayField = 'name';
   public $hasMany = array('Location', 'Segment', 'Post', 'Album');
   public $actsAs = array('Containable');
}
