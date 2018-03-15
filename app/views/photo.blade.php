

<?php
  header('image/png');
  session_id($_REQUEST['sid']);
  session_start();
  $img=imagecreatetruecolor(200, 30);
  $text_color=imagecolorallocate($img, 200, 200, 200);
  imagestring($img, 5, 5, 5,  $_SESSION['text'], $text_color);
  imagepng($img);
  imagedestroy($img);
?>
