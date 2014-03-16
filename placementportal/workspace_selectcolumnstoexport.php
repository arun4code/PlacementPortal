<html>
<head>
<title>SELECT COLUMNS TO EXPORT</title>

<script type="text/javascript">
var allcolumns=document.getElementsByName("fields[]");

function selectall()
{
	
	for(var i=0;i<allcolumns.length;i++)
	{
	
		allcolumns[i].checked=true;
	}
}
function deselectall()
{
	for(var i=0;i<allcolumns.length;i++)
	{
	
		allcolumns[i].checked=false;
	
	}
	var admno_checkbox=document.getElementById('admno_checkbox');
	admno_checkbox.checked=true;
}
</script>
<?php 

include('master_head.in');


?>
</head>
<body>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Student Search Results > Select columns to export';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin'  || $_SESSION['type']=='recruiter'))
{
	if(isset($_POST['filtersnsorts']))
	{
		$filtersnsorts=$_POST['filtersnsorts'];
		include('./workspace_files/vertical_menu_workspace.in');
		include('./workspace_files/student_nameofcolumns.in');
		$content.='<div id="exportfields" style="position:absolute;top:0px;">
		<fieldset style="position;absolute;width:730px;height:600px;"><legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Select the fields to be included in the exported file</b></span></legend>
		<form action="./workspace_export.php" method="post">
		
		<input type="checkbox" checked="checked" value="admno" name="fields[]" id="admno_checkbox" style="display:none;"></input>';
		foreach($nameofcolumns as $key=>$curcolumn)
		{
			if($curcolumn=='admno')
			{
				
				continue;
			}
			if($key%2==1)
			{
				$left='30px';
				$content.="<br>";
			}
			else
				$left='400px';
			$content.="<div style='position:absolute;left:$left;'><input type='checkbox' value='$curcolumn' name='fields[]'><span style='position:absolute;left:50px;width:250px;'>$actualnameofcolumns[$curcolumn]</span></input></div>";
			
		}
			
		$date=date("Y-m-d");
		$content.='
		<input type="hidden" name="query" value="';$content.=" from view_findstudents ";$content.=$filtersnsorts;$content.='">
		<input type="hidden" name="filename" value="CollegeStudents_';$content.=$date;$content.='">
		<input type="hidden" name="headings" value="actual">
		<div style="position:absolute;left:50px;top:580px;">
		<button type="button" value="Select All" onclick="selectall()">Select All</button>
		<button type="button" value="Deselect All" onclick="deselectall()">Deselect All</button>
		
		<input type="submit"  name="export_submit" value="Click Here to Export the Results">
		
		</form>
		</fieldset>
		</div>';
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
