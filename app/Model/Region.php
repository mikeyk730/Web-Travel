<?php
class Region extends AppModel {
    public $name = 'Region';
    public $hasMany = 'City';
}
?>