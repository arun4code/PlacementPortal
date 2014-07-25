<html>
<head>
<title>COURSES OFFERED</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('1300px');">
<?php
session_start();
$currently_at='Home > Academic > Courses Offered';
$vertical_menu='';
include('./verticalmenu_files/academictabverticalmenu.in');
$content='<fieldset style="height:850px"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Courses offered</b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:750px;height:800px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>