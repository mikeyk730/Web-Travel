<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>

    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.css'); ?>"></link> 
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      #content { clear: both; }

      #photos-been, #photos-want
      {
        width: 950px;
        margin: auto;
      }
 
      .fancybox-title
      {
        font-weight: bold;
        font-family: Verdana;
      }
      
      .map-link
      {
        float: right;
        margin-left: 5px;
      }
   </style>
    
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/jquery-1.6.1.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.pack.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/loader.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/collage.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/shared.js'); ?>"></script>
 
    <script type="text/javascript">
      function handlePlaces()
      {
        var images = [];
<?php
   foreach ($trip['Location'] as $location){
     if ($location['image']){
       echo("images.push({'image':'".$this->Html->url("/".$location['image'])."','link':'".$this->Html->url('/trips/map/'.$trip['Trip']['id'].'#'.$location['id'])."','title':'".$location['name']."','affinity':'".$location['affinity']."'});\n");
     }
   }
?>
        images.sort(function() { return 0.5 - Math.random() })
        layout(images);
      }

$(document).ready(function(){
      handlePlaces();
});
    </script>
 </head>
  <body>
    <div id="main_page">
      <div id="header">
	<div id="header1"><?php echo h($trip['Trip']['name']); ?></div>
	<div id="where">The world is a beautiful place!</div>
      </div>
      <div id="links">
	<a href="<?php echo $this->Html->url('/trips/map/'.$trip['Trip']['id']) ?>">Map View</a> | 
	<a href="<?php echo $this->Html->url('/trips/listing/'.$trip['Trip']['id']) ?>">Location List</a> | Photo Collage
      </div>
      <div id="content">
	<div class="loader"></div>
	<div id="photos-been-title" class="category"></div>
	<div id="photos-been"></div>
	<div id="photos-want-title" class="category"></div>
	<div id="photos-want"></div>
      </div>
    </div>
  </body>
</html>
