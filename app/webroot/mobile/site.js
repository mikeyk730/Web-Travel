var g_pan = true;

var MyPlaces = {
    places: {},
    current_location: null,
    plot: function(callback) {
	var trip = getParameterByName('trip');
	if (!trip) { trip = '1'; }
	$.ajax({
            url: '../trips/get_locations/' + trip,
            success: function(data) {
		var arr = eval(data);
		var max_order = 0;
		for (var i in arr){
		    var place = arr[i];
		    var order = parseInt(place.order);
		    if (place.affinity == 'been' && order > max_order){
			max_order = order;
			MyPlaces.current_location = place.id;
		    }
		    MyPlaces.places[place.id] = place; 
		}
		plotPlaces(callback, arr);
            
		$(window).bind( 'hashchange', function(e) {
		    var target = location.hash ? location.hash.substr(1) : MyPlaces.current_location;
		    var place = MyPlaces.places[target];
		    loadSidebar(place);
		});
		$(window).hashchange();
	    }
	});
    },
    draw: function(callback) {
	var trip = getParameterByName('trip');
	if (!trip) { trip = '1'; }
	$.ajax({
            url: '../trips/get_segments/' + trip,
            success: function(data) {
		drawLines(callback, eval(data));
            }
	});
    }
}

function getPlaceHtml(place)
{
   return '<div id="title"><div id="prev" /><div id="current-place"><img class="flag" width="16px" height="11px" src="../images/flags/' + place.flag.toLowerCase() + '.png" />' + place.name + '</div><div id="next" /></div>'
	+ '<div id="latlon" onclick="panAndZoom(' + place.lat + ', ' + place.lon + ', 5);"><img src="../images/globe.png">' + place.lat + ', ' + place.lon + '</div>'
	+ getDateHtml(place.date)
	+ (place.description ? '<div id="description-area" >' + place.description + '</div>' : '')
 	+ (place.image ? '<div id="image-area" ><a target="_blank" href="../' + place.image + '"><img class="photo" src="../' + place.image + '" /></a></div>' : '')
 	+ (place.airport ? '<div id="airport"><img src="../images/plane.png" />' + place.airport.toUpperCase() + '</div>' : '')
 	+ '<div id="best_time"><span id="time_label"></span><table><tr></tr></table></div>';
}

function addKeyboardNav()
{
    $(document.documentElement).keyup(function(e){
	var link = null;
	if (e.keyCode == 37){ 
	    link = $('#prev.enabled');
	}
	else if (e.keyCode == 39){
	    link = $('#next.enabled');
	}
	
	if (link && link.length > 0) {
	    link.click();
	}
    });
}

function addNavigation(element, id)
{
    var place = MyPlaces.places[id];
    if (place){
	element.click(function(){ loadPlace(place.id, true); });
	element.addClass('enabled');
	element.attr('title', place.name);
    }
    else{
	element.addClass('disabled');
    }
}

function loadPlace(id, pan) {
   window.location.hash = id;
   g_pan = pan;
}

function loadSidebar(place) {
   var sidebar = $(getPlaceHtml(place));

    $.fancybox.close();

   $('#sidebar').empty();
   $('#sidebar').append(sidebar)

   sidebar.ready(function() {
      var prev = $('#prev');
      addNavigation(prev, place.prev);
      var next = $('#next');
      addNavigation(next, place.next);

      $('#image-area a').fancybox({
        'transitionIn'	: 'none',
        'transitionOut'	: 'none'	
      });    

      var best_time = place.best_time;
      if (!best_time || best_time == '            ') {
         return;
      }
      var labels = "JFMAMJJASOND";
      $('#time_label').text('Best time to go:');
      for (var i = 0; i < 12; ++i) {
         $('#best_time tr').append('<td class="progress' + (best_time.charAt(i) == 'X' ? ' filled' : '') + '">' + labels[i] + '</td>');
      }
   });
            
   setCurrentMarker(place);
   if (g_pan){
     panAndZoom(place.lat, place.lon, 5);
   }
}

window.onload = function() {
   sizeContent();
   initialize();
   buildOptions();
   addKeyboardNav();
}

window.onresize = sizeContent;
