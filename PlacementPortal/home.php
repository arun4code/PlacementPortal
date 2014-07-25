<html>
<head>
<title>TRAINING AND PLACEMENT PORTAL</title>
<?php

include('master_head.in');
?>
</head>
<body>
<?php
session_start();
$currently_at='Home';
$vertical_menu='';
include('./master_files/homepageverticalmenu.in');
$insidelayer_main='<div style="position:absolute;left:10px;top:700px;width:210px;text-align:center;vertical-align:middle;">
<span style="margin-top:0px;font-family: \'Lucida Console\', Monaco, monospace;font-size:18px;">QUICKLINKS</span>
<br>
<fieldset style="border-radius:5px;box-shadow:2px 2px 10px 10px #C9C9C9;height:100px;overflow:auto;text-align:center;">
<ul style="list-style-type:none;position:absolute;left:-30px;">
	<li style=""><a style="text-decoration:none;" href="#">College official website</a></li></ul>
</fieldset>
</div>';
$content='<br><br><span style="color:#000000;font-family:Arial;font-size:15px;">
Welcome to the training and placement portal. This website is there to assist students and recruiters in hiring process.
<br>"description about institute here"
</span>
<br><br>
<fieldset style="position:relative;height:540px;width:680px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Director\'s Message</b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:700px;height:480px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>
