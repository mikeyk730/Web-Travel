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
    
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      .category
      {
        width: 315px;
        float: left;
      }

      #content { clear: both; }
    </style>
 </head>
  <body>
    <div id="main_page">
      <div id="header">
	<div id="header1"><?php echo h($trip['Trip']['name']); ?></div>
	<div id="where">So many places to visit!</div>
      </div>
      <div id="links">
	<a href="<?php echo $this->Html->url('/trips/map/'.$trip['Trip']['id']) ?>">Map View</a> | Location List | 
	<a href="<?php echo $this->Html->url('/trips/collage/'.$trip['Trip']['id']) ?>">Photo Collage</a>
      </div>
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
