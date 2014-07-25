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
include('./workspace_files/workspacesessionrelated.in');

$currently_at='Workspace > New Student Entry Confirm';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
		include('./workspace_files/vertical_menu_workspace.in');
	if(isset($_POST['nsi_submit']))
	{
//GENERAL
	include("./sql_connect_all.php");
	$todo=$_POST['todo'];
	$degree=mysqli_real_escape_string($db,strip_tags($_POST['degree']));
	$admyear=mysqli_real_escape_string($db,strip_tags($_POST['admyear']));
	$branch=mysqli_real_escape_string($db,strip_tags($_POST['branch']));
	/*else if($degree=='U')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchbtech']));
	else if($degree=='I')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmsc']));
	else if($degree=='P')
			$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmtech']));*/

	$admno=$degree.$admyear[2].$admyear[3].$branch;
	$branchrollno=(int)mysqli_real_escape_string($db,strip_tags($_POST['branchrollno']));
	if($branchrollno<=9)
		$admno.="00";
	else if($branchrollno<=99)
		$admno.="0";
	$admno.=$branchrollno;
	$fullname=mysqli_real_escape_string($db,strip_tags($_POST['fullname']));
	$category=mysqli_real_escape_string($db,strip_tags($_POST['category']));
	$dob=mysqli_real_escape_string($db,strip_tags($_POST['dob']));
	$gender=mysqli_real_escape_string($db,strip_tags($_POST['gender']));
	$height=(int)mysqli_real_escape_string($db,strip_tags($_POST['height']));
	$weight=(int)mysqli_real_escape_string($db,strip_tags($_POST['weight']));
	$ecact=mysqli_real_escape_string($db,strip_tags($_POST['ecact']));
	$adinfo=mysqli_real_escape_string($db,strip_tags($_POST['adinfo']));
	if($todo=='edit')
	{
		$deleteresume='';
		
		if(isset($_POST['deleteresume']))
			$deleteresume=mysqli_real_escape_string($db,strip_tags($_POST['deleteresume']));
		if($deleteresume!='')
		{
			
			$deleteresume='true';
		}
	}
//ACADEMIC
	$year10=(int)mysqli_real_escape_string($db,strip_tags($_POST['year10']));
	$year12=(int)mysqli_real_escape_string($db,strip_tags($_POST['year12']));
	$perc10=(float)mysqli_real_escape_string($db,strip_tags($_POST['perc10']));
	$perc12=(float)mysqli_real_escape_string($db,strip_tags($_POST['perc12']));
	$board10=mysqli_real_escape_string($db,strip_tags($_POST['board10']));
	$board12=mysqli_real_escape_string($db,strip_tags($_POST['board12']));
	$topicseminar=mysqli_real_escape_string($db,strip_tags($_POST['topicseminar']));
	$topicproject=mysqli_real_escape_string($db,strip_tags($_POST['topicproject']));
	$mysem1=mysqli_real_escape_string($db,strip_tags($_POST['mysem1']));
	$mysem2=mysqli_real_escape_string($db,strip_tags($_POST['mysem2']));
	$mysem3=mysqli_real_escape_string($db,strip_tags($_POST['mysem3']));
	$mysem4=mysqli_real_escape_string($db,strip_tags($_POST['mysem4']));
	$mysem5='0000-00';
	if(isset($_POST['mysem5']) && $_POST['mysem5']!='')
		$mysem5=mysqli_real_escape_string($db,strip_tags($_POST['mysem5']));
	$mysem6='0000-00';
	if(isset($_POST['mysem6']) && $_POST['mysem6']!='')
	$mysem6=mysqli_real_escape_string($db,strip_tags($_POST['mysem6']));
	$mysem7='0000-00';
	if(isset($_POST['mysem7']) && $_POST['mysem7']!='')
	$mysem7=mysqli_real_escape_string($db,strip_tags($_POST['mysem7']));
	$mysem8='0000-00';
	if(isset($_POST['mysem8']) && $_POST['mysem8']!='')
	$mysem8=mysqli_real_escape_string($db,strip_tags($_POST['mysem8']));
	$sgpa1=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa1']));
	$sgpa2=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa2']));
	$sgpa3=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa3']));
	$sgpa4=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa4']));
	$cgpa1=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa1']));
	$cgpa2=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa2']));
	$cgpa3=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa3']));
	$cgpa4=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa4']));
	$sgpa5=0.0;
	if(isset($_POST['sgpa5']) && $_POST['sgpa5']!='')
	$sgpa5=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa5']));
	$sgpa6=0.0;
	if(isset($_POST['sgpa6']) && $_POST['sgpa6']!='')
	$sgpa6=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa6']));
	$sgpa7=0.0;
	if(isset($_POST['sgpa7']) && $_POST['sgpa7']!='')
	$sgpa7=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa7']));
	$sgpa8=0.0;
	if(isset($_POST['sgpa8']) && $_POST['sgpa8']!='')
	$sgpa8=(float)mysqli_real_escape_string($db,strip_tags($_POST['sgpa8']));
	$cgpa5=0.0;
	if(isset($_POST['cgpa5']) && $_POST['cgpa5']!='')
	$cgpa5=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa5']));
	$cgpa6=0.0;
	if(isset($_POST['cgpa6']) && $_POST['cgpa6']!='')
	$cgpa6=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa6']));
	$cgpa7=0.0;
	if(isset($_POST['cgpa7']) && $_POST['cgpa7']!='')
	$cgpa7=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa7']));
	$cgpa8=0.0;
	if(isset($_POST['cgpa8']) && $_POST['cgpa8']!='')
	$cgpa8=(float)mysqli_real_escape_string($db,strip_tags($_POST['cgpa8']));
	$listelectives=mysqli_real_escape_string($db,strip_tags($_POST['listelectives']));
	$passfirstattempt='';
	if(isset($_POST['passfirstattempt']))
		$passfirstattempt=$_POST['passfirstattempt'];
	if($passfirstattempt=='')
	{
		$passfirstattemptdetails=mysqli_real_escape_string($db,strip_tags($_POST['passfirstattemptdetails']));
		$passfirstattempt='false';
	}
	else
	{
		$passfirstattemptdetails='';
		$passfirstattempt='true';
	}
	
//CONTACT
	$permaddress=mysqli_real_escape_string($db,strip_tags($_POST['permaddress']));
	$permmobno=mysqli_real_escape_string($db,strip_tags($_POST['permmobno']));
	$permemail=mysqli_real_escape_string($db,strip_tags($_POST['permemail']));
	$permphone=mysqli_real_escape_string($db,strip_tags($_POST['permphone']));
	$presentaddress=mysqli_real_escape_string($db,strip_tags($_POST['presentaddress']));
	$presentmobno=mysqli_real_escape_string($db,strip_tags($_POST['presentmobno']));
	$presentemail=mysqli_real_escape_string($db,strip_tags($_POST['presentemail']));
	$presentphone=mysqli_real_escape_string($db,strip_tags($_POST['presentphone']));
//INTERNSHIP/TRAINING

	$intern_orgname=$_POST['intern_orgname'];
	$intern_field=$_POST['intern_field'];
	$intern_days=$_POST['intern_days'];
	if($degree=='U')
	{
		if($branch=="CO")
			$branch2="Computer Engineering";
		else if($branch=="ME")
			$branch2="Mechanical Engineering";
		else if($branch=="EE")
			$branch2="Electrical Engineering";
		else if($branch=="EC")
			$branch2="Electronics and Communication Enginnering";
		else if($branch=="CH")
			$branch2="Chemical Engineering";
		else if($branch=="CE")
			$branch2="Civil Engineering";
		$degree2='Bachelor of Technology';
	}
	else if($degree=='P')
	{
		if($branch=="PS")
			$branch2='Power Systems';
		else if($branch=="TD")
			$branch2='Thermal System Design';
		else if($branch=="EC")
			$branch2='Communication System';
		else if($branch=="EN")
			$branch2='Environmental Enginnering';
		else if($branch=="VL")
			$branch2='VLSI and Embedded Systems';
		else if($branch=="CC")
			$branch2='CAD/CAM';
		else if($branch=="CO")
			$branch2='Computer Enginnering';
		else if($branch=="CH")
			$branch2='Chemical Engineering';
		else if($branch=="IP")
			$branch2='Industrial Process Equipment Design';
		else if($branch=="ME")
			$branch2='Mechanical Enginnering';
		else if($branch=="SM")
			$branch2='Soil Mechanics and Foundation Engineering';
		else if($branch=="EL")
			$branch2='Power Electronics and Electrical Drives';
		else if($branch=="TP")
			$branch2='Transportation Enginnering and Planning';
		else if($branch=="TM")
			$branch2='Turbo Machines';
		else if($branch=="WR")
			$branch2='Water Resources Engineering';
		else if($branch=="ST")
			$branch2='Structural Engineering';
		else if($branch=="UP")
			$branch2='Urban Planning';
		$degree2="Master of Technology";
	}
	else if($degree=='I')
	{
		if($branch=='PH')
			$branch2='Physics';
		else if($branch=='MA')
			$branch2='Mathematics';
		else if($branch=='CY')
			$branch2='Chemistry';
		$degree2="Master of Science";
	}
	
		$age=(time() - strtotime($dob))/31556926;
	if($height=="")
		$height=0;
	if($weight=="")
		$weight=0;
	
	if($todo=='edit')
	{
		$admnoreal=$admno;
		$admno.="temp";
	}
	$errors=array();
	//-----------FOR STUDENTS_GENERAL------------------------
	$query="insert into students_general values('$admno','$fullname','$degree2','$branch2','$branch','$admyear','$branchrollno','$category','$dob','$gender',$age,$height,$weight,'$ecact','$adinfo')";
	$res=mysqli_query($db,$query);
	if(!($res))
		$errors[]=("general".mysqli_error($db));
	//----------------------------------------------------------
	//---------------FOR STUDENTS_CONTACT----------------------
	$query2="insert into students_contact values('$admno','$presentaddress','$presentmobno','$presentphone','$presentemail','$permaddress','$permmobno','$permphone','$permemail')";
	$res2=mysqli_query($db,$query2);
	if(!($res2))
		$errors[]=("contact".mysqli_error($db));
	//---------------------------------------------------------
	//------------FOR STUDENT_ACADEMIC-------------------------
	
	$query3="insert into students_academic values('$admno','$year10',$perc10,'$board10','$year12',$perc12,'$board12',$sgpa1,$cgpa1,STR_TO_DATE('$mysem1','%Y-%m'),$sgpa2,$cgpa2,STR_TO_DATE('$mysem2','%Y-%m'),$sgpa3,$cgpa3,STR_TO_DATE('$mysem3','%Y-%m'),$sgpa4,$cgpa4,STR_TO_DATE('$mysem4','%Y-%m'),$sgpa5,$cgpa5,STR_TO_DATE('$mysem5','%Y-%m'),$sgpa6,$cgpa6,STR_TO_DATE('$mysem6','%Y-%m'),$sgpa7,$cgpa7,STR_TO_DATE('$mysem7','%Y-%m'),$sgpa8,$cgpa8,STR_TO_DATE('$mysem8','%Y-%m'),'$passfirstattempt','$passfirstattemptdetails','$topicseminar','$topicproject','$listelectives')";
	$res3=mysqli_query($db,$query3);
	if(!($res3))
		$errors[]="academic".mysqli_error($db);	
	//---------------------------------------------------------
	//------------FOR STUDENT_TRAINING-------------------------
	$content.="<br />";
	$res4='true';
	for($i=0;$i<7;$i++)
	{
		if(isset($intern_orgname[$i]) && isset($intern_days[$i]) && isset($intern_field[$i]) )
		{
			$orgname=mysqli_real_escape_string($db,strip_tags($intern_orgname[$i]));
			$days=(int)mysqli_real_escape_string($db,strip_tags($intern_days[$i]));
			$field=mysqli_real_escape_string($db,strip_tags($intern_field[$i]));
	
			if( $orgname!="" && $days!="" && $field!="")
			{
				$query4="insert into students_training values('$admno','$orgname',$days,'$field')";
				$r=mysqli_query($db,$query4);
				if(!($r))
				{
					$res4='false';
					$errors[]=("training".mysqli_error($db));
				}
			}
		}
		else
		{
		//	$content.="INTENSHIP not set for $i<br />";
		}
	}
	//---------------------------------------------------------
	//--------------FOR STUDENTS_RESUME------------------------
	$res5='true';
	$resumeset='false';
	
	if(isset($_FILES['resume']) && $_FILES['resume']['size']>0)
	{
	//	$content.="RESUMEINSIDE";
		if($todo=='edit')
			$newfilename=$admnoreal;
		else
			$newfilename=$admno;
		$resumeset='true';
		$filename=$_FILES['resume']['name'];
		$filetype=$_FILES['resume']['type'];
		$filesize=$_FILES['resume']['size'];
		$tname=$_FILES['resume']['tmp_name'];
		$extension = substr($filename, strripos($filename,'.'));
			
		$prequery="select MD5('$newfilename') from dual";
		$preres=mysqli_fetch_array(mysqli_query($db,$prequery));
		$newfilename=$preres[0];
		$newfilename.=$extension;
		
		
	//	$content.="nw filename $newfilename  <br />";
		/*$fp=fopen($tname,'r');
		$content_file=fread($fp,filesize($tname));
		$content_file=addslashes($content_file);
		fclose($fp);*/
		//************CHECK IF FILE AUTOMATICALLY REPLACED ON SERVER OR NOT****************
		
		$pathandname="./resumes/$newfilename";
		//$content.=$tname;
		if($extension!='.pdf' && $extension!='.docx' && $extension!='.doc')
		{
			$errors[]="Invalid Resume File Format";
			$res5=false;
		}
		else if($filesize>5242880)
		{
			$errors[]="Resume File Type not allowed";
			$res5=false;
		}
		else
		{
			if(move_uploaded_file($_FILES['resume']['tmp_name'],$pathandname))
			{
				$res5=true;
				$query5="insert into students_resume values('$admno',$filesize,'$extension','$pathandname')";
		
				$res5b=mysqli_query($db,$query5);
				$res5=$res5 & $res5b;
			}
			else
			{
			
				$res5=false;
			}
		}
			
		
		
		if(!($res5))
			$errors[]=("resume".mysqli_error($db));
		
	}	
	//-----------------------------------------------------------
	//-------------FOR STUDENT ACCOUNT---------------------------
	if($todo!='edit')
	{
			$query6="insert into login_students values('$admno',SHA1('$admno'),CURRENT_TIMESTAMP(),NULL,CURRENT_TIMESTAMP())";
		$res6=mysqli_query($db,$query6);
		if(!($res6))
			$errors[]=("account".mysqli_error($db));
	}
	//-----------------------------------------------------------
	//-------------REMOVE USELESS RECORDS :: AND DELETE OLD AND RENAME (FOR EDIT)------------------------
	$editgarbage=0;
	if(empty($errors))
	{
		if($todo=='edit')
		{
			$errorsb=array();
			$queryb1="delete from students_general where admno='$admnoreal'";
			$queryb2="delete from students_resume where admno='$admnoreal'";
			
			$resb1=mysqli_query($db,$queryb1);
			if(!($resb1))
			{
				$errorsb[]=mysqli_error($db);
			}
			$resb2='true';
			if($resumeset=='true' || $deleteresume=='true')
			{
				//FOR DELETING PREVIOUS RESUME-----------
				$prequery="select filepath from students_resume where admno='$admnoreal'";
				$preres=mysqli_query($db,$prequery);
				if($preres)
				{	
					$preres=mysqli_fetch_array($preres);
					if(isset($preres[0]))
					if(unlink($preres[0]))
					{	
						$content.="Old Resume Deleted";
					}
					else
						$content.="Old Resume couldn't be delete. Please delete manually.";
				}
				//---------------------------------------
				$resb2=mysqli_query($db,$queryb2);
				if(!($resb2))
				{
					$errorsb[]=mysqli_error($db);
				}
			}
			if($resb1 && $resb2)
			{
				$errorsc=array();
				$content.="Old records deleted successfully<br />";
				
			
				$queryc1="update students_general set admno='$admnoreal' where admno='$admno'";
			
				$queryc2="update students_resume set admno='$admnoreal' where admno='$admno'";
			
			
				$resc1=mysqli_query($db,$queryc1);
				if(!($resc1))
				{
					$errorsc[]=mysqli_error($db);
				}
				$resc2=mysqli_query($db,$queryc2);
				if(!($resc2))
				{
					$errorsc[]=mysqli_error($db);
				}
				if($resc1 && $resc2)
				{
					$content.="New records inserted successfully<br />";
				}
				else
				{
					$content.="New records couldn't be inserted successfully (ERROR IN RENAMING). Please rename records $admno to $admnoreal manually";
					$editgarbage=1;
					foreach($errorsc as $val)
					{
						$content.="<br /> $val";
					}
					//$content.="$queryc1<br />$queryc2<br />";
				}
			}
			else
			{
					$content.="Old data couldn't be deleted successfully. Please delete it manually and rename $admno to $admnoreal.";
					$editgarbage=1;
					foreach($errorsb as $val)
					{
						$content.="<br /> $val";
					}
				//	$content.="$queryb1<br />$queryb2<br />";
			}
		}
		else
		{
			$content.="Record for student $admno ($fullname) inserted successfully in the database";
		}
			//$content.="<br />$query<br />$query2<br />$query3<br />$query4<br />$query5<br />$query6<br />";
			
	}
	else
	{
		$content.="Record for student $admno not inserted successfully..";
		foreach($errors as $value)
		{
			$content.="<br />$value";
		}
		$content.="<br />Removing trash data...";
		$r1=mysqli_query($db,"delete from students_general where admno='$admno'");
		$r2=mysqli_query($db,"delete from students_resume where admno='$admno'");
		$r3=mysqli_query($db,"delete from login_students where username='$admno'");

		if($r1 && $r2 && $r3)
		{
			$content.="<br/>Trash data removed successfully";
			//$content.="<br />$query<br />$query2<br />$query3<br />$query4<br />$query6<br />";
		}
		else
		{
			$content.="<br /> Trash data couldn't be removed. Please remove manually";
		}
		
	}
	//if it just cannot be renamed why delete the whole entry
	//this section is for garbage created during editing
	if($editgarbage)
	{
	/*				$queryc1="delete from students_general where admno='$admno' or admno='$admnoreal'";
					$queryc1="update students_contact set admno='$admnoreal' where admno='$admno'";
					$queryc1="update students_academic set admno='$admnoreal' where admno='$admno'";
					$queryc1="update students_resume set admno='$admnoreal' where admno='$admno'";
					$queryc1="update students_training set admno='$admnoreal' where admno='$admno'";
					$resc1=mysqli_query($db,$queryc1);
					$resc2=mysqli_query($db,$queryc2);
					$resc3=mysqli_query($db,$queryc3);
					$resc4=mysqli_query($db,$queryc4);
					$resc5=mysqli_query($db,$queryc5);
					if($resc1 && $resc2 && $resc3 && $resc4 && $resc5)
					{
						$content.="New records inserted successfully<br />";
					}*/
					//FILL THIS APPROPRIATELY
	}
	//-----------------------------------------------------------

	}
	else
	{
		$content.="INVALID PAGE";
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