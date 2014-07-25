<html>
<head>
<title>DELETE PLACEMENT ENTRY</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_placementinfo");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Delete Placement Entry';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include_once('./workspace_files/vertical_menu_workspace.in');

	if(isset($_POST['admno_orgname']))
	{
		$admno_orgnamelist=$_POST['admno_orgname'];
		include('sql_connect_all.php');
		$content.='
		<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Delete Results</b></span></legend>
		<br><br>';
		
		foreach($admno_orgnamelist as $admno_orgname)
		{
			$msg='';
			$admno_orgname=mysqli_real_escape_string($db,strip_tags($admno_orgname));
			$i=0;
			$lenstr=strlen($admno_orgname);
			while($i<$lenstr && $admno_orgname[$i]!='$')
			{
				$i++;
			}
			$admno=substr($admno_orgname,0,$i);
			$orgname=substr($admno_orgname,$i+1,$lenstr-1);
			$query="delete from students_placement where admno='$admno' and nameoforganisation = '$orgname'";
			$res=mysqli_query($db,$query);
			$affectedrows=mysqli_affected_rows($db);
		
			if($affectedrows==1)
			{
				$msg.="<div style='color:green;'>Placement information for ADMISSION NO.: $admno ORGANISATION NAME : $orgname deleted successfully</div>";
			}
			else
			{
				$msg.="<div style='color:red;'>No Placement information for ADMISSION NO.: $admno ORGANISATION NAME : $orgname was found<br />";
				$msg.="</div>";
			}
			
				$content.=$msg;
				$content.="<br>";
			
		}
		
		
		mysqli_close($db);
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