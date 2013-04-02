<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>

    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      .album-tile
      {
        float: left;
        width: 300px; 
        height: 250px;
      }

      .album-tile img
      {
        width: 280px; 
      }
    </style>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
 </head>
  <body>
    <div id="main_page">
      <?php echo $this->element('header', array('view' => 'albums', 'trip' => $trip['Trip'])); ?>
      <div id="content">
<?php

$albums = $trip['Album'];
foreach ($albums as $i => $album){
   $thumb = $album['thumb'] ? $album['thumb'] : $this->Html->url('/thumbs/placeholder.jpg');
   echo ('<div class="album-tile"><a href="'.$this->Html->url('/albums/go/'.$album['id']).'" target="_blank">');
   echo ('<div class="album-thumb"><img src="'.$thumb.'" ></div>');
   echo ('<span class="album-name">'.$album['name'].'</span>');
   echo ('</a></div>');
}
if (empty($albums)){
   echo ('<div class="album-message">This trip has no albums</div>');
}

?>
      </div>
    </div>
  </body>
</html>

