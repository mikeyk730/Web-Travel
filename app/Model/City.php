<?php
class City extends AppModel {
    public $name = 'City';
    public $belongsTo = array('Country', 'Region');
    public $hasMany = 'Location';
}
?>