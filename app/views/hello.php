<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</head>
<body>
<p><span><img src="<?php
        header("content-type:img/png");
        $email ="ajkldsf";
        $font = "font/arial.ttf";
        $height = 30;
        $width=240;
        $img = imagecreatetruecolor($width,$height);
        $fontcolor = imagecolorallocate($img,66,139,202);
        $backcolor = imagecolorallocate($img,255,255,255);
        imagefill($img,0,0,$backcolor);
        #imagestring($img,10,10,10,"guoay@hust.edu.cn",$fontcolor);

        imagepng($img);
        imagedestroy($img);
        ?>
"></span></p>
</body>
</html>
