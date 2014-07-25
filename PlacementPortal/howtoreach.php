<html>
<head>
<title>HOW TO REACH</title>
<?php

include('master_head.in');
?>

</head>
<body onload="adjustheightofpage('900px');">
<?php
session_start();
$currently_at='Home > How to reach';
$vertical_menu='';
include('./verticalmenu_files/recruiterstabverticalmenu.in');
$content='<fieldset style="height:450px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>How to reach </b></span></legend>

<div style="position:absolute;left:3px;top:50px;width:750px;height:350px;overflow:auto;">
--DATA--
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>
