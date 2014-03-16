<html>
<head>
<title>DELETE RECRUITER ACCOUNT</title>

<script src="./workspace_files/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript">
function confirmdelete()
{
	return confirm("Are you sure you want to delete this recruiter account? Recruiter information will be deleted as well.");
}
</script>

<link href="./workspace_files/tabcontent.css" rel="stylesheet" type="text/css" />
<?php 
include("./workspace_files/workspace_nsi_academic_head.in");
include("./workspace_files/workspace_nsi_intern_head.in");
include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_recruiteraccounts");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Delete recruiter account';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$setflag=1;
	if(isset($_POST['recruiter_username']))
	{
		
		$username=$_POST['recruiter_username'];
		
		include("./sql_connect_ro.php");
		$set='true';
		$res=mysqli_fetch_array(mysqli_query($db,"select username from recruiters_data where username='$username'"));
		$res2=mysqli_fetch_array(mysqli_query($db,"select username from login_recruiters where username='$username'"));
		
		mysqli_close($db);
		if(empty($res) && empty($res2))  
		{
			header("Location: ./workspace_recruiteraccountdelete.php?prev=fail");
		}
		else
		{
			$query1="delete from recruiters_data where username='$username'";
			$query2="delete from login_recruiters where username='$username'";
			
	
			include("./sql_connect_all.php");
			$res1=mysqli_query($db,$query1);
			$errors[]=mysqli_error($db);
			$res2=mysqli_query($db,$query2);
			$errors[]=mysqli_error($db);
			
			if(!($res1) || !($res2))
			{
				foreach($errors as $val)
					$content.="$val<br />";
				
				$content.="Could not delete data for $username";
			}
			else
			{
				$content.="Information for recruiter $username was successfully deleted from the database";
			}
			mysqli_close($db);
		}
		
	}
	else
	{
			if(isset($_GET['prev']) && $_GET['prev']=='fail')
			{
				$result='No recruiter exists by this username';
			}
			$todo='edit';
			$content.='<fieldset style="height:70px;width:735px;"><legend><b>Delete Recruiter Account</b></legend> Enter the user name of the Recruiter :
			<div style="position:absolute;left:0px;top:23px">
				<form  action="" method="post" onsubmit="return confirmdelete()">
				<input type="text" style="position:absolute;left:270px;top:0px;z-index:20;" name="recruiter_username">';
			$content.='
					<input type="hidden" name="todo" value="edit">
					<input type="submit"  style="position:absolute;left:450px;top:0px;z-index:20;" name="deleteaccount_submit" value="Delete" >
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