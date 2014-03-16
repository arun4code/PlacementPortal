<html>
<head>
<title>LOGIN</title>
<?php
include('master_head.in');
?>
<style type="text/css">
#RollOver1 a
{
   display: block;
   position: relative;
}
#RollOver1 a img
{
   position: absolute;
   z-index: 1;
   border-width: 0px;
}
#RollOver1 span
{
   display: block;
   height: 161px;
   width: 293px;
   position: absolute;
   z-index: 2;
}
#RollOver1 a .hover
{
   visibility: hidden;
}
#RollOver1 a:hover .hover
{
   visibility: visible;
}
#RollOver1 a:hover span
{
   visibility: hidden;
}
#RollOver2 a
{
   display: block;
   position: relative;
}
#RollOver2 a img
{
   position: absolute;
   z-index: 1;
   border-width: 0px;
}
#RollOver2 span
{
   display: block;
   height: 165px;
   width: 263px;
   position: absolute;
   z-index: 2;
}
#RollOver2 a .hover
{
   visibility: hidden;
}
#RollOver2 a:hover .hover
{
   visibility: visible;
}
#RollOver2 a:hover span
{
   visibility: hidden;
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
$currently_at='Login';
$vertical_menu='';
$content='<div id="RollOver1" style="position:absolute;overflow:hidden;left:290px;top:100px;width:293px;height:161px;z-index:25">
<a href="./login_recruiters.php">
<img class="hover" alt="" src="./login_files/login2.png" style="left:0px;top:0px;width:293px;height:161px;">
<span><img alt="" src="./login_files/for_recuiters_2.png" style="left:0px;top:0px;width:293px;height:161px"></span>
</a>
</div>
<div id="RollOver2" style="position:absolute;overflow:hidden;left:0px;top:100px;width:263px;height:165px;z-index:25">
<a href="./login_students.php">
<img class="hover" alt="" src="./login_files/login2.png" style="left:0px;top:0px;width:263px;height:165px;">
<span><img alt="" src="./login_files/for_students_2.png" style="left:0px;top:0px;width:263px;height:165px"></span>
</a>
</div>';
include('master_body.in');
}
?>

</body>
</html>