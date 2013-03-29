var MapGlobals = 
{
   currentMarker: null,
   allMarkers: {lived:[], been:[], will:[], want:[]},
   allPaths: [],
   map: null
};

function getIcon(affinity) {
   if (affinity == "want") return 'images/map-push-pin-red.png';
   else if (affinity == "will") return 'images/map-push-pin-orange.png';
   else if (affinity == 'current') return 'images/map-push-pin-purple.png';
   else return 'images/map-push-pin-green.png';
}

function getFlag(code) {
   return 'images/flags/' + code.toLowerCase() + '.png';
}

function panAndZoom(lat, lon, zoom) {
    if (!window.google) return;
    
    if (lat && lon) {
	MapGlobals.map.panTo(new google.maps.LatLng(lat, lon));
    }
    if (zoom) {
	MapGlobals.map.setZoom(zoom)
    }
}

function setCurrentMarker(place) {
    if (!window.google) return;

   if (MapGlobals.currentMarker) {
      MapGlobals.currentMarker.setMap(null);
   }
   MapGlobals.currentMarker = new google.maps.Marker({
      icon: getIcon('current'),
      position: new google.maps.LatLng(place.lat, place.lon),
      map: MapGlobals.map,
      title: place.name,
      zIndex: 9999
   });
}

function setMarkerVisibility(affinity, show) {
   var list = MapGlobals.allMarkers[affinity];
   for (var i in list) {
      list[i].setMap(show ? MapGlobals.map : null)
   }
}

function setPathVisibility(show) {
   var list = MapGlobals.allPaths;
   for (var i in list) {
      list[i].setMap(show ? MapGlobals.map : null)
   }
}

function plotMarker(map, infowindow, place, options) {
   if (!place || !window.google) {
      return;
   }
   var pos = new google.maps.LatLng(place.lat, place.lon);
   var marker = new google.maps.Marker({
      icon: getIcon(place.affinity),
      position: pos,
      map: (options && options.hide) ? null : map,
      title: place.name
   });

   MapGlobals.allMarkers[place.affinity].push(marker);

   if (options && options.url) {
      google.maps.event.addListener(marker, 'click', function() {
         $.ajax({
            url: options.url,
            success: function(data) {
               infowindow.setContent(data);
               infowindow.setPosition(pos);
               infowindow.open(map, marker);
            }
         });
      });
   }
   
   if (options && options.callback) {
      google.maps.event.addListener(marker, 'click', options.callback);
   }
}

function plotLine(map, polyline, color) {
   if (!window.google) return;

   if (!color) {
      color = '#4444ff'; 
   }
   var coords = [];
   for (var i in polyline) {
      var location = polyline[i];
      coords.push(new google.maps.LatLng(location.lat, location.lon));
   }

   var path = new google.maps.Polyline({
      path: coords,
      strokeColor: color,
      strokeOpacity: 0.5,
      strokeWeight: 4
   });

   MapGlobals.allPaths.push(path);

   path.setMap(map);
}

function plotMarkers(callback) {
   MyPlaces.plot(callback);
}

function plotLines(callback) {
   MyPlaces.draw(callback);
}

function initialize() 
{
    var infowindow = null;
    var map = null;
    
    if (window.google) 
    {
	var myOptions = {
	    zoom: 2,
	    center: new google.maps.LatLng(15, 10),
	    mapTypeId: google.maps.MapTypeId.TERRAIN
	}
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	infowindow = new google.maps.InfoWindow();
    }
    
    MapGlobals.map = map;
    
    var updater = function(place, options) { plotMarker(map, infowindow, place, options); };
    plotMarkers(updater);
    
    var drawer = function(polyline, color) { plotLine(map, polyline, color); };
    plotLines(drawer);
}
