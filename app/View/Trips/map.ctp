<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>
    <script type="text/javascript">
      var global_trip = <?php echo($trip['Trip']['id']) ?>;
    </script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/detectmobilebrowser.js') ?>"></script>
    
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.css') ?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/js/jcarousel/skin.css') ?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/date.css') ?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css') ?>"></link>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/jquery-1.6.1.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/fancybox-2.0/jquery.fancybox.pack.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/jquery.ba-hashchange.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/jcarousel/jquery.jcarousel.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo $this->Html->url('/js/map-utils.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/shared.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/date.js') ?>"></script>
    <script type="text/javascript">
var MyPlaces = {
    places: {},
    current_location: null,
    plot: function(callback) {
	$.ajax({
            url: '<?php echo $this->Html->url('/trips/get_locations/').$trip['Trip']['id'] ?>',
            success: function(data) {
		var arr = eval(data);
                var status = '<?php echo $trip['Trip']['status'] ?>';
		var max_order = 0;
		for (var i in arr){
		    var place = arr[i];
		    var order = parseInt(place.order);
		    if ((place.affinity == 'been' && order > max_order && status == 'in_progress') || (status == 'completed' && order == 1)){
			max_order = order;
			MyPlaces.current_location = place.id;
		    }
		    MyPlaces.places[place.id] = place; 
		}
		plotPlaces(callback, arr);
		loadRecent(arr);
            
		$(window).bind( 'hashchange', function(e) {
		    var target = location.hash ? location.hash.substr(1) : MyPlaces.current_location;
		    var place = MyPlaces.places[target];
		    loadSidebar(place);
		});
		$(window).hashchange();

		local_init();
	    }
	});
    },
    draw: function(callback) {
	$.ajax({
            url: '<?php echo $this->Html->url('/trips/get_segments/').$trip['Trip']['id'] ?>',
            success: function(data) {
		drawLines(callback, eval(data));
            }
	});
    },
    getPlace: function(place)
    {
	if (typeof place == 'number' || typeof place == 'string'){
	    place = MyPlaces.places[place];
	}
	return place;
    },
    getNextPlace: function(id)
    {
	if (!id) return null;
	return MyPlaces.getPlace(MyPlaces.getPlace(id).next);
    },    
    getPrevPlace: function(id)
    {
	if (!id) return null;
	return MyPlaces.getPlace(MyPlaces.getPlace(id).prev);
    }
}      
    </script>
    <script type="text/javascript" src="<?php echo $this->Html->url('/js/site.js') ?>"></script>
  </head>
  <body>
    <div id="main_page" data-trip-status="<?php echo $trip['Trip']['status'] ?>">
      <div id="header_container">
	<div id="header">
	  <div id="header1"><?php echo h($trip['Trip']['name']); ?></div>
	  <div id="where">
<?php
   if ($trip['Trip']['status'] == 'in_progress')
     echo ('Where am I now? <span id="where_am_i"></span>!');
   else echo $trip['Trip']['description'];
?>
	  </div>
	</div>
	<div id="links">Map View | 
	  <a href="<?php echo $this->Html->url('/trips/listing/'.$trip['Trip']['id']) ?>">Location List</a> | 
	  <a href="<?php echo $this->Html->url('/trips/collage/'.$trip['Trip']['id']) ?>">Photo Collage</a>
	</div>
      </div>
      <div id="content">
	<div id="sidebar"></div>
	<div id="left_column">
	  <div id="map_canvas">
	  </div>
	  <div id="options">
	    <table>
	      <tr>
		<td id="check-been"><img/><input type="checkbox"/>been</td>
		<td id="check-will"><img/><input type="checkbox"/>planned</td>
		<td id="check-want"><img/><input type="checkbox"/>want</td>
		<td id="check-paths"><input type="checkbox"/>paths</td>
	      </tr>      
	    </table>
	  </div>
	  <div id="recent_container"></div>
	</div>
      </div>
      <div id="trip-select">Other trips:</div>
    </div>
  </body>
</html>
