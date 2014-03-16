<html>
<head>
<title>DELETE STUDENT INFORMATION</title>

<script src="./workspace_files/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript">
function confirmdelete()
{
	return confirm("Are you sure you want to delete this student's info?");
}
</script>

<link href="./workspace_files/tabcontent.css" rel="stylesheet" type="text/css" />
<?php 
include("./workspace_files/workspace_nsi_academic_head.in");
include("./workspace_files/workspace_nsi_intern_head.in");
include('master_head.in');

?>
</head>
<body  onload='expandcollapsesubmenu("submenu_studentdata");'  onload=''>>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Delete student information';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');
	$setflag=1;
	$admno='';
	if(isset($_POST['admno']))//if called by a page that sent the admno (from displaystudentinfo's DELETE button)
		$admno=$_POST['admno'];
	else if(isset($_POST['degree']) && isset($_POST['admyear']) && isset($_POST['branchrollno'])) // if called by a page that sent admno ingredients (from this page itself)
	{
		
		$degree=$_POST['degree'];
		$admyear=$_POST['admyear'];
		if(isset($_POST['branch']))
		{
			$branch=$_POST['branch'];
		}
		else if($degree=='U')
			$branch=strip_tags($_POST['branchbtech']);
		else if($degree=='I')
			$branch=strip_tags($_POST['branchmsc']);
		else if($degree=='P')
			$branch=strip_tags($_POST['branchmtech']);
		$admno=$degree.$admyear[2].$admyear[3].$branch;
		
			
		$branchrollno=strip_tags($_POST['branchrollno']);
		if($branchrollno<=9)
			$admno.="00";
		else if($branchrollno<=99)
			$admno.="0";
		$admno.=$branchrollno;
	}
	if($admno)
	{
		
		
		
		include("./sql_connect_ro.php");
		$set='true';
		$r=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_general where admno='$admno'"));
		$r2=mysqli_fetch_array(mysqli_query($db,"select count(*) from students_resume where admno='$admno'"));
		$r3=mysqli_fetch_array(mysqli_query($db,"select count(*) from login_students where username='$admno'"));
		if($r[0]==0 && $r2[0]==0 && $r3[0]==0)
		{
			$setflag=0;
		}
	
		mysqli_close($db);
		if($setflag==0) 
		{
			$content.="NO RECORDS FOUND FOR STUDENT $admno";
		}
		else
		{
			$query1="delete from students_general where admno='$admno'";
			$query2="delete from login_students where username='$admno'";
			$query3="delete from students_resume where admno='$admno'";
			

			$errors=array();
			include("./sql_connect_all.php");
			$res1=mysqli_query($db,$query1);
			$errors[]=mysqli_error($db);
			$res2=mysqli_query($db,$query2);
			$errors[]=mysqli_error($db);
			$res3=mysqli_query($db,$query3);
			$errors[]=mysqli_error($db);
			
			if(!($res1) || !($res2) || !($res3))
			{
				foreach($errors as $val)
				{
					$content.="$val<br />";
				}
				$content.="Could not delete all data for $admno. Please delete garbage data";
			}
			else
			{
				$content.="Information for student $admno was successfully deleted from the database";
			}
			mysqli_close($db);
		}
		
	}
	else
	{
		if(isset($_GET['prev']))
		$prev=$_GET['prev'];
		else
			$prev="";
		include_once('./workspace_files/vertical_menu_workspace.in');
		$todo='delete';
		$content.='<fieldset style="height:70px;width:735px;"><legend><b>Delete Student Information</b></legend> Enter the Admission Number of the student:
			<form  action="" method="post" onsubmit="return confirmdelete()">';
			include('workspace_files/workspace_selectstudentbyadmno.in');
			$content.='<div style="position:absolute;left:550px;top:23px">
					<input type="submit"  name="deletestudent_submit" value="Delete">
					</div>';
					if($prev=='fail')
					{
						$content.="<div style='position:absolute;left:10px;top:60px;color:red'>
					 *The data of student $setadmno does not exist";
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