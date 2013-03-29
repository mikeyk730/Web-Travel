<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
   protected function json_response($data)
   {
      $response = new CakeResponse(array('body' => json_encode($data)));
      $response->type('application/json');
      return $response;
   }
}