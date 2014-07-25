<html>
<head>
<title>ALL STUDENTS</title>


<?php 

include('master_head.in');

?>
</head>
<body>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > View all students';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include('./workspace_files/vertical_menu_workspace.in');
	$content='<fieldset style="height:600px;">
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>View All Students</b> </span></legend>
		</fieldset>';	
	
}
else if(isset($_SESSION['type']))
{
	header('Location: ./login.php');
}
else
{
$vertical_menu='';
$content= '
<div style="position:absolute;left:0px;top:0px;width:200px;height:259px;z-index:16 ;">
Please log in to view this page
</div>
';
}
include('master_body.in');
?>
</body>
</html>