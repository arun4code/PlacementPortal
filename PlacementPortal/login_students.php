<html>
<head>
<title>STUNDENT LOG IN</title>
<?php
include('master_head.in');
?>
<style type="text/css">
#Form
{
   background-color: #FAFAFA;
   border: 0px #000000 solid;
}
#T1
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#T2 div
{
   text-align: left;
}
#IPB1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#T2
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#T2 div
{
   text-align: left;
}
#IPB2
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Sbutton
{
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
</style>
</head>
<body onload="adjustheightofpage('800px');">

<?php
session_start();
if(isset($_SESSION['username']))
{
	header('Location: ./workspace.php');
}
else
{
$currently_at='Home > Students > Login ';
$vertical_menu='';
include('./verticalmenu_files/studentstabverticalmenu.in');
$content='<div style="position:absolute;left:180px;top:50px;width:150px;height:16px;z-index:16;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;"><b><u>STUDENT LOG IN</u></b></span></div>
<div id="Form" style="position:absolute;left:55px;top:70px;width:367px;height:130px;z-index:15;">
<form method="post" action="./logincheck.php?type=student" >
<div id="T1" style="position:absolute;left:10px;top:15px;width:94px;height:16px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">USERNAME : </span></div>
<input type="text" id="IPB1" style="position:absolute;left:114px;top:15px;width:198px;height:23px;line-height:23px;z-index:1;" name="username" value="">
<div id="T2" style="position:absolute;left:10px;top:45px;width:94px;height:16px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">PASSWORD : </span></div>
<input type="password" id="IPB2" style="position:absolute;left:114px;top:45px;width:198px;height:23px;line-height:23px;z-index:3;" name="password" value="">
<input type="submit" id="Sbutton" name="submit" value="Submit" style="position:absolute;left:114px;top:75px;width:96px;height:25px;z-index:4;">
</form>
';

if(isset($_GET['prev']))
{
	$prev=$_GET['prev'];
	if($prev=='fail')
		$content.= '<div style="position:absolute;left:100px;top:100px;width:200px;height:3px;z-index:16;text-align:left;">
		<span style="color:red;font-family:Arial;font-size:13px;">Incorrect username/password</span></div>
		';
}
$content.='</div>';
include('master_body.in');
}
?>

</body>
</html>