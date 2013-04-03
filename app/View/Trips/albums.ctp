<!DOCTYPE html>
<html>
  <head>
    <title>Mike's Adventures</title>

    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo $this->Html->url('/css/places.css'); ?>"></link>
    <style type="text/css">
      #content
      {
        padding-top: 9px;
        padding-bottom: 9px;
      }

      #album-container
      {
        width: 906px;
        margin: auto;
      }

      .album-tile
      {
        float: left;
        text-align: center;

        border: solid #bbb 1px;
        margin: 9px 9px;
      }

      .album-tile img
      {
        width: 265px;
        height: 189px;
        margin: 7px;
        border: solid #bbb 1px;
      }

      .album-name
      {
        font-size: 1.4em;
        margin-bottom: 9px;
      }
    </style>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
 </head>
  <body>
    <div id="main_page">
      <?php echo $this->element('header', array('view' => 'albums', 'trip' => $trip['Trip'])); ?>
      <div id="content">
	<div id="album-container">
<?php

$albums = $trip['Album'];
foreach ($albums as $i => $album){
   $thumb = $album['thumb'] ? $album['thumb'] : $this->Html->url('/thumbs/placeholder.jpg');
   echo ('<div class="album-tile">');
   echo ('<div class="album-thumb"><a href="'.$this->Html->url('/albums/go/'.$album['id']).'" target="_blank"><img src="'.$thumb.'" ></a></div>');
   echo ('<div class="album-name"><a href="'.$this->Html->url('/albums/go/'.$album['id']).'" target="_blank">'.$album['name'].'</a></div>');
   echo ('</div>');
}
if (empty($albums)){
   echo ('<div class="album-message">This trip has no albums</div>');
}

?>
	</div>
      </div>
    </div>
  </body>
</html>

