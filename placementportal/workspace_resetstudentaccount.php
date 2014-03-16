<html>
<head>
<title>RESET STUDENT PASSWORD</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_studentaccounts");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Reset Student Password ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	if(isset($_POST['accountreset_submit']))
	{
				include('sql_connect_all.php');
		$todo=$_POST['todo'];
		$degree=mysqli_real_escape_string($db,strip_tags($_POST['degree']));
		$admyear=mysqli_real_escape_string($db,strip_tags($_POST['admyear']));

		if($degree=='U')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchbtech']));
		else if($degree=='I')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmsc']));
		else if($degree=='P')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmtech']));
			$admno=$degree.$admyear[2].$admyear[3].$branch;
		$branchrollno=mysqli_real_escape_string($db,strip_tags($_POST['branchrollno']));
		if($branchrollno<=9)
			$admno.="00";
		else if($branchrollno<=99)
			$admno.="0";
		$admno.=$branchrollno;

		$query="update login_students set password=SHA1('$admno') where username ='$admno'";
		$query2="select username from login_students where username ='$admno'";
		$res=mysqli_query($db,$query);
		$res2=mysqli_num_rows(mysqli_query($db,$query2));
		$result='';
		if(mysqli_affected_rows($db)==1 || $res2==1)
		{
			$result.="<font color='green'>The password of account $admno was changed successfully</font>";
		}
		else if($res2==0)
		{
			$result.="<font color='red'>No account exists by the username $admno</font>";
		}
		else
		{
			$result.="<font color='red'>The password of account $admno couldn't be changed</font>";
		
		}
		mysqli_close($db);
	}
	if(!(isset($result)))
	{
		$result='';
	}
	
	include_once('./workspace_files/vertical_menu_workspace.in');
	$todo='edit';
	$content.='<fieldset style="height:70px;width:735px;"><legend><b>Reset Student Password</b></legend> Enter the Admission Number of the student:
		<form  action="" method="post">';
	$todo='reset';
	include('workspace_files/workspace_selectstudentbyadmno.in');
	$content.='<div style="position:absolute;left:550px;top:23px">
			<input type="submit"  name="accountreset_submit" value="Submit">
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