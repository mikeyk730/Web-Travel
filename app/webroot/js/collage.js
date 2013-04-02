var total_image_count = 0;
var processed_image_count = 0;
var avg_width = 925;
var delta_height = 40;
var avg_height = 150;
var padding = 6;

function getTargetWidth(w, h, target_height)
{
    if (w == 0 || h == 0) return 220;
    var target_width = w * target_height / h;
    return target_width;
}

function getTargetHeight(height, width, target_width) {
   return height * target_width / width;
}

var loaded_images_been = [];
var loaded_images_want = [];

function imageProcessed()
{
   processed_image_count++;
   //console.log('loaded ' + processed_image_count + ' of ' + total_image_count);
   if (total_image_count == processed_image_count){
     endLoad();
   }
}

function getFancyboxOptions(i)
{
  return {
    index: i,
    nextEffect: 'none',
    prevEffect: 'none',
    helpers:  {
        title : {
	    type : 'inside'
        }
    }
  };
};

function onLoaded(img, title, link, affinity) {
   var element = img;
   if (link){
      title = "<span>" + title + "</span><span class='map-link'><a href='" + link + "'>map</a></span>";
      var a = $('<a class="fancy-image" rel="foo" title="' + title + '" href="' + img.attr('src') + '"></a>');

      a.bind("click", (function(i){ 
        return function() {
          $.fancybox.open($("a.fancy-image"), getFancyboxOptions(i));
          return false;
        }
      })(processed_image_count));

      element = a.append(img);
   }

   var id = (affinity == 'been') ? '#photos-been' : '#photos-want';
   var title_id = id + '-title';
   var title = (affinity == 'been') ? "Where I've Been" : 'Where I Want To Go';
   var array = (affinity == 'been') ? loaded_images_been : loaded_images_want;
   $(title_id).text(title);
   $(id).append(element);
   array.push({ id: img.attr('id'), width: img.width(), height: img.height() });
   arrange(array);
    
   imageProcessed();
}

function loadClosure(img, title, link, affinity) {
    return function() { setTimeout(function() { onLoaded(img, title, link, affinity) }, 0); };
}

function layout(images) {
   startLoad();
   total_image_count = images.length;
   // add all images to the page
   for (var i = 0; i < images.length; ++i) {
      var tooltip = images[i].title ? images[i].title : '';
      var img = $('<img id="photo' + i + '" src="' + images[i].image + '" title="' + tooltip + '" style="padding:' + padding / 2 + 'px">');
      img.load( loadClosure(img, tooltip, images[i].link, images[i].affinity, images.length) );
      img.error(imageProcessed);
   }
}

function arrange(loaded_images) {
    for (var i = 0; i < loaded_images.length; )
    {
	var total_width = 0;
	var elements = [];

	for (var j = i; total_width < avg_width && j < loaded_images.length; ++j) {
	    var img = loaded_images[j];
	    var image_width = getTargetWidth(img.width, img.height, avg_height);
	    
	    if (elements.length > 0 && avg_width-total_width < (total_width+image_width) - avg_width)
	    {
		   break;
	    }
	    
	    total_width += image_width;
	    elements.push(img);
	}
	
	var total_padding = (elements.length-1) * padding;
	var actual_height = getTargetHeight(avg_height, total_width, avg_width-total_padding);
	for (var index in elements) {
	   var json = elements[index];
       var img = $('#' + json.id);
	    img.width(getTargetWidth(json.width, json.height, actual_height));
	    img.height(actual_height);
	}
	
	i += elements.length;
    }
}
