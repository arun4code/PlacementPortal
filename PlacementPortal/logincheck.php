<html>
<head>
<title>
LOG IN
</title>
</head>
<body>
<?php
require_once('sql_connect_login.php');
$type=$_GET['type'];
$username=mysqli_real_escape_string($db,$_POST['username']);
$password=mysqli_real_escape_string($db,$_POST['password']);


if($type=='student')
{
	$r=mysqli_query($db,"select * from login_students where username='$username' and password=SHA1('$password')");
	if(mysqli_num_rows($r)==1)
	{
		$query="update login_students set lastlogin=where username='$username'";
		mysqli_query($db,$query);
		session_start();
		$_SESSION['type']='student';
		$_SESSION['username']=$username;
	
		$ct=mysqli_query($db,'select CURRENT_TIMESTAMP() from dual');
		if($ct)
		{
			$ct=mysqli_fetch_array($ct);
			$curtime=$ct[0];
		}
		else
		{
			date_default_timezone_set('Asia/Kolkata');
			$curtime= date("Y-m-d H:i:s");
		}
		$_SESSION['logintime']=$curtime;
	
		header('Location: ./home.php');
		
	}
	else
	{
		header('Location: ./login_students.php?prev=fail');
	}
}
else if($type=='recruiter')
{
	$r=mysqli_query($db,"select * from login_recruiters where username='$username' and password=SHA1('$password')");
	if(mysqli_num_rows($r)==1)
	{
		$query="update login_recruiters set lastlogin=CURRENT_TIMESTAMP() where username='$username'";
			mysqli_query($db,$query);
		session_start();
		$_SESSION['type']='recruiter';
		$_SESSION['username']=$username;
		$ct=mysqli_query($db,'select CURRENT_TIMESTAMP() from dual');
		if($ct)
		{
			$ct=mysqli_fetch_array($ct);
			$curtime=$ct[0];
		}
		else
		{
			date_default_timezone_set('Asia/Kolkata');
			$curtime= date("Y-m-d H:i:s");
		}
		$_SESSION['logintime']=$curtime;
		header('Location: ./home.php');
		
	}
	else
	{
		header('Location: ./login_recruiters.php?prev=fail');
	}
}
mysqli_close($db);
?>
</body>
</html>