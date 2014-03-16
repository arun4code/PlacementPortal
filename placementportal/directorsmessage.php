
<html>
<head>
<title>DIRECTOR'S MESSAGE</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('1000px');">
<?php
session_start();

$currently_at='Home > About > Director\'s Message';
$vertical_menu='';
include('./verticalmenu_files/aboutverticalmenu.in');
$content='<fieldset style="height:540px;width:680px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Director\'s Message</b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:700px;height:480px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>

