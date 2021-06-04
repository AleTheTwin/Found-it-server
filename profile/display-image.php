<?php
    
// Load an image from jpeg URL
$im = imagecreatefromjpeg(
'img/AleTheTwin.png');
  
// View the loaded image in browser
header('Content-type: image/jpg');  
imagejpeg($im);
imagedestroy($im);
?>