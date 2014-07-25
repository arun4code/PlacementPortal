<html>
<head>
<title>NEW STUDENT INFORMATION</title>

<script src="./workspace_files/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript" src="./workspace_files/studentformvalidate.js">
</script>
<link href="./workspace_files/tabcontent.css" rel="stylesheet" type="text/css" />
<?php 
include("./workspace_files/workspace_nsi_academic_head.in");
include("./workspace_files/workspace_nsi_intern_head.in");
include('master_head.in');

?>
</head>
<body  onload='expandcollapsesubmenu("submenu_studentdata");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > New student information';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$setflag=0;
	$setadmno="";
	$set='true';
	$todo="";
	if(isset($_POST['prensisubmit']) && isset($_POST['todo']))
	{
		include("./sql_connect_ro.php");
		$todo=$_POST['todo'];
		$degree=mysqli_real_escape_string($db,strip_tags($_POST['degree']));
	$admyear=mysqli_real_escape_string($db,strip_tags($_POST['admyear']));
		if(isset($_POST['branch']))
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branch']));
		else if($degree=='U')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchbtech']));
		else if($degree=='I')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmsc']));
		else if($degree=='P')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmtech']));
		$setadmno=$degree.$admyear[2].$admyear[3].$branch;
		
			
	$branchrollno=mysqli_real_escape_string($db,strip_tags($_POST['branchrollno']));
	if($branchrollno<=9)
		$setadmno.="00";
	else if($branchrollno<=99)
		$setadmno.="0";
	$setadmno.=$branchrollno;
	
		$r=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_general where admno='$setadmno'"));
		$r2=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_contact where admno='$setadmno'"));
		$r3=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_academic where admno='$setadmno'"));
		$r4=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_training where admno='$setadmno'"));
		$r5=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_resume where admno='$setadmno'"));
		if(($r[0]==1 || $r2[0]==1 || $r3[0]==1 || $r4[0]>0 || $r5[0]==1) && $todo=='new')
		{
			$setflag=0;
			$set='false';
		}
		else if($todo=='edit' && (!($r[0]==1 || $r2[0]==1 || $r3[0]==1 || $r4[0]>0 || $r5[0]==1)))
		{
			$setflag=2;
		}
		else
		{
			$setflag=1;
		}
		mysqli_close($db);
	}
	if($setflag==2)//FOR EDITING: if the student to be editted is not found
	{
		header("Location: ./workspace_editstudentinfo.php?prev=fail&admno=$setadmno");
		$content.="No records found for student $setadmno";
		
	}
	else if($setflag==0) // FOR NEW STUDENT INFO: to first ask for the admno of the student to be entered
	{
		$todo="new";
		$content.='<fieldset style="height:70px;width:735px;"><legend><b>New Student Infomation</b></legend> Enter the Admission Number of the student:
		<form name="prensi" action="" method="post">';
		include('./workspace_files/workspace_selectstudentbyadmno.in');
		$content.='
		<div style="position:absolute;left:550px;top:23px">
				<input type="submit"  name="prensisubmit" value="Submit">
				</div>';
				if($set=='false')
				{
					$content.="<div style='position:absolute;left:10px;top:60px;color:red;'>
				*The data of student $setadmno already exists
				</div>";
				}
				$content.='
		</form>
		
		</fieldset>';
	}
	else //FOR ENTERING NEW STUDENT OR EDITING (decided by $todo)
	{
	if($todo=='edit')
	{
		//$admno=$setadmno;
		include('./sql_connect_ro.php');
		$query1="select * from students_general where admno='$setadmno'";
		$query2="select * from students_contact where admno='$setadmno'";
		$query3="select * from students_training where admno='$setadmno'";
		$query4="select * from students_resume where admno='$setadmno'";
		$query5="select * from students_academic where admno='$setadmno'";
		$res1=mysqli_fetch_array(mysqli_query($db,$query1));
		$res2=mysqli_fetch_array(mysqli_query($db,$query2));
		$r3=mysqli_query($db,$query3);
		$res4=mysqli_fetch_array(mysqli_query($db,$query4));
		$res5=mysqli_fetch_array(mysqli_query($db,$query5));
		$branchtemp=$branch;//THIS IS DONE BECAUSE THE FOLLOWING INCLUDED FILE WILL STORE THE FULL FORM OF BRANCH IN $branch. BUT the short form of branch (e.g. CO,EC) is need for edit
		include('./workspace_files/student_assignvalues.in');
		$branch=$branchtemp;
		mysqli_close($db);
	}
	$content='
		<form name="newstudentinfo" action="./nsi_submit.php" method="post" enctype="multipart/form-data" onsubmit="return student_validate()">
		<input type="hidden" name="todo" value="';
	$content.="$todo";
	$content.='">
		
		<div style="width: 700px; margin: 0 auto; padding: 20px 0 40px; font: 0.85em arial;">
		<div style="left:10px;top:0px;width:500px;height:25px;z-index:2;">Enter Student Information. Fields marked with asterisk (*) are compulsory</div>
        <ul class="tabs" persist="true">
            <li><a href="#" rel="view1">General</a></li>
            <li><a href="#" rel="view2">Contact</a></li>
            <li><a href="#" rel="view3">Academic</a></li>
            <li><a href="#" rel="view4">Training/Internship</a></li>
        </ul>
        <div class="tabcontents">
			
            <div id="view1" class="tabcontent" style="height:550px">
                <!gen starts--------------->';
				include("./workspace_files/workspace_nsi_gen_body.in");
	$content.='
				<!END OF view1--------------------------------->
			</div>
			<div id="view2" class="tabcontent" style="height:400px">
               ';
			
				include("./workspace_files/workspace_nsi_contact_body.in");
	$content.='
				<!------------------------------------------------>
            </div>
            <div id="view3" class="tabcontent" style="height:850px">
               
			   <!------------------------------------------------>';
				include("./workspace_files/workspace_nsi_academic_body.in");
			   
	$content.='
            </div>
            <div id="view4" class="tabcontent" style="height:600px">
				';
				include("./workspace_files/workspace_nsi_intern_body.in");
	$content.='
            </div>
        </div>
        <br /><br />

    </div>
	</form>';
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