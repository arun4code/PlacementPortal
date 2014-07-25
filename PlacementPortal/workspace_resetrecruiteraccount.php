<html>
<head>
<title>RESET RECRUITER PASSWORD</title>

<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_recruiteraccounts");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Reset Recruiter Password';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	if(isset($_POST['accountreset_submit']))
	{
				include('sql_connect_all.php');
	
		$rec_username=mysqli_real_escape_string($db,strip_tags($_POST['recruiter_username']));
	

		$query="update login_recruiters set password=SHA1('$rec_username') where username ='$rec_username'";
		$query2="select username from login_recruiters where username ='$rec_username'";
		$res=mysqli_query($db,$query);
		$res2=mysqli_num_rows(mysqli_query($db,$query2));
		$result='';
		if(mysqli_affected_rows($db)==1 || $res2==1)
		{
			$result.="<div style='color:green;'>The password of account $rec_username was changed successfully</div>";
		}
		else if($res2==0)
		{
			$result.="<div style='color:red;'>No account exists by the username $rec_username</div>";
		}
		else
		{
			$result.="<div style='color:red;'>The password of account $rec_username couldn't be changed</div>";
		
		}
		mysqli_close($db);
	}
	if(!(isset($result)))
	{
		$result='';
	}
	
	include_once('./workspace_files/vertical_menu_workspace.in');
	$todo='edit';
	$content.='<fieldset style="height:70px;width:735px;"><legend><b>Reset Recruiter Password</b></legend> Enter the user name of the Recruiter :
	<div style="position:absolute;left:0px;top:23px">
		<form  action="" method="post">
		<input type="text" style="position:absolute;left:250px;top:0px;z-index:20;" name="recruiter_username">';
	$content.='
			<input type="submit"  style="position:absolute;left:450px;top:0px;z-index:20;" name="accountreset_submit" value="Submit">
			</div>';
			if(isset($result))
			{
				$content.="<div style='position:absolute;left:10px;top:60px;'>
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