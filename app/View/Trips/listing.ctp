<?php 
  function print_affinity($trip, $a, $header, $url)
  { 
    $first = 1;
    foreach ($trip['Location'] as $location){
      if ($location['affinity'] == $a){
        if ($first){
          echo '<div class="category">'.$header.'<ol id="$a">';
	  $first = 0;
	}
        echo "<li><a href='".$url."#".$location['id']."'>".h($location['name'])."</a></li>";
      }
    }
   if ($first == 0)
     echo '</ol></div>';
  }
?> 
<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>
    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      .category
      {
        width: 315px;
        float: left;
      }

      #content { clear: both; }
    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
 </head>
  <body>
    <div id="main_page">
      <?php echo $this->element('header', array('view' => 'listing', 'trip' => $trip['Trip'])); ?>
      <div id="content">
	<?php 
	   $url = $this->Html->url("/trips/map/".$trip['Trip']['id']);
           print_affinity($trip, 'been', "Where I've Been", $url);
           print_affinity($trip, 'will', "Where I'm Going", $url);
           print_affinity($trip, 'want', "Where I Want To Go", $url);
	?>
      </div>
    </div>
  </body>
</html>
