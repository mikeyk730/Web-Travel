function plotOnePlace(plotter, place, hide) {
   var options = {
      callback: function() {
          loadPlace(place.id, false);
      },
      hide: hide
   };
   plotter(place, options);
}

function plotPlaces(plotter, places) 
{
    var affinity = getAffinityArray();
    for (var i = 0; i < places.length; ++i) {
	var prev = places[i-1];
	if (prev && prev.order){
	    places[i].prev = prev.id;
	}
	var next = places[i+1];
	if (next && next.order){
	    places[i].next = next.id;
	}
	
	if (places[i].affinity == 'lived') {
            places[i].affinity = 'been';
	}
	var hide = !showAffinity(places[i].affinity, affinity);
	plotOnePlace(plotter, places[i], hide);
    }
}

function showAffinity(affinity, affinities) {
   return $.inArray(affinity, affinities) != -1;
}

function optionHelper(affinity, affinities) {
   $('#check-' + affinity + ' img').attr('src', getIcon(affinity));
   var input = $('#check-' + affinity + ' input');
   input.attr('checked', showAffinity(affinity, affinities));
   input.removeAttr('disabled');
   input.click(function() {
      setMarkerVisibility(affinity, input.is(':checked'));
   });
}

function optionsHelperPath()
{
   var input = $('#check-paths input');
   input.attr('checked', true);
   input.removeAttr('disabled');
   input.click(function() {
      setPathVisibility(input.is(':checked'));
   });
}

function buildOptions() {
   var affinities = getAffinityArray();
   optionHelper('been', affinities);
   optionHelper('will', affinities);
   optionHelper('want', affinities);
   optionsHelperPath();
}

function drawLines(plotter, places) {
   for (var i in places) {
      var line = [];
      line.push(places[i].start);
      line.push(places[i].end);
      var color = (places[i].affinity == 'been') ? '#4444ff' : '#ff2266';
      plotter(line, color);
   }
}

function getParameterByName(name) {
   var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
   return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

function getAffinityArray() {
   var affinity = getParameterByName('affinity');
   if (!affinity) {
      affinity = "been,will,want";
   }
   return affinity.split(',');
}

function sizeContent() {
   var map = $('#map_canvas');
   var sidebar = $('#sidebar');
   sidebar.height(window.innerHeight);
   map.height(sidebar.height());
   map.width(document.body.clientWidth - 250);
}
