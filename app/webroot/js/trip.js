function albumLink(id)
{
    return '/travel/albums/go/' + id;
}

function mapLink(trip_id, place_id)
{
    return '/travel/trips/map/' + trip_id + '#' + place_id;
}

function getFancyboxOptions()
{
  return {
    nextEffect: 'none',
    prevEffect: 'none',
    helpers:  {
        title : {
	    type : 'inside'
        }
    },
    beforeLoad: function() {
        this.title = $(this.element).attr('data-caption');
	var a = $(this.element).attr('data-place');
	window.location.replace(('' + window.location).split('#')[0] + '#' + a);
    }
  };
};

function handlePlaces(trip_id, places)
{
    var empty = true;
    for (var i in places) {
        var place = places[i];
        if (place && place.affinity == 'been') {
	    empty = false;

            var html = '<div class="entry"><div class="info"><div class="entry-header">';
	    html += getDateHtml(place.date);
	    html += '<div class="name"><a name="' + place.id + '"></a>' + place.name + '</div></div>';
	    html += '<div class="description">' + place.description + '</div>';
	    html += '</div>';
	    html += '</div>';
	    var e = $(html);

	    if (place.image){
		var caption = get_caption(place.name, mapLink(trip_id, place.id), albumLink(place.album)); 
		var a = $('<a class="fancy-image" rel="location" data-place="' + place.id + '" data-caption="' + caption + '" href="' + place.image + '"></a>');
		var img = $('<div class="image"><img src="' + place.image + '" ></div>');
		a.append(img);
		e.append(a);
	    }

            $('#main').prepend(e);
        }
    }
    if (empty){
	$('#main').empty().append($('<div class="entry">This trip hasn\'t started</div>'));
    }
    $("a.fancy-image").fancybox(getFancyboxOptions());
    endLoad();
}
