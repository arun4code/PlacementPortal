<html>
<head>
<title>PLACEMENT STATISTICS</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('1100px');">
<?php
session_start();
$currently_at='Home > Students > Placement Statistics';
$vertical_menu='';
include('./verticalmenu_files/studentstabverticalmenu.in');
$content='<fieldset style="height:620px"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Placement statistics of previous years</b></span></legend>

<div style="position:absolute;left:3px;top:30px;width:750px;height:580px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>