function handlePlaces(places)
{
    var empty = true;
    for (var i in places) {
        var place = places[i];
        if (place && place.affinity == 'been') {
	    empty = false;
            var html = '<div class="entry"><div class="header">';
	    html += '<div class="name">' + place.name + '</div>' + getDateHtml(place.date) + '</div>';
	    if (place.image){
		html += '<div class="image"><img src="' + place.image + '" ></div>';
	    }
	    html += '<div class="description"><p>' + place.description + '</p></div></div>';
            $('#main').prepend($(html));
        }
    }
    if (empty){
	$('#main').empty().text("This trip hasn't been started");
    }
    endLoad();
}
