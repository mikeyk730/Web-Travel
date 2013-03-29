<?php
class TripsController extends AppController {
   //public $scaffold;

   public function get_json($id = null)
   {
      //$this->Trip->recursive = 2;
      $this->Trip->id = $id;
      $this->Trip->contain(array('Segment',
                                 'Location' => array('City' => array('fields' => array('lat','lon','name','address'),
                                                                     'Country' => array('fields' => array('name', 'code'))
                                                                     ),
                                                     'Post', 
                                                     'Album'),
                                 'Post',
                                 'Album'));
      return parent::json_response($this->Trip->read());
   }

   public function get_locations($id = null)
   {
      $this->Trip->id = $id;
      $this->Trip->contain(array('Location' => array('order' => array('order'), 
                                                     'City' => array('fields' => array('lat','lon','name','address'),
                                                                     'Country' => array('fields' => array('name','code'))))));
      $locations = $this->Trip->read();
      $locations = $locations['Location'];

      $data = array();
      foreach ($locations as $location){
         $data[] = array('id' => $location['id'],
                         'name' => $this->Trip->Location->get_name($location),
                         'affinity' => $location['affinity'],
                         'description' => $location['description'],
                         'image' => $location['image'],
                         'thumb' => $location['thumb'],
                         'flag' => $location['City']['Country']['code'],
                         'airport' => $location['airport'],
                         'best_time' => $location['best_time'],
                         'date' => $location['date'],
                         'lat' => $location['City']['lat'],
                         'lon' => $location['City']['lon'],
                         'order' => $location['order'],
                         'album' => $location['album']);
      }
      return parent::json_response($data);
   }

   public function get_segments($id = null)
   {
      $this->Trip->id = $id;
      $this->Trip->contain(array('Segment' => array('SourceLocation' => array('fields'=>array('airport', 'affinity'),
                                                                              'City' => array('fields' => array('lat','lon'))),
                                                    'DestinationLocation' => array('fields'=>array('airport', 'affinity'),
                                                                                   'City' => array('fields' => array('lat','lon'))))));
      $segments = $this->Trip->read();
      $segments = $segments['Segment'];

      $data = array();
      foreach ($segments as $segment){
         $data[] = array('start' => array('lat' => $segment['SourceLocation']['City']['lat'], 'lon' => $segment['SourceLocation']['City']['lon']),
                         'end' => array('lat' => $segment['DestinationLocation']['City']['lat'], 'lon' => $segment['DestinationLocation']['City']['lon']),
                         'affinity' => $segment['DestinationLocation']['affinity']);
      }
      return parent::json_response($data);
   }

   public function get_albums($id = null)
   {
      $this->Trip->id = $id;
      $this->Trip->contain(array('Album' => array('id','name','url','thumb')));
      $albums = $this->Trip->read();
      $albums = $albums['Album'];

      $data = array();
      foreach ($albums as $album){
         $data[] = array('id' => $album['id'],
                         'name' => $album['name'],
                         'url' => $album['url'],
                         'thumb' => $album['thumb']);
      }
      return parent::json_response($data);
   }
}