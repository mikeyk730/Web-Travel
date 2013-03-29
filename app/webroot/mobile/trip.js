function handlePlaces(places)
{
    for (var i in places) {
        var place = places[i];
        if (place) {
            var element = $('<p><a href="index.html#' + place.id + '">' + place.name + '</a></p>');
            $('#main').append(element);
        }
    }
}

window.onload = function(){
    $.ajax({
        url: 'locations.js',
        success: function(data) {
            handlePlaces(eval(data));
        }
    });
}