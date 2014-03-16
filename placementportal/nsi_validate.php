<html>
<head>
<title>NEW STUDENT INFORMATION</title>
<link rel="stylesheet" href="./workspace_files/style_verticalmenu.css" type="text/css" />

<?php 

include('master_head.in');

?>
</head>
<body>
<?php
session_start();
$currently_at='Workspace > New Student Entry Confirm';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	
//GENERAL
	$admyear=$_POST['admyear'];
	$branch=$_POST['branch'];
	$rollno="U".$admyear[2].$admyear[3].$branch;
	if($_POST['rollno']<=9)
		$rollno.="00";
	else if($POST['rollno']<=99)
		$rollno.="0";
	$rollno.=$_POST['rollno'];
	$fullname=$_POST['fullname'];
	$category=$_POST['category'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$height=$_POST['height'];
	$weight=$_POST['weight'];
	$ecact=$_POST['ecact'];
	$adinfo=$_POST['adinfo'];
//ACADEMIC
	$year10=$_POST['year10'];
	$year12=$_POST['year12'];
	$perc10=$_POST['perc10'];
	$perc12=$_POST['perc12'];
	$topicseminar=$_POST['topicseminar'];
	$topicproject=$_POST['topicproject'];
	$myspga1=$_POST['mysgpa1'];
	$myspga2=$_POST['mysgpa2'];
	$myspga3=$_POST['mysgpa3'];
	$myspga4=$_POST['mysgpa4'];
	$myspga5=$_POST['mysgpa5'];
	$myspga6=$_POST['mysgpa6'];
	$myspga7=$_POST['mysgpa7'];
	$myspga8=$_POST['mysgpa8'];
	$spga1=$_POST['sgpa1'];
	$spga2=$_POST['sgpa2'];
	$spga3=$_POST['sgpa3'];
	$spga4=$_POST['sgpa4'];
	$spga5=$_POST['sgpa5'];
	$spga6=$_POST['sgpa6'];
	$spga7=$_POST['sgpa7'];
	$spga8=$_POST['sgpa8'];
	$listelectives=$_POST['listelectives'];
//CONTACT
	$permaddress=$_POST['permaddress'];
	$permmobno=$_POST['permmobno'];
	$permemail=$_POST['permemail'];
	$permphone=$_POST['permphone'];
	$presentaddress=$_POST['presentaddress'];
	$presentmobno=$_POST['presentmobno'];
	$presentemail=$_POST['presentemail'];
	$presentphone=$_POST['presentphone'];
//INTERNSHIP/TRAINING
	$intern_orgname1=$_POST['intern_orgname1'];
	$intern_orgname2=$_POST['intern_orgname2'];
	$intern_orgname3=$_POST['intern_orgname3'];
	$intern_orgname4=$_POST['intern_orgname4'];
	$intern_orgname5=$_POST['intern_orgname5'];
	$intern_field1=$_POST['intern_field1'];
	$intern_field2=$_POST['intern_field2'];
	$intern_field3=$_POST['intern_field3'];
	$intern_field4=$_POST['intern_field4'];
	$intern_field5=$_POST['intern_field5'];
	$intern_days1=$_POST['intern_days1'];
	$intern_days2=$_POST['intern_days2'];
	$intern_days3=$_POST['intern_days3'];
	$intern_days4=$_POST['intern_days4'];
	$intern_days5=$_POST['intern_days5'];
	if(isset($fullname) && isset($dob) && isset($permaddress) && isset($permmobno) && isset($permemail) && isset($permphone) && isset($year10) && isset($year12) && isset($perc10) && isset($perc12) && isset($board10) && isset($board12) && isset($sgpa1) && isset($sgpa2) && isset($sgpa3) && isset($sgpa4) && isset($sgpa5) && isset($sgpa6) && isset($mysgpa1) && isset($mysgpa2) && isset($mysgpa3) && isset($mysgpa4) && isset($mysgpa5) && isset($mysgpa6) )
	{
		$content="$rollno";
	
		include('./workspace_files/vertical_menu_workspace.in');
	}
	else
	{
	
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