<?php
header("content-type:img/png");
$email =$_GET['email'];
$font = "arial.ttf";
$height = 30;
$width=240;
$img = imagecreatetruecolor($width,$height);
$fontcolor = imagecolorallocate($img,66,139,202);
$backcolor = imagecolorallocate($img,255,255,255);
imagefill($img,0,0,$backcolor);
#imagestring($img,10,10,10,"guoay@hust.edu.cn",$fontcolor);
imagettftext($img,16,0,0,22,$fontcolor,$font,$email);
imagepng($img);
imagedestroy($img);
?>
