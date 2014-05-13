<html>
<head>
<title>LIST OF DEPARTMENTS</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('1000px');">
<?php
session_start();
$currently_at='Home > Acedemic > List Of Departments';
$vertical_menu='';
include('./verticalmenu_files/academictabverticalmenu.in');
$content='
<fieldset style="height:500px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Departments</b></span></legend>

<div style="position:absolute;left:3px;top:50px;width:450px;height:450px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>
