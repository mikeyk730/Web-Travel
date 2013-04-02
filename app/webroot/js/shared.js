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

var albums = {
  add: function(album)
  {
    this.data[album.id] = album;
  },
  get: function(id)
  {
    return this.data[id];
  },
  data: {}
};

function process_album_data(data)
{
   for (var i in data){
      albums.add(data[i]);
   }
}

function get_caption(title, link, album_id)
{
  var caption = "<span>" + title + "</span>";
  var album = albums.get(album_id);
  if (album && album.url){
    caption += "<span class='album-link'> | <a href='" + album.url + "' target='_blank'>album</a></span>";
  }
  if (link){
    caption += "<span class='map-link'><a href='" + link + "'>map</a></span>";
  }
  return caption;
}


function sizeContent() {
/*
    if (document.body.clientWidth > 1000)
    {
	$('body').removeClass('mobile');
	var map = $('#map_canvas');
	map.width(800);
	map.height(450);
	return;
    }

    $('body').addClass('mobile');

    var map = $('#map_canvas');
    var sidebar = $('#sidebar');
    sidebar.height(window.innerHeight);
    map.height(sidebar.height());
    map.width(document.body.clientWidth - 250);
*/
}
