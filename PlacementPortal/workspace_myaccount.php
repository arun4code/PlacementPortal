<html>
<head>
<title>MY ACCOUNT</title>


<?php 

include('master_head.in');

?>
</head>
<?php
include('./workspace_files/workspacesessionrelated.in');
if($_SESSION['type']!='admin')
{
		echo "<body onload=\"adjustheightofpage('900px');expandcollapsesubmenu('submenu_myaccount');\">";
}
else
	echo "<body onload=\"expandcollapsesubmenu('submenu_myaccount');\">";
$currently_at='Workspace > My Account';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']))
{
	$type=$_SESSION['type'];
	$username=$_SESSION['username'];
	$query="select createdon,lastlogin,lastpasswordchange from ";
	$datalink='';
	$keytype='';
	if($type=='recruiter')
	{
		$query.="login_recruiters";
		$datalink="./workspace_recruiteraccountdisplay.php";
		$keytype="username";
	}
	else if($type=='admin')
	{
		$query.="login_admin";
		$keytype="username";
	}
	else if($type=='student')
	{
		$query.="login_students";
		$datalink="./workspace_studentinfodisplay.php";
		$keytype="admno";
	}
	$query.=" where username = '$username'";
	//$content.=$query;
	include('sql_connect_ro.php');
	$res=mysqli_fetch_array(mysqli_query($db,$query));
	mysqli_close($db);
	$createdon=$res['createdon'];
	$lastlogin=$res['lastlogin'];
	$lastpasswordchange=$res['lastpasswordchange'];
	include_once('./workspace_files/vertical_menu_workspace.in');
	$content.='<fieldset style="height:400px;width:735px;">
	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>My Account</b></span></legend>
	<span style="color:#000000;font-family:Arial;font-size:13px;">
	<table style="position:absolute;left:100px;top:50px;z-index:10;vertical-align:middle;text-align:center;" border="1">
	<tbody>';
	$content.="
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>USER NAME : </span></b></td>
	<td>$username</td>
	</tr>
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>TYPE OF ACCOUNT : </span></b>
	</td>
	<td>$type</td>
	</tr>
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>CREATED ON : </span></b>
	</td>
	<td>$createdon</td>
	</tr>
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>LAST LOGIN : </span></b>
	</td>
	<td>$lastlogin</td>
	</tr>
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>LAST PASSWORD CHANGE :</span></b>
	</td>
	<td>$lastpasswordchange</td>
	</tr>
	<tr>
	<td>
	<span style='color:#000000;font-family:Arial;font-size:13px;'><b>MY DATA : </span></b>
	</td>
	<td>";
	$content.='
	<form action="';$content.=$datalink;$content.='" method="post">
	<input type="hidden" name="';$content.=$keytype;$content.='" value="';$content.=$username;$content.='">
	<input type="submit" value="CLICK HERE">
	</form>
	</td>
	</tr>
	</tbody>
	</table>
	
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