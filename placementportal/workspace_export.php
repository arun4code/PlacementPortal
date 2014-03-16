<?php
include('./workspace_files/workspacesessionrelated.in');
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter') 
&& isset($_POST['query']))
{
	include('sql_connect_ro.php');
	include('./workspace_files/student_nameofcolumns.in');
	$query='';
	if(isset($_POST['fields']))
	{
		$query="select distinct ";
		$query.=implode(',',$_POST['fields']);
		if(isset($_POST['headings']))
		{
			$headings=$_POST['headings'];
		}
		
		$query.=" ";
		$query.=$_POST['query'];//in this case ' from table_name ' should be in $_POST['query'] itself
	}
	else
	{
		$query=$_POST['query'];
	}
	$queryarr=explode(' ',$query);
	if($queryarr[0]=='select' && $queryarr[3]!='login_admin'  && $queryarr[3]!='login_students'  && $queryarr[3]!='login_recruiters' )
	{
		if(isset($_POST['filename']))
			$filename=mysqli_real_escape_string($db,strip_tags($_POST['filename']));
		else
			$filename="export";
		$res=mysqli_query($db,$query);
		$heading='';
		$export='';
		if($res && mysqli_num_rows($res))
		{
			$heading.='Sr  no';
			$export.='"1"';
			$r=mysqli_fetch_array($res,MYSQLI_ASSOC);
			if($r)
			foreach($r as $key=>$value)
			{
				if($heading!='')
				{
					$heading.=',';
					$export.=',';
				}
				if($headings=='actual')
					$heading.=$actualnameofcolumns[$key];
				else
					$heading.=$key;
				$export.='"';
				$export.=$value;
				$export.='"';
			}
			$heading.='
';
			$export.='
';
			$i=2;
			while($r=mysqli_fetch_array($res,MYSQLI_NUM))
			{
				$str='"';
				$str.=implode('","',$r);
				$str.='"';
				$export.='"';
				$export.="$i";
				$export.='",';
				$export.=$str;
				$export.="
";
				$i++;

			}
		}
	

	//	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet\n");
		header("Content-type: text/csv\n");
		header("Content-Disposition:attachment; filename=$filename.csv\n");
		header("pragma: no-cache\n");
		header("Expires: 0");
		echo "$heading$export";
	}
}
else
{
	echo "INVALID PAGE";
}
?>