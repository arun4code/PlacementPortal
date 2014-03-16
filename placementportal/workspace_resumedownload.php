
<?php
include('./workspace_files/workspacesessionrelated.in');
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin'|| $_SESSION['type']=='recruiter'))
{
	//include_once('./workspace_files/vertical_menu_workspace.in');
	include('./sql_connect_ro.php');
	if(isset($_GET['admno']))
	{
		$admno=$_GET['admno'];
		$query4="select * from students_resume where admno='$admno'";
		$res=mysqli_fetch_array(mysqli_query($db,$query4));
		//change the if condition if resume compulsary
		if($res)
		{
			$resumename=$res['admno'];
			$resumesize=$res['filesize'];
			$resumepath=$res['filepath'];
			$resumeextension=$res['fileextension'];

			
			
			//$size=filesize($file);
			
			//$i=$info['mime'];
			if($resumeextension=='.pdf')
				$i='application/pdf';
			else if($resumeextension=='.doc' )
				$i='application/msword';
			else if($resumeextension=='.docx')
				$i='application/vnd.openxmlformats-officedocument.wordprocessingml.document';
			else if($resumeextension=='.xls')
				$i='application/vnd.ms-excel';
			else if($resumeextension=='.xlsx')
				$i='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
			else if($resumeextension=='.png')
				$i='image/png';
			else if($resumeextension=='.jpg' || $resumeextension=='.jpeg')
				$i='image/jpg';
			else
			{
					$info=getimagesize($resumepath);
					$i=$info['mime'];
			}
			header("Content-Type: $i\n");
			header("Content-Disposition: inline; filename=\"$admno$resumeextension\"\n");
			header("Content-Length: $resumesize\n");
			readfile($resumepath);
			
		
		}
	}
	
	
}


?>