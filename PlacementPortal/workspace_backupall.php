<html>
<head>
<title>BACKUP</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_backupandrestore");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Backup ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$content='<fieldset style="height:500px;width:420">

	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>DOWNLOAD BACKUP FILE</b></span>
		<table id="table_backup" style="position:absolute;left:20px;top:30px;width:400px;height:390px;z-index:2;border:1px #C0C0C0 solid;" cellpadding="0" cellspacing="0" >
	<tbody><tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b><u>DATA</u></b></span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b><u>DOWNLOAD BACKUP FILE</u></b></span></td>
	</tr>
	<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Student General</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="filename" value="BACKUP__Students_general">
	<input type="hidden" name="query" value="select * from students_general">
	<input type="submit" name="backup1_submit" value="Download">
	</form>
	</td>
	</tr>
			<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Student Contact</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="filename" value="BACKUP__Students_contact">
	<input type="hidden" name="query" value="select * from students_contact">
	<input type="submit" name="backup2_submit" value="Download">
	</form>
	</td>
	</tr>
			<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Student Academic</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="filename" value="BACKUP__Students_Academic">
	<input type="hidden" name="query" value="select * from students_academic">
	<input type="submit" name="backup2_submit" value="Download">
	</form>
	</td>
	</tr>
		<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Student Training</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="filename" value="BACKUP__Students_Training">
	<input type="hidden" name="query" value="select * from students_training">
	<input type="submit" name="backup2_submit" value="Download">
	</form>
	</td>
	</tr>
		<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Student Placement</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="filename" value="BACKUP__Students_Placement">
	<input type="hidden" name="query" value="select * from students_placement">
	<input type="submit" name="backup3_submit" value="Download">
	</form>
	</td>
	</tr>
		<tr>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">Recruiter Data</span></td>
	<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;width:100px;height:20px;">
	<form method="post" action="./workspace_export.php">
	<input type="hidden" name="query" value="select * from recruiters_data">
	<input type="hidden" name="filename" value="BACKUP__Recruiters_Data">
	<input type="submit" name="backup4_submit" value="Download">
	</form>
	</td>
	</tr>
	</tbody>
	</table>
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