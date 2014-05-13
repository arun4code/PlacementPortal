<html>
<head>
<title>EDIT RECRUITER ACCOUNT</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_recruiteraccounts");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Edit Recruiter Account ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	
	include_once('./workspace_files/vertical_menu_workspace.in');
	if(isset($_GET['prev']) && $_GET['prev']=='fail')
	{
		$result='No recruiter exists by this username';
	}
	$todo='edit';
	$content.='<fieldset style="height:70px;width:735px;"><legend><b>Edit Recruiter Account</b></legend> Enter the user name of the Recruiter :
	<div style="position:absolute;left:0px;top:23px">
		<form  action="./workspace_newrecruiteraccount.php" method="post">
		<input type="text" style="position:absolute;left:270px;top:0px;z-index:20;" name="recruiter_username">';
	$content.='
			<input type="hidden" name="todo" value="edit">
			<input type="submit"  style="position:absolute;left:450px;top:0px;z-index:20;" name="accountreset_submit" value="Submit">
			</div>';
			if(isset($result))
			{
				$content.="<div style='position:absolute;left:10px;top:60px;color:red'>
				$result</div>";
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