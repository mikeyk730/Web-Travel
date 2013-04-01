<?php
class TripsController extends AppController {
   //public $scaffold;

   private function default_trip_id()
   {
      return 1;
   }

   private function set_trip_data($id)
   {
      if ($id == null) $id = $this->default_trip_id();
      $this->Trip->id = $id;
      $this->Trip->contain(array('Location' => array('order' => array('order'), 
                                                     'City' => array('fields' => array('lat','lon','name','address'),
                                                                     'Country' => array('fields' => array('name','code'))))));
      $data = $this->Trip->read();
    
      $locations = $data['Location'];
      foreach ($locations as $i => $location){
        $data['Location'][$i]['name'] = $this->Trip->Location->get_name($location);
      }

      $this->set('trip', $data);   
   }

   public function index($id = null)
   {
     $this->redirect(array('action' => 'map', $id));
   }

   public function map($id = null)
   {
      $this->set_trip_data($id);
   }

   public function listing($id = null)
   {
      $this->set_trip_data($id);
   }

   public function collage($id = null)
   {
      $this->set_trip_data($id);
   }

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

   private function extract_date($date_time)
   {
      if(!$date_time)
        return $date_time;
      $a = explode(' ', $date_time);
      return $a[0];
   }

   public function get_trips()
   {
      $this->Trip->recursive = -1;
      $trips = $this->Trip->find("all", array('order' => array('start_date DESC')));

      $data = array();
      foreach ($trips as $trip){
        $trip = $trip['Trip'];
        $data[] = array('id' => $trip['id'],
                        'start_date' => $this->extract_date($trip['start_date']),
                        'end_date' => $this->extract_date($trip['end_date']),
                        'description' => $trip['description'],
                        'status' => $trip['status'],
                        'name' => $trip['name']);
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
