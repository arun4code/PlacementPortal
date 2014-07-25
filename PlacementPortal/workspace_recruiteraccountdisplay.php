<html>
<head>
<title>DISPLAY RECRUITER ACCOUNT</title>


<?php 

include('master_head.in');

?>
<script type="text/javascript">
function confirmdelete()
{
	var check=confirm("Are you sure you want to delete this recruiter's data from the database");
	return check;
}
</script>
</head>
<body onload='expandcollapsesubmenu("submenu_recruiteraccounts");' >
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Display Recruiter Account';
$content='';
$vertical_menu='';
$username='';
if(isset($_POST['username']))
{
	$username=$_POST['username'];
}
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || ($_SESSION['type']=='recruiter' && $_SESSION['username']==$username)))
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	include('./sql_connect_ro.php');
	if($username=='' && isset($_GET['username']))
	{
		$username=mysqli_real_escape_string($db,strip_tags($_GET['username']));
	}
	if($username!='')
	{

		$query="select * from recruiters_data where username='$username'";
		
		$res=mysqli_fetch_array(mysqli_query($db,$query));
		
		if(empty($res))
		{
			$content.="No recruiter exists by the username $username";
		}
		else
		{
			if($_SESSION['type']=='admin')
			{
				$query2="select createdon,lastlogin,lastpasswordchange from login_recruiters where username='$username'";
				$res2=mysqli_fetch_array(mysqli_query($db,$query2));
				$createdon=$res2['createdon'];
				$lastlogin=$res2['lastlogin'];
				$lastpasswordchange=$res2['lastpasswordchange'];
			}
			include('./workspace_files/recruiter_assignvalues.in');
			$content.='<div style="position:absolute;left:0px;top:0px;width:700px;height:540px;z-index:16 ;overflow:auto;">
				<fieldset style="position:absolute;width:650px;height:520px;">
				<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Display Recruiter Account</b></span></legend>
				<table name="recruiterinfo" style="position:absolute;left:20px;top:30px;width:604px;height:342px;z-index:13;text-align:left;vertical-align:middle;table-layout: fixed;word-wrap : break-word;" border="1"">
				<tbody>
				<tr>
				<td style="width:30%;">
				<span style="color:#000000;font-family:Arial;font-size:13px;"><b>NAME OF ORGANISATION: </b></span></td>
				<td style="width:70%;"><span style="color:#000000;font-family:Arial;font-size:13px;">';
					$content.=$nameoforganisation;
				$content.='
				</span>
				</td></tr>
				<tr>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;"><b>USER NAME :</b></span></td>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;" >';
				$content.=$username;
				$content.='</span>
				</td>
				</tr>
				<tr>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;"><b>ADDRESS :</b></span></td>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;">';
					$content.=$address;
				$content.='</span></td></tr>
				<tr>
				<td>
				
				<span style="color:#000000;font-family:Arial;font-size:13px;"><b>CONTACT NUMBER:</b></span></td>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;">';
					$content.=$contactno;
				$content.='</span></td>
				</tr>
				<tr>
				<td>

				<span style="color:#000000;font-family:Arial;font-size:13px;"><b>EMAIL ADDRESS:</b></span></td>
				<td>
				<span style="color:#000000;font-family:Arial;font-size:13px;">';
					$content.=$emailaddress;
				$content.='</span></td>
				</tr>
				
				';
				if($_SESSION['type']=='admin' )
				{
					$content.='
					<tr>
					<td>

					<span style="color:#000000;font-family:Arial;font-size:13px;"><b>CREATED ON :</b></span></td>
					<td>
					<span style="color:#000000;font-family:Arial;font-size:13px;">';
						$content.=$createdon;
					$content.='</span></td>
					</tr>
					<tr>
					<td>

					<span style="color:#000000;font-family:Arial;font-size:13px;"><b>LAST LOGIN :</b></span></td>
					<td>
					<span style="color:#000000;font-family:Arial;font-size:13px;">';
						$content.=$lastlogin;
					$content.='</span></td>
					</tr>
					<tr>
					<td>

					<span style="color:#000000;font-family:Arial;font-size:13px;"><b>LAST PASSWORD CHANGE :</b></span></td>
					<td>
					<span style="color:#000000;font-family:Arial;font-size:13px;">';
						$content.=$lastpasswordchange;
					$content.='</span></td>
					</tr>
					</tbody>
					</table>';
					$content.='
					<form name="recruiter_edit" method="post" action="./workspace_newrecruiteraccount.php">
					<input type="hidden" value="edit" name="todo">
					<input type="hidden" name="recruiter_username" value="';
					$content.=$username;
					$content.='">
					<input name="recedit_submit" type="submit" value="Edit" style="position:absolute;left:100px;top:480px;width:198px;height:35px;line-height:23px;z-index:11;" >
					</form>
					<form name="recruiter_delete" method="post" action="./workspace_recruiteraccountdelete.php" onsubmit="return confirmdelete()">
					<input type="hidden" name="recruiter_username" value="';
					$content.=$username;
					$content.='">
					<input type="submit" value="Delete" name="recdelete_submit" style="position:absolute;left:354px;top:480px;width:198px;height:35px;line-height:23px;z-index:11;"  >
					</form>
					';
				}
				else
				{
					$content.='	</tbody>
					</table>';
				}
			
				$content.='
				
				</fieldset>
				</div>';
		}
		mysqli_close($db);
	
	}
	else
	{
		if(isset($_GET['prev']) && $_GET['prev']=='fail')
		{
			$result='No recruiter exists by this username';
		}

		$content.='<fieldset style="height:70px;width:735px;"><legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Search By Username</b></span></legend>
		Enter the user name of the Recruiter :
	
			<form  action="" method="get">
            <div style="position:absolute;left:0px;top:23px">
			<input type="text" style="position:absolute;left:270px;top:0px;z-index:20;" name="username">';
		$content.='
				
				<input type="submit"  style="position:absolute;left:450px;top:0px;z-index:20;" name="submit" value="Submit">
				</div>';
				if(isset($result))
				{
					$content.="<div style='position:absolute;left:10px;top:60px;color:red'>
					$result</div>";
				}
			$content.='
		</form>
			
		</fieldset>';
		$content.='<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;top:100px;left:300px;">OR</span>
		<fieldset style="position:absolute;top:130px;height:100px;width:735px;">
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Search by Organisation Name/Location</b></span></legend>
			<form  action="./workspace_recruitersearchresults.php" method="post">
			   <div style="position:absolute;left:10px;top:23px">
			    Organisation: 
			<input type="text" style="position:absolute;left:270px;top:0px;z-index:20;" name="nameoforganisation">
			</div>
			 <div style="position:absolute;left:10px;top:50px">
			    Location:
			<input type="text" style="position:absolute;left:270px;top:0px;z-index:20;" name="location">
				
				</div>
				 <div style="position:absolute;left:10px;top:77px">
			    Sort By:
			<select  style="position:absolute;left:270px;top:0px;z-index:20;width:170px;" name="sortby">
				<option value="" >- - - - - - -</option>
				<option value="nameoforganisation">NAME OF ORGANISATION</option>
				<option value="address">LOCATION</option>
				</select>
				<input type="submit"  style="position:absolute;left:450px;top:0px;z-index:20;" name="recruitersearch_submit" value="Submit">
				</div>
				';
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