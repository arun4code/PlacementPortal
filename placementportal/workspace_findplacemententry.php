<html>
<head>
<title>FIND PLACEMENT ENTRY</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_placementinfo");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Find Placement Entry';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	
	$content.='<fieldset style="height:70px;width:735px;"><legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Search By Student</b></span></legend>
		Enter the admission no of the student:
	
			<form  action="./workspace_placementsearchresults.php" method="post">
            <div style="position:absolute;left:-40px;top:0px">';
			$todo='placementsearch';//NO ACTUAL NEED FOR THIS
			include('./workspace_files/workspace_selectstudentbyadmno.in');
		$content.='
				
				<input type="submit" name="placementsearchbyadmno_submit"  style="position:absolute;left:570px;top:25px;z-index:20;"  value="Submit">
				</div>';
			$content.='
		</form>
			
		</fieldset>';
		$content.='<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;top:100px;left:300px;">OR</span>
		<fieldset style="position:absolute;top:130px;height:100px;width:735px;">
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Search by Organisation Name</b></span></legend>
			<form  action="./workspace_placementsearchresults.php" method="post">
			   <div style="position:absolute;left:10px;top:23px">
			    Organisation Name: 
			<input type="text" style="position:absolute;left:150px;top:0px;z-index:20;" name="nameoforganisation">
			</div>
				 <div style="position:absolute;left:10px;top:77px">
			
				<input type="submit" name="placementsearchbyorgname_submit"  style="position:absolute;left:320px;top:-53px;z-index:20;" value="Submit">
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
