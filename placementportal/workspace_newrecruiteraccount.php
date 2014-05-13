<html>
<head>
<title>NEW RECRUITER ACCOUNT</title>

<?php 
include('master_head.in');
include('./workspace_files/workspacesessionrelated.in');
?>
<script type="text/javascript" src="./workspace_files/recruiterformvalidate.js">

</script>
</head>
<body onload='expandcollapsesubmenu("submenu_recruiteraccounts");'>
<?php
//$todo is '' if newrecruiter info has to be entered. $todo is 'new' if newrecruiterinfo has been entered and now mysql query has to be run
//$todo is 'done' if mysql query has executed successfully and the form needn't be printed again. $todo is editnew if the mysqlquery failed because
//the username provided already existed in database. now the form is displayed again with previous values and a different username is asked and $todo will be 'new' when submitted

//$todo is 'edit' when a recruiter's info has to be editted. the form is displayed with previous values filled and $todo will be 'editnew'
$currently_at='Workspace > New Recruiter Account';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$todo='';
	if(isset($_POST['todo']))
		$todo=$_POST['todo'];
	if($todo=='edit')
	{
				include('sql_connect_ro.php');
			$username=mysqli_real_escape_string($db,strip_tags($_POST['recruiter_username']));
		
			$query="select * from recruiters_data where username= '$username'";
			$res=mysqli_fetch_array(mysqli_query($db,$query));
			if(empty($res))
			{
				header("Location: ./workspace_editrecruiteraccount.php?prev=fail");
			}
			else
				include('./workspace_files/recruiter_assignvalues.in');
			
			mysqli_close($db);

			
	}
	else if($todo=='new')
	{
		include('sql_connect_all.php');
		$username=mysqli_real_escape_string($db,strip_tags($_POST['username']));
		$password=mysqli_real_escape_string($db,strip_tags($_POST['password']));
		$address=mysqli_real_escape_string($db,strip_tags($_POST['address']));
		$contactno=mysqli_real_escape_string($db,strip_tags($_POST['contactno']));
		$emailaddress=mysqli_real_escape_string($db,strip_tags($_POST['emailaddress']));
		$nameoforganisation=mysqli_real_escape_string($db,strip_tags($_POST['nameoforganisation']));
		$prequery="select username from recruiters_data where username = '$username'";
		$preres=mysqli_num_rows(mysqli_query($db,$prequery));
		if($preres==0)
		{
			$query="insert into recruiters_data values('$username','$nameoforganisation','$address',$contactno,'$emailaddress')";
			$query2="insert into login_recruiters values('$username',SHA1('$password'),CURRENT_TIMESTAMP(),NULL,CURRENT_TIMESTAMP())";
			$res=mysqli_query($db,$query);
			$error[]=mysqli_error($db);
			$res2=mysqli_query($db,$query2);
			$error[]=mysqli_error($db);
			if($res)
			{
				$content.="Data of recruiter $username inserted successfully in the database";
			}
			else
			{
				$content.="Data of recruiter $username could not be inserted in the database";
				foreach($error as $val)
				$content.="<br /> $val";
			}
			$todo='done';
		}
		else
		{
			$todo='new_editusername';
		}
		mysqli_close($db);
	}
	else if($todo=='editnew')
	{
		include('sql_connect_all.php');
		$username=mysqli_real_escape_string($db,strip_tags($_POST['username']));
		$address=mysqli_real_escape_string($db,strip_tags($_POST['address']));
		$contactno=mysqli_real_escape_string($db,strip_tags($_POST['contactno']));
		$nameoforganisation=mysqli_real_escape_string($db,strip_tags($_POST['nameoforganisation']));
		$emailaddress=mysqli_real_escape_string($db,strip_tags($_POST['emailaddress']));
		$query2="delete from recruiters_data where username = '$username'";
		$res2=mysqli_query($db,$query2);
		$content.="Deleting old data... <br />";
		if($res2)
		{
			$content.="Old data of user $username deleted successfully <br />";
		
			$query3="insert into recruiters_data values('$username','$nameoforganisation','$address',$contactno,'$emailaddress')";
			$res3=mysqli_query($db,$query3);
			$content.="Entering new data.... <br />";
			
			if($res3)
			{
				$content.="New data of user $username entered successfully <br />";
			}
			else
			{
				$content.="New data of user $username couldn't be entered successfully";
				$content.=mysqli_error($db);
				$content.=$query3;
			}
		}
		else
		{
			$content.="Error in deleting old data of user $username";
		}
		$todo="done";
	}
	if($todo!='done')
	{
		if($todo)
		{
			echo '
			<script type="text/javascript">
			nameoforgdone=true;
			usernamedone=true;
			passdone=true;
			addressdone=true;
			contactnodone=true;
			emailaddressdone=true;
			</script>';
		}
		$content='
		<div style="position:absolute;left:0px;top:0px;width:800px;height:259px;z-index:16 ;">
		<fieldset style="position:absolute;width:700px;height:300px;">
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>New Recruiter Account</b></span></legend>
		<div name="form_recruiter" style="position:absolute;left:70px;top:30px;width:414px;height:342px;z-index:13;">
		<form name="newrecruiter" method="post" action="" onsubmit="return validateonsubmit()">
		<div style="position:absolute;left:10px;top:15px;width:174px;height:16px;z-index:0;text-align:left;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">NAME OF ORGANISATION: </span></div>
		<input id="nameoforganisation" type="text" style="position:absolute;left:194px;top:15px;width:198px;height:23px;line-height:23px;z-index:1;" name="nameoforganisation" value="';
		if($todo)
		{
			$content.=$nameoforganisation;
		}
		$content.='" onblur="nameoforgvalidate()">
		<div style="position:absolute;left:10px;top:45px;width:174px;height:16px;z-index:2;text-align:left;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">USER NAME :</span></div>
		
		';
		if($todo=='edit')
		{
			$content.='<input id="username" type="hidden" style="position:absolute;left:194px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;" name="username" value="';
			$content.=$username;
			$content.='">';
			$content.='<span style="position:absolute;left:194px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;color:#000000;font-family:Arial;font-size:13px;" >';
			$content.=$username;
			$content.='</span>';
		}
		else
		{
			$content.='<input id="username" type="text" style="position:absolute;left:194px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;" name="username" value="';
			if($todo)
			$content.=$username;
			$content.='" onblur="usernamevalidate()">';
			if($todo=='new_editusername')
			{
				$content.='<span style="position:absolute;left:395px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;color:#000000;font-family:Arial;font-size:10px;color:red;">A Recruiter already exists by this username</span>';
			}
		}
		if($todo!='edit')
		{
			$content.='
		
			<div  style="position:absolute;left:10px;top:75px;width:174px;height:16px;z-index:4;text-align:left;">
			<span style="color:#000000;font-family:Arial;font-size:13px;">PASSWORD:</span></div>
			<input id="password" type="password"  style="position:absolute;left:194px;top:75px;width:198px;height:23px;line-height:23px;z-index:5;" name="password" value="';
			if($todo)
			{
				$content.=$password;
			}
			$content.='" onblur="passwordvalidate()">
			<div  style="position:absolute;left:10px;top:105px;width:174px;height:16px;z-index:6;text-align:left;">
			<span style="color:#000000;font-family:Arial;font-size:13px;">CONFIRM PASSWORD:</span></div>
			<input id="confirmpassword" type="password" style="position:absolute;left:194px;top:105px;width:198px;height:23px;line-height:23px;z-index:7;" name="confirmpassword" value="';
			if($todo)
			{
				$content.=$password;
			}
			$content.='" onblur="passwordvalidate()">';
		}
		$content.='
		<div  style="position:absolute;left:10px;top:135px;width:174px;height:16px;z-index:8;text-align:left;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">ADDRESS:</span></div>
		<input id="address" type="text"  style="position:absolute;left:194px;top:135px;width:198px;height:23px;line-height:23px;z-index:9;" name="address" value="';
		if($todo)
		{
			$content.=$address;
		}
		$content.='" onblur="addressvalidate()">
		<div  style="position:absolute;left:10px;top:165px;width:174px;height:16px;z-index:10;text-align:left;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">CONTACT NUMBER:</span></div>
		<input id="contactno" type="text"  style="position:absolute;left:194px;top:165px;width:198px;height:23px;line-height:23px;z-index:11;" name="contactno" value="';
		if($todo)
		{
			$content.=$contactno;
		}
		$content.='" onblur="contactnovalidate()">
		<div  style="position:absolute;left:10px;top:195px;width:174px;height:16px;z-index:10;text-align:left;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">EMAIL ADDRESS:</span></div>
		<input id="emailaddress" type="email"  style="position:absolute;left:194px;top:195px;width:198px;height:23px;line-height:23px;z-index:11;" name="emailaddress" value="';
		if($todo)
		{
			$content.=$emailaddress;
		}
		$content.='" onblur="emailaddressvalidate()">
		<input type="hidden" value="';
		if($todo=='edit')
			$content.='editnew';
		else
			$content.='new';
		$content.='" name="todo">
		<input type="reset" value="reset" style="position:absolute;left:14px;top:245px;width:198px;height:35px;line-height:23px;z-index:11;" >
		<input type="submit" value="submit" name="newrec_submit" style="position:absolute;left:254px;top:245px;width:198px;height:35px;line-height:23px;z-index:11;" >
	
		</form>
		</div>
		</fieldset>
		</div>';
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