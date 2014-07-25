<html>
<head>
<title>WORKSPACE</title>

<?php

include('./workspace_files/workspacesessionrelated.in');
include('master_head.in');
?>
</head>
<?php

if($_SESSION['type']!='admin')
{
		echo "<body onload=\"adjustheightofpage('800px');\">";
}
else
	echo "<body>";
$currently_at='Workspace';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']))
{
	
	include('./workspace_files/vertical_menu_workspace.in');
	$content.='<fieldset style="height:50px;"><legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Workspace</b></span></legend>
	<span style="color:#000000;font-family:Arial;font-size:13px;">Welcome to your Workspace!! Please select an option from the menu to the left.</span>
	</fieldset>';
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