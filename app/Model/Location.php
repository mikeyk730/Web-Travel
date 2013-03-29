<?php
class Location extends AppModel {
    public $name = 'Location';
    public $belongsTo = array('Trip', 'City');
    public $hasMany = array('Album', 'Post');
    public $displayName = 'title';

    public function get_name($location){
       if ($location['name'] != null){
          return $location['name'].", ".$location['City']['Country']['name'];
       }
       
       return $location['City']['address'];
    }
}
?>