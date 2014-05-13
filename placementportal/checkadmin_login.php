<html>
<title>ADMIN LOG IN</title>
<body>
<?php
require_once('sql_connect_all.php');
$username=mysqli_real_escape_string($db,$_POST['username']);
$password=mysqli_real_escape_string($db,$_POST['password']);

	$r=mysqli_query($db,"select * from login_admin where username='$username' and password=SHA1('$password')");
	if(mysqli_num_rows($r)==1)
	{
		$query="update login_admin set lastlogin=CURRENT_TIMESTAMP() where username='$username'";
		mysqli_query($db,$query);
		session_start();
		$_SESSION['type']='admin';
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
		header('Location: ./admin_login.php?prev=fail');
	}
mysqli_close();
?>
</body>
</html>