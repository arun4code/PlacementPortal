<?php
if(isset($_POST['displaytext_submit']))
{
	if(isset($_POST['message']))
		$message=$_POST['message'];
	else
		$message='';
	if(isset($_POST['filename']))
		$filename=$_POST['filename'];
	else
		$filename='';
	header("Content-type: text/plain\n");
	header("Content-Disposition:attachment; filename=$filename\n");
	header("pragma: no-cache\n");
	header("Expires: 0");
	echo $message;
}
?>