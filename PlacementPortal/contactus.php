<html>
<head>
<title>CONTACT US</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('800px');">
<?php
session_start();
$currently_at='Home > About > Contact Us';
$vertical_menu='';
include('./verticalmenu_files/aboutverticalmenu.in');
$content='<fieldset style="height:350px"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Contact Us </b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:750px;height:300px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>
