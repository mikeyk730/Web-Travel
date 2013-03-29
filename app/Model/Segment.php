<?php
class Segment extends AppModel {
    public $name = 'Segment';
    public $belongsTo = array('Trip',
                              'SourceLocation' => array('className'=>'Location', 'foreignKey'=>'source_location_id'),
                              'DestinationLocation' => array('className'=>'Location', 'foreignKey'=>'destination_location_id'));
}
?>