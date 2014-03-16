<html>
<head>
<title>ABOUT</title>
<?php

include('master_head.in');
?>

</head>
<body onload="adjustheightofpage('1300px');">
<?php
session_start();
$currently_at='Home > About > History';
$vertical_menu='';
include('./verticalmenu_files/aboutverticalmenu.in');
$content='<fieldset style="height:850px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>History</b></span></legend>


<span style="color:#000000;font-family:Arial;font-size:15px;">
<div style="position:absolute;left:3px;top:30px;width:760px;height:820px;overflow:auto;">
--DATA--
</div>
</span>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>
