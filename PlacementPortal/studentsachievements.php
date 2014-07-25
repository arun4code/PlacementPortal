<html>
<head>
<title>STUDENTS' ACHIEVEMENTS</title>
<?php

include('master_head.in');
?>
</head>
<body>
<?php
session_start();
$currently_at='Home > Recruiters > Students\' Achievements';
$vertical_menu='';
include('./verticalmenu_files/recruiterstabverticalmenu.in');
$content='<fieldset style="height:880px"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Students\' Achievements</b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:770px;height:820px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>