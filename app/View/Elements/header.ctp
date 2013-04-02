<?php 
function create_link($t, $view, $id, $target_view, $text)
{
  if (strcmp($view, $target_view))
  {
    $url = $t->Html->url('/trips/'.$target_view.'/'.$id);
    return '<a href="'.$url.'">'.$text.'</a>';
  }
  else
  {
    return $text;
  } 
}
?>

	<div id="header">
<div>
  <div id="trip-menu-buttons">
    <button id="null-button"><?php echo($trip['name']); ?></button>
    <button id="select" title="Select Trip">v</button>
  </div>
  <ul id="trip-menu">
  </ul>
</div>

	  <div id="where">
<?php
   if ($trip['status'] == 'in_progress')
     echo ('Where am I now? <span id="where_am_i"></span>!');
   else {
     $year_str = null;

     if ($trip['start_date']) {
       $start = strtotime($trip['start_date']);
       $start_year = date('M Y', $start);
       $year_str = $start_year;
   
       if ($trip['end_date']) {
         $end = strtotime($trip['end_date']);
         $end_year = date('M Y', $end);
         if (strcmp($start_year, $end_year))
           $year_str .= "-".$end_year;  

         $seconds_diff = $end - $start;
         $days_diff = floor($seconds_diff/3600/24);
         $year_str .= " / $days_diff days"; 
       }
       $year_str .= " / "; 
     }

     //$diff = $start->diff($end);
     //echo $diff->format('%R'); // use for point out relation: smaller/greater
     //echo $diff->days;

     echo $year_str.$trip['description'];
   }
?>
	  </div>
	</div>
<div id="links"><?php echo create_link($this, $view, $trip['id'], "map", "Map View") ?> | 
  <?php echo create_link($this, $view, $trip['id'], "listing", "Location List") ?> | 
  <?php echo create_link($this, $view, $trip['id'], "collage", "Photo Collage") ?>
</div>

<script>
  function dateFromString(str)
  {
    if (!str) 
      return null;
    var a = str.split("-");
    var d = new Date();
    d.setFullYear(parseInt(a[0]), parseInt(a[1])-1, parseInt(a[2]));
    return d;
  }

  function generateTripMenuItem(trip)
  {
    var name = trip.name;
    var start = dateFromString(trip.start_date);
    if (start)
	name += ' (' + start.getFullYear()+ ')';

    return $('<li class="ui-menu-item" role="menuitem"><a class="trip-link" href="<?php echo $this->Html->url('/trips/'.$view) ?>/' + trip.id + '">' + name + '</a></li>');
  }

  function addTripSelect()
  {
    $.ajax({
        url: '<?php echo $this->Html->url('/trips/get_trips') ?>',
        success: function(data) {
            var menu = $('#trip-menu');
            menu.empty();
	    for (var i in data){
              menu.append(generateTripMenuItem(data[i]));
	    }
	}
    });
  }

  $(function() {
    $("#null-button")
      .button()
      .click(function() {
          var menu = $( this ).parent().next().show().position({
            my: "left top",
            at: "left bottom",
            of: this
          });
          $( document ).one( "click", function() {
            menu.hide();
          });
          return false;
        })
      .next()
        .button({
          text: false,
          icons: {
            primary: "ui-icon-triangle-1-s"
          }
        })
        .click(function() {
          var menu = $( this ).parent().next().show().position({
            my: "left top",
            at: "left bottom",
            of: '#null-button'
          });
          $( document ).one( "click", function() {
            menu.hide();
          });
          return false;
        }); 
    $("#trip-menu-buttons").buttonset();
    $('#trip-menu').hide().menu();
    addTripSelect();
  });

  </script>
