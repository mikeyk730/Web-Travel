<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>

    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.css'); ?>"></link> 
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      #content { clear: both; }

      #photos-been, #photos-want
      {
        width: 980px;
        padding-right: 25px;
        padding-left: 25px;
        padding-bottom: 7px;
      }
    </style>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
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
       echo("images.push({'image':'".$location['image']."','link':'".$this->Html->url('/trips/map/'.$trip['Trip']['id'].'#'.$location['id'])."','title':'".$location['name']."','affinity':'".$location['affinity']."','album':".($location['album'] ? "'".$this->Html->url('/albums/go/'.$location['album'])."'" : 'null')."});\n");
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
      <?php echo $this->element('header', array('view' => 'collage', 'trip' => $trip['Trip'])); ?>
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
