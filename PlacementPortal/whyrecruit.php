<html>
<head>
<title>WHY RECRUIT?</title>
<?php
session_start();
include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('900px');">

<?php

$currently_at='Home > Recruiters > Why Recruit?';
$vertical_menu='';
include('./verticalmenu_files/recruiterstabverticalmenu.in');
$content='<fieldset style="height:450px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Why Recruit?</b></span></legend>

<div style="position:absolute;left:3px;top:50px;width:750px;height:350px;overflow:auto;">
--DATA--
</div>
</fieldset>
';


include('master_body.in');
?>

</body>
</html>