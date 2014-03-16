<html>
<head>
<title>CHANGE PASSWORD</title>


<?php 
include('./workspace_files/workspacesessionrelated.in');
include('master_head.in');

?>
<script type="text/javascript">
function changepasswordformvalidate()
{
	
	var oldpasswordele=document.getElementById('oldpassword');
	var newpasswordele=document.getElementById('newpassword');
	var confirmnewpasswordele=document.getElementById('confirmnewpassword');

	if(newpasswordele.value=='' || confirmnewpasswordele.value=='' || oldpasswordele.value=='')
	{
		alert("Please fill all the fields. None can be left blank");
		return false;
	}
	if(newpasswordele.value!=confirmnewpasswordele.value)
	{
		alert("The two new passwords do not match");
		newpasswordele.style.color='#cc0000';
		confirmnewpasswordele.style.color='#cc0000';
		return false;
	}
	if(newpasswordele.value.length<8)
	{
		alert('Password should be atleast 8 characters long');
		newpasswordele.style.color='#cc0000';
		confirmnewpasswordele.style.color='#cc0000';
		return false;
	}
	
	return true;
	
}
</script>

</head>
<?php
if($_SESSION['type']!='admin')
{
		echo "<body onload=\"adjustheightofpage('800px');expandcollapsesubmenu('submenu_myaccount');\">";
}
else
	echo "<body onload=\"expandcollapsesubmenu('submenu_myaccount');\">";

$currently_at='Workspace > Change my Password';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']))
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	
	$msg='';
	$result=false;
	if(isset($_POST['submit_passwordchange']))
	{
		//check if including this in a recruiter/student page is safe
		
		$username=$_SESSION['username'];
		$usertype=$_SESSION['type'];
		if($usertype=='student')
		{
			$table_name='login_students';
			include('./sql_connect_login.php');
		}
		else if($usertype=='recruiter')
		{
			$table_name='login_recruiters';
			include('./sql_connect_login.php');
		}
		else if($usertype=='admin')
		{
			$table_name='login_admin';
			include('./sql_connect_all.php');
		}
		$ct=mysqli_query($db,'select CURRENT_TIMESTAMP() from dual');
		if($ct)
		{
			$ct=mysqli_fetch_array($ct);
			$curtime=$ct[0];
		}
		else
		{
			date_default_timezone_set('Asia/Kolkata');
			$curtime= date("Y-m-d H:i:s");
		}
		$oldpassword=mysqli_real_escape_string($db,strip_tags($_POST['oldpassword']));
		$newpassword=mysqli_real_escape_string($db,strip_tags($_POST['newpassword']));
		$confirmnewpassword=mysqli_real_escape_string($db,strip_tags($_POST['confirmnewpassword']));
		if($newpassword!=$confirmnewpassword)
		{
			$res=1;
			$dontmatch=1;
		}
		else
		{
			$query="update $table_name set password = SHA1('$newpassword'),lastpasswordchange=CURRENT_TIMESTAMP() where username = '$username' and password=SHA1('$oldpassword')";
			
			$res=mysqli_query($db,$query);
		}
		if($res)
		{
			
			
			if(!(isset($dontmatch)))
				$num=mysqli_affected_rows($db);
			else 
				$num=-1;
			if($num==0)
			{
				$msg="Wrong password";
				$result=false;
			}
			else if($num==1)
			{
				$msg="Password changed successfully";
				$_SESSION['logintime']=$curtime;
				$result=true;
			}
			else if($num==-1)
			{
				$msg="Two two new passwords don't match";
				$result=false;
			}
		}
		else
		{
			$msg="Query didn't execute successfully";
		}
		
	}
	
	$content.='
	<fieldset style="height:200px;width:500px">
	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Change your password</b></span></legend>
	<div style="position:absolute;left:50px;top:30px;width:454px;height:371px;z-index:9;">
	<form name="form_changepassword" method="post" action=""  >
	<div style="position:absolute;left:10px;top:15px;width:184px;height:16px;z-index:0;text-align:left;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">CONFIRM OLD PASSWORD:</span></div>
	<input type="password"  style="position:absolute;left:204px;top:15px;width:198px;height:23px;line-height:23px;z-index:1;" name="oldpassword"  id="oldpassword" value="">
	<div style="position:absolute;left:10px;top:45px;width:184px;height:16px;z-index:2;text-align:left;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">NEW PASSWORD:</span></div>
	<input type="password"  style="position:absolute;left:204px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;" name="newpassword" id="newpassword" value="">
	<div style="position:absolute;left:10px;top:75px;width:184px;height:16px;z-index:4;text-align:left;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">CONFIRM NEW PASSWORD:</span></div>
	<input type="password"  style="position:absolute;left:204px;top:75px;width:198px;height:23px;line-height:23px;z-index:5;" name="confirmnewpassword" id="confirmnewpassword"value="">
	<input type="submit"  name="submit_passwordchange" value="Submit" style="position:absolute;left:85px;top:122px;width:96px;height:25px;z-index:6;">
	<input type="reset"  name="" value="Reset" style="position:absolute;left:242px;top:124px;width:96px;height:25px;z-index:7;">
	<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;top:155px;left:100px;';
	if($result)
		$content.='color:green">';
	else
		$content.='color:red">';
	$content.="$msg";
	$content.='</span>
	</form>
	</div>
	</fieldset>
	';
	
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