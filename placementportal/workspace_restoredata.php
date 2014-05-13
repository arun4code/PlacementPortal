

<html>
<head>
<title>RESTORE DATA</title>

<script type="text/javascript">
function filevalidate(obj)
{
	var name=obj.value;
	var size=obj.files[0].size;
	if(name.substring(name.lastIndexOf('.'))!='.csv')
	{
		obj.value='';
		alert("Only .csv files are  allowed!");
	}
}
</script>
<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_backupandrestore");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Restore Data';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	if(isset($_POST['upload_submit']))
	{
		$reporterrors='';
		$reporterrorsaccount='';
		if(isset($_FILES['backup_general']) && $_FILES['backup_general']['size']>0)
		{
			$content.="<br /><b>For Student General  File </b><br />";
			
			$filename=$_FILES['backup_general']['name'];
			if(move_uploaded_file($_FILES['backup_general']['tmp_name'],$filename))
			{
				$tablename='students_general';
				$reporterrors.="\nFor Student General  File \n";
				$reporterrorsaccount.="\nFor making account for students\n";
				$makeuser=true;
				$username='';
				$usertable='login_students';
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
			
		}
		if(isset($_FILES['backup_contact']) && $_FILES['backup_contact']['size']>0)
		{
			$content.="<br /><b>For Student contact  File </b><br />";
			
			$filename=$_FILES['backup_contact']['name'];
			if(move_uploaded_file($_FILES['backup_contact']['tmp_name'],$filename))
			{
				$reporterrors.="\nFor Student contact  File \n";
			
				$tablename='students_contact';
				$makeuser=false;
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
			
		}
		if(isset($_FILES['backup_academic']) && $_FILES['backup_academic']['size']>0)
		{
			$content.="<br /><b>For Student academic  File </b><br />";
			
			$filename=$_FILES['backup_academic']['name'];
			if(move_uploaded_file($_FILES['backup_academic']['tmp_name'],$filename))
			{
				$reporterrors.="\nFor Student academic  File \n";
				$tablename='students_academic';
				$makeuser=false;
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
			
		}
		if(isset($_FILES['backup_training']) && $_FILES['backup_training']['size']>0)
		{
			$content.="<br /><b>For Student training  File </b><br />";
			
			$filename=$_FILES['backup_training']['name'];
			if(move_uploaded_file($_FILES['backup_training']['tmp_name'],$filename))
			{
				$reporterrors.="\nFor Student training  File \n";
			 $tablename='students_training';
			 $makeuser=false;
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
		}
		if(isset($_FILES['backup_placement']) && $_FILES['backup_placement']['size']>0)
		{
			$content.="<br /><b>For Student placement  File </b><br />";
			
			$filename=$_FILES['backup_placement']['name'];
			if(move_uploaded_file($_FILES['backup_placement']['tmp_name'],$filename))
			{
				$reporterrors.="\nFor Student placement  File \n";
			$tablename='students_placement';
			$makeuser=false;
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
		}
		if(isset($_FILES['backup_recruiters']) && $_FILES['backup_recruiters']['size']>0)
		{
			$content.="<br /><b>For Recruiter  File </b><br />";
			
			$filename=$_FILES['backup_recruiters']['name'];
			if(move_uploaded_file($_FILES['backup_recruiters']['tmp_name'],$filename))
			{
				$reporterrors.="\nFor Recruiter  File \n";
			$reporterrorsaccount.="\n For adding account of Recruiters\n";
			 $tablename='recruiters_data';
			 $makeuser=true;
			 $username='';
				$usertable='login_recruiters';
				include('./workspace_files/workspace_readfrombackupfile.in');
				unlink($filename);
			}
			else
			{
				$content.="Couldn't upload $filename successfully <br />";
			}
		}
		$reporterrors=addslashes($reporterrors).addslashes($reporterrorsaccount);
		$content.='<br><br><form method="post" action="./workspace_displaytext.php">
		<input type="hidden" name="message" value="';$content.=$reporterrors;$content.='" >
		<input type="hidden" name="filename" value="DataRestore_errors.txt">
		<input type="submit" value="CLICK HERE TO DOWNLOAD ERROR FILE" name="displaytext_submit">
		</form>';
		
	}
	else
	{
		
		$content='
		<fieldset style="height:600px;width:535px;"><legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Restore Data</b></span></legend>
		<div style="position:absolute;top:-320px;width:535px;">
		<span style="position:absolute;color:red;font-family:Arial;font-size:13px;top:350px;left0px;"><b>**For a student, insert the General records before inserting others </b></span>
		<span style="position:absolute;color:red;font-family:Arial;font-size:13px;top:370px;left0px;"><b>**Ensure that date is in yyyy-mm-dd or mm/dd/yyyy format</b></span>
		<span style="position:absolute;color:red;font-family:Arial;font-size:13px;top:390px;left0px;"><b>**Account for Recruiters will be made upon upload of Recruiter\'s Data</b></span>
		<span style="position:absolute;color:red;font-family:Arial;font-size:13px;top:410px;left0px;"><b>**Account for Students will be made upon upload of Student General Data</b></span>
		</div>
		<form name="restore_backup" method="post" action="" enctype="multipart/form-data">
		
		<table id="table_restore" style="position:absolute;left:20px;top:120px;width:400px;height:240px;z-index:2;border:1px #C0C0C0 solid;text-align:center;vertical-align:middle;" cellpadding="0" cellspacing="0" >
		<tbody><tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;"><b><u>DATA</u></b></span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;"><b><u>UPLOAD BACKUP FILE</u></b></span></td>
		</tr>
		<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Student General</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		
		<input type="file" name="backup_general" id="backup_general" onchange="filevalidate(this)">
		

		</td>
		</tr>
		<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Student Contact</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">

			<input type="file" name="backup_contact"  id="backup_contact" onchange="filevalidate(this)">

		</td>
		</tr>
		<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Student Academic</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">

			<input type="file" name="backup_academic"  id="backup_academic" onchange="filevalidate(this)">

		</td>
		</tr>
			<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Student Training</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">

			<input type="file" name="backup_training"  id="backup_training" onchange="filevalidate(this)">

		</td>
		</tr>
			<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Student Placement</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		
			<input type="file" name="backup_placement"  id="backup_placement" onchange="filevalidate(this)">
		
		</td>
		</tr>
			<tr>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		<span style="color:#000000;font-family:Arial;font-size:13px;">Recruiter Data</span></td>
		<td style="background-color:transparent;border:1px #C0C0C0 solid;">
		
		<input type="file" name="backup_recruiters"  id="backup_recruiters" onchange="filevalidate(this)">

		</td>
		</tr>
		</tbody>
		</table>
		<input type="submit" name="upload_submit" value="Upload" style="position:absolute;top:570px;z-index:40;left:60px;width:300px;height:30px;">
		</form>
		</fieldset>
		';
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