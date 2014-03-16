<html>
<head>
<title>FIND STUDENT INFORMATION - BY ADMISSION NUMBER</title>


<?php 

include('master_head.in');

?>
</head>
<?php
include('./workspace_files/workspacesessionrelated.in');
if($_SESSION['type']!='admin')
{
		echo "<body onload=\"adjustheightofpage('800px');expandcollapsesubmenu('submenu_findstudentinfo');\">";
}
else
	echo "<body onload=\"expandcollapsesubmenu('submenu_findstudentinfo');\">";
$currently_at='Workspace > Find Student Information';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter'))
{
	
	if(isset($_POST['displayinfosubmit']))
	{
		
		$degree= $_POST['degree'] ;
		$admyear= $_POST['admyear']; 
		if($degree=='U')
				$branch= $_POST['branchbtech'] ;
		else if($degree=='I')
				$branch= $_POST['branchmsc'] ;
		else if($degree=='P')
				$branch= $_POST['branchmtech'] ;

		$admno=$degree.$admyear[2].$admyear[3].$branch;
		$branchrollno= $_POST['branchrollno'] ;
		if($branchrollno<=9)
			$admno.="00";
		else if($branchrollno<=99)
			$admno.="0";
		$admno.=$branchrollno;
		header("Location: ./workspace_studentinfodisplay.php?admno=$admno");
			//include('master_body.in');
	}
	else
	{
		include_once('./workspace_files/vertical_menu_workspace.in');
		$todo="new";
		$content.='<fieldset style="height:70px;width:735px;"><legend><b>Find Student Infomation</b></legend> Enter the Admission Number of the student:
		<form action="" method="post">';
		include('./workspace_files/workspace_selectstudentbyadmno.in');
		$content.='
		<div style="position:absolute;left:550px;top:23px">
				<input type="submit"  name="displayinfosubmit" value="Submit">
				</div>
		</form>
		
		</fieldset>';
		include('master_body.in');
		
	}
	
}
else if(isset($_SESSION['type']))
{
	$vertical_menu='';
	$content='<div style="position:absolute;left:0px;top:0px;width:500px;height:259px;z-index:16 ;">
	You are not authorised to view this page	
	</div>';
	include('master_body.in');
}
else
{
$vertical_menu='';
$content= '
<div style="position:absolute;left:0px;top:0px;width:200px;height:259px;z-index:16 ;">
Please log in to view this page
</div>
';
include('master_body.in');
}

?>
</body>
</html>