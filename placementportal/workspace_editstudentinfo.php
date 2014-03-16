<html>
<head>
<title>EDIT STUDENT INFORMATION</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_studentdata");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Edit Student Information';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	if(isset($_GET['prev']))
		$prev=$_GET['prev'];
	else
		$prev="";
	include_once('./workspace_files/vertical_menu_workspace.in');
	$todo='edit';
	$content.='<fieldset style="height:70px;width:735px;"><legend><b>Edit Student Information</b></legend> Enter the Admission Number of the student:
		<form  action="./workspace_newstudentinfo.php" method="post">';
		include('workspace_files/workspace_selectstudentbyadmno.in');
		$content.='<div style="position:absolute;left:550px;top:23px">
				<input type="submit"  name="prensisubmit" value="Submit">
				</div>';
				if($prev=='fail')
				{
					$content.="<div style='position:absolute;left:10px;top:60px;color:red'>
				 *The data of queried student does not exist";
				}
				$content.='
		</form>
		
		</fieldset>';
	
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