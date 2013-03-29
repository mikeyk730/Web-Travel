function handlePlaces(places)
{
    for (var i in places) {
        var place = places[i];
        if (place && place.affinity == 'been') {
            var html = '<div class="entry"><div class="header">' + getDateHtml(place.date);
	    html += '<img class="image"' + (place.image ? (' src="' + place.image + '"') : '') + '>';
	    html += '<a href="index.html#' + place.id + '">' + place.name + '</a></div>' +
		'<div class="description"><p>' + place.description + '</p></div></div>';
            $('#main').prepend($(html));
        }
    }
}

window.onload = function(){
    $.ajax({
	url: '../trips/get_locations/1',
        //url: 'locations.js',
        success: function(data) {
            handlePlaces(eval(data));
        }
    });
}