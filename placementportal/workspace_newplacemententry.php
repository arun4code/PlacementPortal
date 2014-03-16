<html>
<head>
<title>NEW PLACEMENT ENTRY</title>


<?php 

include('master_head.in');

?>
<script type="text/javascript">
function newplacementvalidate()
{
	var orgnameele=document.getElementById('organisationname');
	var placementdateele=document.getElementById('placementdate');
	
	var rec_un=document.getElementById('recruiter_username');
	if(rec_un.value=='----' && orgnameele.value=='')
	{
		alert("Please fill the Organisation Name box or select a recruiter name from the drop down");
		return false;
	}
	if(datevalidate(placementdateele))
	{
		return false;
	}
	return true;
}
function checkifother(obj)
{
	var orgnametextbox=document.getElementById('orgnametextbox');
	if(obj.value=='----')
	{
		orgnametextbox.style.display='block';
	}
	else
	{
		orgnametextbox.style.display='none';
	}
}
function datevalidate(obj)
{
	var dob=obj.value;
	var error="";
	if(dob=="")
	{
		error+="Field: Date of Placement cannot be left blank";
	}
	else if(!(dob.match("[0-9+$]")))
	{
		error+="Field: Date of Placement has invalid character";
	}
	else
	{
		var spl=dob.split('-');
		var d=new Date(spl[0],spl[1]-1,spl[2]);
		if(!(d  && d.getDate()==spl[2] && d.getMonth()==spl[1]-1))
		{
			
			error+="Field: Date of Placement has invalid input";
		}
		
	}
	if(error!='')
	alert(error);
	return error;
}
</script>
</head>
<body onload='expandcollapsesubmenu("submenu_placementinfo");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > New Placement Entry';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$msg='';
	if(isset($_POST['newplacement_submit']))
	{
		include('sql_connect_all.php');
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
		$rec_username=mysqli_real_escape_string($db,strip_tags($_POST['recruiter_username']));
		$orgname=mysqli_real_escape_string($db,strip_tags($_POST['organisationname']));
		if($rec_username=='----')
		{
			$rec_username='Not Available';
		}
		else
		{
			$r=mysqli_fetch_array(mysqli_query($db,"select nameoforganisation from recruiters_data where username='$rec_username'"));
			$orgname=$r[0];
		}
		
		$placementdate=mysqli_real_escape_string($db,strip_tags($_POST['placementdate']));
		$query="insert into students_placement values ('$admno','$orgname','$rec_username','$placementdate')";
		$checkquery="select count(*) from students_general where admno='$admno'";
		$checkres=mysqli_fetch_array(mysqli_query($db,$checkquery));
		if($checkres[0]==0)
		{
			$msg="<div style='color:red';>No student exists by the admission number $admno</div>";
		}
		else
		{
			//****************CURRENTLY NOT INSERTING FOREIGN KEY CONSTRAINT ON admno IN students_placement
			$res=mysqli_query($db,$query);
			
			if($res)
			{
				$msg="<div style='color:green;'>Placement information for $admno inserted successfully</div>";
			}
			else
			{
				$msg="<div style='color:red';>Placement information for $admno could not be inserted successfully<br />";
				$msg.=mysqli_error($db);
				$msg.="</div>";
			}
		}
			mysqli_close($db);
	}
	$todo='newplacement';
	$content.='<fieldset style="height:280px;width:735px;">
	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>New Placement Entry</b></span></legend>
	<span style="color:#000000;font-family:Arial;font-size:13px;">
	<div style="position:absolute;left:100px;top:50px;z-index:10">
	<form name="newplacemententry" method="post" action="" onsubmit="return newplacementvalidate()">
	<b>STUDENT ADMISSION NO. : </b>
	</div>
	<div style="position:absolute;left:100px;top:100px;z-index:10">
	<b>NAME OF ORGANISATION : </b>
	</div>
	<div style="position:absolute;left:100px;top:150px;z-index:10">
	<b>PLACEMENT DATE <br>(enter in yyyy-mm-dd format<br>if calender drop down <br>not available)*: </b>
	</div>
	<div style="position:absolute;left:100px;top:230px;z-index:10">
	';
	$content.="$msg";
	$content.='
	</div>
	<div style="position:absolute;left:0px;top:25px;z-index:10">
	';
	include('./workspace_files/workspace_selectstudentbyadmno.in');
	include('./sql_connect_ro.php');
	$r=mysqli_query($db,'select username,nameoforganisation from recruiters_data order by nameoforganisation');
	mysqli_close($db);
	$content.='
	</div>
	<div style="position:absolute;left:300px;top:100px;z-index:10;">
	<select name="recruiter_username" style="width:200px;" id="recruiter_username" onchange="checkifother(this)">
	';
	while($res=mysqli_fetch_array($r))
	{
		$username=$res[0];
		$orgname=$res[1];
		$content.="<option value='$username'>$orgname (Username: $username) </option>";
	}
	$content.='<option value="----">Other</option>
	</select>
	<div id="orgnametextbox" style="display:none;position:absolute;left:220px;top:0px;z-index:10">
	<input type="text" name="organisationname" id="organisationname">
	</div>
	</div>
	
	<input type="date" name="placementdate" id="placementdate" style="position:absolute;left:300px;top:150px;z-index:10" onblur="datevalidate(this)">
	
	<div style="position:absolute;left:300px;top:200px;z-index:10">

	<input type="submit" value="Submit" name="newplacement_submit">
	</form>
	</div>
	
	</span>
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