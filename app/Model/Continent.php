<?php
class Continent extends AppModel {
    public $name = 'Continent';
    public $hasMany = 'Country';
}
?>