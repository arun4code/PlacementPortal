<html>
<head>
<title>STUDENT INFORMATION</title>

<script src="./workspace_files/tabcontent.js" type="text/javascript"></script>
<link href="./workspace_files/tabcontent.css" rel="stylesheet" type="text/css" />
<?php 
include("workspace_files/workspace_disp_academic_head.in");
include("workspace_files/workspace_disp_intern_head.in");
include('master_head.in');

?>
</head>
<body  onload='expandcollapsesubmenu("submenu_findstudentinfo");expandcollapsesubmenu("submenu_studentdata");' >
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Display Student Information';
$content='';
$vertical_menu='';
$admno='';
if(isset($_POST['admno']))
{
	$admno=$_POST['admno'];
}
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin'|| $_SESSION['type']=='recruiter' || ($_SESSION['type']=='student' && $_SESSION['username']==$admno)))
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	if($admno=='')
	{
		if(isset($_GET['admno']))
		{
			$admno=$_GET['admno'];
		}
		else if(isset($_POST['displaystudent_submit']))
		{
				include('./sql_connect_ro.php');
				
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
			mysqli_close($db);
		}
	}
	if($admno!='')
	{
		include('./sql_connect_ro.php');		
		$query1="select * from students_general where admno='$admno'";
		$query2="select * from students_contact where admno='$admno'";
		$query3="select * from students_training where admno='$admno'";
		$query4="select * from students_resume where admno='$admno'";
		$query5="select * from students_academic where admno='$admno'";
		$query6="select * from students_placement where admno='$admno'";
		$res1=mysqli_fetch_array(mysqli_query($db,$query1));
		$res2=mysqli_fetch_array(mysqli_query($db,$query2));
		$r3=mysqli_query($db,$query3);
		$res4=mysqli_fetch_array(mysqli_query($db,$query4));
		$res5=mysqli_fetch_array(mysqli_query($db,$query5));
		$r6=mysqli_query($db,$query6);
		if($_SESSION['type']=='admin')
		{
			$accquery="select createdon,lastlogin,lastpasswordchange from login_students where username='$admno'";
			$accres=mysqli_fetch_array(mysqli_query($db,$accquery));
			$lastlogin=$accres['lastlogin'];
			$createdon=$accres['createdon'];
			$lastpasswordchange=$accres['lastpasswordchange'];
		}
		mysqli_close($db);
		//change the if condition if resume compulsary
		//****TELL THE USER THAT SOME DATA IS ABSENT IN CASE DATA AVAILIABLE IN ONLY A FEW TABLES*********
		if(!($res1)) //|| !($res2) || !($r3) ||  !($res5))
		{
			header("Location: ./workspace_studentinfodisplay.php?prev=fail");
		}
		else
		{
		include('./workspace_files/student_assignvalues.in');
		
		$content.='

		<div style="width: 700px;position:absolute;left:0px; font: 0.85em arial;">
			<ul class="tabs" persist="true">
				<li><a href="#" rel="view1">General</a></li>
				<li><a href="#" rel="view2">Contact</a></li>
				<li><a href="#" rel="view3">Academic</a></li>
				<li><a href="#" rel="view4">Training/Internship</a></li>
				<li><a href="#" rel="view5">Placement Details</a></li>
			</ul>
			<div class="tabcontents">';
			
			if($_SESSION['type']=='admin')
			{
	 $content.="
				<b>
				<span style='position:absolute;left:25px;top:60px;color:#000000;font-family:Arial;font-size:13px;'>Created On : $createdon</span>
				<span style='position:absolute;left:25px;top:80px;color:#000000;font-family:Arial;font-size:13px;'>Last login : $lastlogin</span>
				<span style='position:absolute;left:25px;top:100px;color:#000000;font-family:Arial;font-size:13px;'>Last password change : $lastpasswordchange</span>
				</b>
				";
				$content.='
				<form action="./workspace_newstudentinfo.php" method="post">
				<input type="hidden" name="degree" value="';
				$content.="$admno[0]";
				$content.='">
				<input type="hidden" name= "admyear" value="';
				$content.="$admyear";
				$content.='">
				<input type="hidden" name= "branch" value="';
				$content.="$branchcode";
				$content.='">
				<input type="hidden" name= "branchrollno" value="';
				$content.="$branchrollno";
				$content.='">
				<input type="hidden" name="todo" value="edit">
				<input type="submit"  name="prensisubmit" value="Edit" style="position:absolute;left:430px;top:60px;width:96px;height:25px;z-index:19;">
				</form>
				<form action="./workspace_studentinfodelete.php" method="post" onsubmit="return confirmstudentinfodelete()">
				<input type="hidden" name="admno" value="';
				$content.="$admno";
				$content.='">
				<input type="submit"  name="delete" value="Delete" style="position:absolute;left:574px;top:60px;width:96px;height:25px;z-index:20;" >';

			}
			$content.='
				<div id="view1" class="tabcontent" style="height:650px">
					<!gen starts--------------->';
					include("./workspace_files/workspace_disp_gen_body.in");
		$content.='
					<!END OF view1--------------------------------->
				</div>
				<div id="view2" class="tabcontent" style="height:650px">
				   ';
				
					include("./workspace_files/workspace_disp_contact_body.in");
		$content.='
					<!------------------------------------------------>
				</div>
				<div id="view3" class="tabcontent" style="height:800px">
				   
				   <!------------------------------------------------>';
					include("./workspace_files/workspace_disp_academic_body.in");
				   
		$content.='
				</div>
				
				<div id="view4" class="tabcontent" style="height:600px">
					';
					include("./workspace_files/workspace_disp_intern_body.in");
		$content.='
				</div>
				<div id="view5" class="tabcontent" style="height:400px">
				   ';
				
					include("./workspace_files/workspace_disp_placement_body.in");
		$content.='
					<!------------------------------------------------>
				</div>
			</div>
			<br /><br />

		</div>
		';
		}
		
	}
	else
	{
		if(isset($_GET['prev']))
			$prev=$_GET['prev'];
		else
		$prev="";
		include_once('./workspace_files/vertical_menu_workspace.in');
		$todo='display';
		$content.='<fieldset style="height:70px;width:735px;"><legend><b> Display Student Information</b></legend> Enter the Admission Number of the student:
		<form  action="" method="post">';
		include('workspace_files/workspace_selectstudentbyadmno.in');
		$content.='<div style="position:absolute;left:550px;top:23px">
				<input type="submit"  name="displaystudent_submit" value="Submit">
				</div>';
				if($prev=='fail')
				{
					$content.="<div style='position:absolute;left:10px;top:60px;color:red'>
				 *The data of queried student does not exist";
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