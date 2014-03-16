
<html>
<head>
<title>PLACEMENT STATISTICS</title>
<?php

include('master_head.in');
?>
</head>
<body onload="adjustheightofpage('1000px');">
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Home > Workspace > Placement Statistics';
$vertical_menu='';
include('./workspace_files/vertical_menu_workspace.in');
$date=date('Y-m-d');
$department=array();
$department[0]=array();
$department[0]['name']='Computer Engineering Department';
$department[0]['mtechdegree']='Computer Engineering';
$department[1]=array();
$department[1]['name']='Mechanical Engineering Department';
$department[1]['mtechdegree']=
$department[2]=array();
$department[2]['name']='Electrical Engineering Department';
$department[3]=array();
$department[3]['name']='Electronics and Communication Engineering Department';
$department[4]=array();
$department[4]['name']='Civil Engineering Department';
$department[5]=array();
$department[5]['name']='Chemical Engineering Department';
$department[0]['btech']=mysqli_fetch_array(mysqli_query($db,"select count(distinct admno) from view_placementstats where degree like 'Bachelor%' and branch like 'Computer Engin

$content='<fieldset style="height:540px;width:680px;"><legend><span style="color:#804040;font-family:Arial;font-size:20px;"><b>Placement Statistics till ';$content.=$date;$content.=' </b></span></legend>
<div style="position:absolute;left:3px;top:50px;width:700px;height:480px;overflow:auto;">
<table border="1" style="position:absolute;left:8px;">
<tbody>
<tr align="center">

DEPARTMENT WISE STATISTICS
</tr>
<tr>
<td>
DEPARTMENT  NAME
</td>
<td>
TOTAL STUDENTS
</td>
<td>
NUMBER OF STUDENTS PLACED
</td>
</tr>
</tbody>
</table>
</span>
</div>
</fieldset>
';
include('master_body.in');
?>
</body>
</html>

