<html>
<head>
<title>NEW STUDENT INFORMATION</title>

<?php 
include('master_head.in');
session_start();
?>

</script>
</head>
<body>
<?php
$currently_at='Workspace > New Recruiter Account';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	
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
				$content.="$query";
				header("Location: ./workspace_editrecruiteraccount.php?prev=fail&query=$query");
			}
			else
				include('./workspace_files/recruiter_assignvalues.in');
				include('./workspace_files/vertical_menu_workspace.in');
			mysqli_close($db);

			
	}
	//had to transfer the javascript to the place below to avoid  a header problem
	?>
	
	<script type="text/javascript">
var nameoforgdone=false;
var usernamedone=false;
var passdone=false;
var addressdone=false;
var contactnodone=false;
function validateonsubmit()
{

	if(nameoforgdone && passdone && usernamedone && addressdone &&  contactnodone)
	{
		return true;
	}
	else
	{
		alert('Please correct the red/blank fields');
		return false;
	}
}
function nameoforgvalidate()
{
	var nameoforgele=document.getElementById('nameoforganisation');
	
	if(nameoforgele.value=='')
	{
		nameoforgdone=false;
		nameoforgele.style.color='#cc0000';
		alert("Field: Name of Organisation cannot be left blank");
	}
	else 
	{
		nameoforgele.style.color='#000000';
		nameoforgdone=true;
	}
}
function passwordvalidate()
{
	var passwordele=document.getElementById('password');
	var confirmpasswordele=document.getElementById('confirmpassword');
		if(passwordele.value!='' && confirmpasswordele.value!='')
		{
			if(passwordele.value!=confirmpasswordele.value )
			{
				alert('The two passwords do not match');
				passwordele.style.color='#cc0000';
				confirmpasswordele.style.color='#cc0000';
				confirmpasswordele.value='';
				passdone=false;
			}
			else if(passwordele.value.length<8)
			{
				alert('Password should be atleast 8 characters long');
				passwordele.style.color='#cc0000';
				confirmpasswordele.style.color='#cc0000';
				confirmpasswordele.value='';
				passdone=false;
			}
			else
			{	
				
				passwordele.style.color='#000000';
				confirmpasswordele.style.color='#000000';
				passdone=true;
			}
		}
		else
		{
			passdone=false;
		}
}
function contactnovalidate()
{
	var contactnoele=document.getElementById('contactno');
	var contactno=contactnoele.value;
	if(contactno=='')
	{
				contactnodone=false;
		contactnoele.style.color='#cc0000';
		alert("Field: Contact number cannot be left blank");
	}
	else if(!(contactno.match('[0-9]+$')))
	{
		contactnodone=false;
		contactnoele.style.color='#cc0000';
		alert("Field: Contact number can only contain digits");
	}
	else
	{
		contactnoele.style.color='#000000';
		contactnodone=true;
	}
}
function addressvalidate()
{
var addressele=document.getElementById('address');
	if(addressele.value=='')
	{
		addressdone=false;
		addressele.style.color='#cc0000';
		alert('Field: Address cannot be left blank');
		
	}
	else
	{
		addressele.style.color='#000000';
		addressdone=true;
	}
}
function usernamevalidate()
{
	var usernameele=document.getElementById('username');
	if(usernameele.value=='')
	{
		usernamedone=false;
		usernameele.style.color='#cc0000';
		alert("Field: Username cannot be left blank");
	}
	else
	{
		usernameele.style.color='#000000';
		usernamedone=true;
	}
}
<?php
	if($todo=='new')
	{
		include('sql_connect_all.php');
		$username=mysqli_real_escape_string($db,strip_tags($_POST['username']));
		$password=mysqli_real_escape_string($db,strip_tags($_POST['password']));
		$address=mysqli_real_escape_string($db,strip_tags($_POST['address']));
		$contactno=mysqli_real_escape_string($db,strip_tags($_POST['contactno']));
		$nameoforganisation=mysqli_real_escape_string($db,strip_tags($_POST['nameoforganisation']));
		$prequery="select username from recruiters_data where username = '$username'";
		$preres=mysqli_num_rows(mysqli_query($db,$prequery));
		if($preres==0)
		{
			$query="insert into recruiters_data values('$username',SHA1('$password'),'$nameoforganisation','$address',$contactno,CURRENT_TIMESTAMP())";
			$res=mysqli_query($db,$query);
			$error=mysqli_error($db);
			if($res)
			{
				$content.="Data of recruiter $username inserted successfully in the database";
			}
			else
			{
				$content.="Data of recruiter $username could not be inserted in the database";
				$content.="<br /> $error";
			}
			$todo='done';
		}
		else
		{
			$todo='editnew';
		}
		mysqli_close($db);
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
			</script>';
		}
		$content='
		<div style="position:absolute;left:0px;top:0px;width:800px;height:259px;z-index:16 ;">
		<fieldset style="position:absolute;width:700px;height:300px;">
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Enter details of recruiter</b></span></legend>
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
			if($todo=='editnew')
			{
				$content.='<span style="position:absolute;left:395px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;color:#000000;font-family:Arial;font-size:10px;color:red;">A Recruiter already exists by this username</span>';
			}
		}
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
		$content.='" onblur="passwordvalidate()">
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
		<input type="hidden" value="new" name="todo">
		<input type="reset" value="reset" style="position:absolute;left:14px;top:215px;width:198px;height:35px;line-height:23px;z-index:11;" >
		<input type="submit" value="submit" name="newrec_submit" style="position:absolute;left:254px;top:215px;width:198px;height:35px;line-height:23px;z-index:11;" >
	
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