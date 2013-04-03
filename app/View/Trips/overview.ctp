<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>

    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.css'); ?>"></link> 
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/date.css') ?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css') ?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/trip.css') ?>"></link>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.pack.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/loader.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/date.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/shared.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/trip.js') ?>"></script> 
    <script type="text/javascript">
      $(document).ready( function(){
        startLoad();
        $.ajax({
          url: '/travel/trips/get_locations/<?php echo $trip['Trip']['id'] ?>',
          success: function(data) { handlePlaces(<?php echo $trip['Trip']['id'] ?>, data); }
        });
      });
    </script>
  </head>
  <body>
    <div id="main_page">
      <div id="header_container">
	<?php echo $this->element('header', array('view' => 'overview', 'trip' => $trip['Trip'])); ?>
      </div>
      <div id="content">
        <div class="loader"></div>
	     <div id="main"></div>
      </div>
    </div>
  </body>
</html>
