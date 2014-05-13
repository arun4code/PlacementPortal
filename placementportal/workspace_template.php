<html>
<head>
<title>NEW STUDENT INFORMATION</title>


<?php 

include('master_head.in');

?>
</head>
<body>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include('./workspace_files/vertical_menu_workspace.in');
	$content='hello';
	
}
else if(isset($_SESSION['type']))
{
	$vertical_menu='';
	$content='<div style="position:absolute;left:0px;top:0px;width:500px;height:259px;z-index:16 ;">
	You are not authorised to view this page	
	</div>';
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