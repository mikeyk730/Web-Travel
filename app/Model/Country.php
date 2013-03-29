<?php
class Country extends AppModel {
    public $name = 'Country';
    public $belongsTo = 'Continent';
    public $hasMany = 'City';
}
?>