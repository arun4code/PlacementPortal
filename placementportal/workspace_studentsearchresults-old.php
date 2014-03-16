<html>
<head>
<title>SEARCH RESULTS</title>


<?php 

include('master_head.in');

?>
</head>
<body onload='expandcollapsesubmenu("submenu_findstudentinfo")'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > SEARCH RESULTS';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter'))
{
	include('./sql_connect_ro.php');
	include_once('./workspace_files/vertical_menu_workspace.in');
	
	$search_query="select distinct admno,fullname,degree,branch,cgpatillnow,perm_email,perm_mobileno from view_findstudents ";
	$filtersnsorts='';
	if(isset($_POST['search_submit']))
	{
			
			$filter=$_POST['filterby'];
			$sort=$_POST['sortby'];
			if(isset($_POST['branchbtech_2']))
			$branchbtech_2=$_POST['branchbtech_2'];
			if(isset($_POST['branchmtech_2']))
			$branchmtech_2=$_POST['branchmtech_2'];
			if(isset($_POST['branchmsc_2']))
			$branchmsc_2=$_POST['branchmsc_2'];
			$cgpa_low=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa_low']));
			$cgpa_high=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa_high']));
			$internship=mysqli_real_escape_string($db,strip_tags($_POST['internship']));
			$electives=mysqli_real_escape_string($db,strip_tags($_POST['electives']));
			$fullname=mysqli_real_escape_string($db,strip_tags($_POST['fullname']));
			$keyword=mysqli_real_escape_string($db,strip_tags($_POST['keyword']));
			$filters='';
			if(isset($_POST['branchbtech_2']))
			foreach($branchbtech_2 as $key=>$value)
			{
				$branchbtech_2[$key]=mysqli_real_escape_string($db,strip_tags($value));
			}
			if(isset($_POST['branchmtech_2']))
			foreach($branchmtech_2 as $key=>$value)
			{
				$branchmtech_2[$key]=mysqli_real_escape_string($db,strip_tags($value));
			}
				if(isset($_POST['branchmsc_2']))
			foreach($branchmsc_2 as $key=>$value)
			{
				$branchmsc_2[$key]=mysqli_real_escape_string($db,strip_tags($value));
			}
			
			
			foreach($filter as $val)
			{
				
				if($val=='filter_fullname' && $fullname!='')
				{
					if($filters!='')
						$filters.=" and ";
					$filters.=" ( fullname like '%";
					$namearray=explode(' ',$fullname);
				
					$namestr=implode("%' or fullname like '%",$namearray);
				
					$filters.=$namestr;
					$filters.="%') ";
				}
				if($val=='filter_branch' && ((!(empty($branchbtech_2))) || (!(empty($branchmtech_2))) || (!(empty($branchmsc_2)))))
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( ";
					$filtersbranch='';
					if((!(empty($branchbtech_2)))) 
					{
						
						if($filtersbranch!='')
							$filtersbranch.=" or ";
						$filtersbranch.=" ( degree='Bachelor of Technology' and (  branch like  '";
						$branchbtechstr=implode("' or branch like '",$branchbtech_2);
					
						$filtersbranch.=$branchbtechstr;
						
						$filtersbranch.="')) ";
					
						
					}
					if($val=='filter_branch' &&  (!(empty($branchmtech_2))))
					{
						
						if($filtersbranch!='')
							$filtersbranch.=" or ";
						$filtersbranch.=" ( degree='Master of Technology' and (  branch like '";
						$branchmtechstr=implode("'or branch like '",$branchmtech_2);
					
						$filtersbranch.=$branchmtechstr;
						
						$filtersbranch.="')) ";
						
						
					}
					if($val=='filter_branch' && (!(empty($branchmsc_2))) )
					{
					if($filtersbranch!='')
							$filtersbranch.=" or ";
						$filtersbranch.=" ( degree='Master of Science' and (  branch like  '";
						$branchmscstr=implode("' or branch like '",$branchmsc_2);
					
						$filtersbranch.=$branchmscstr;
						
						$filtersbranch.="')) ";
					
						
					}
					$filters.=$filtersbranch;
					$filters.= " ) ";
				}
				else if($val=='filter_cgpa')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( cgpatillnow>=$cgpa_low and cgpatillnow<=$cgpa_high) ";
				}
				else if($val=='filter_electives' && $electives!='')
				{
					if($filters!='')
							$filters.=" and ";
					$arrayelectives=explode(',',$electives);
					$filters.=' ( listelectives like "%';
					foreach($arrayelectives as $key2=>$val2)
					{
						
						    $arrayelectives[$key2]=trim($val2);
					}
					$electivestr=implode('%" or listelectives like "%',$arrayelectives);
					$filters.=$electivestr;
					$filters.='%" ) ';
					
				}
				else if($val=='filter_internship' && $internship!='')
				{
					if($filters!='')
							$filters.=" and ";
					$arrayinternship=explode(',',$internship);
					$filters.=' ( nameofcompany like "%';
					foreach($arrayinternship as $key2=>$val2)
					{
						
						    $arrayinternship[$key2]=trim($val2);
					}
					$internshipstr=implode('%" or nameofcompany like "%',$arrayinternship);
					$filters.=$internshipstr;
					$filters.='%" ) ';
				}
				else if($val=='filter_keyword' && trim($keyword)!='')
				{
				//FILL THIS OUT**************************************************************
					$keyword=trim($keyword);
					$keywordsarray=explode(' ',$keyword);
					foreach($keywordsarray as $val=>$kw)
					{
						$keywordarray[$val]=trim($kw);
					}
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( ";
					//check if production of 'or' is not faulty
					foreach($keywordsarray as $val=>$kw)
					{
							if($kw==' ')
							{
								continue;
							}
							$filters.=" ( adinfo like '%$kw%'  or ecact like '%$kw%' or topicproject  like '%$kw%' or topicseminar  like '%$kw%' or fieldoftraining like '%$kw%') ";
							if(isset($keywordsarray[$val+1]))
							{
								$filters.=" or ";
							}
					}
					$filters.=" ) ";
				
				
				}
			}
			
			$sorts='';
			foreach($sort as $val)
			{
				if($val=='----')
					break;
				if($sorts!='')
					$sorts.=',';
				$sorts.=$val;
			}
			if($sorts!='')
			{
				$sorts=" order by ".$sorts;
			}
			if($filters!='')
				$filters=" where ".$filters;
			$filtersnsorts=$filters.$sorts;

	}
	else if(isset($_POST['queryset_submit']))
	{
	
		$filtersnsorts=$_POST['search_query'];
	}
	else
	{
		$filtersnsorts='';
	}

	$search_query.=$filtersnsorts;
	$curpage='';
	if(isset($_GET['page']))
	{	
		$curpage=$_GET['page'];
	}
	if(!(is_numeric($curpage)) || $curpage<0)
	{
		$curpage=0;
	}
	//$curpage=Number($curpage);
	$perpage='';
	if(isset($_GET['perpage']))
	{
		$perpage=$_GET['perpage'];
	}
	if(!(is_numeric($perpage)) || $perpage<5)
	{
		$perpage=10;
	}
	//$perpage=Number($perpage);
	$from=$curpage*$perpage;
	$export_query=$search_query;
	$search_query.=" LIMIT $from,$perpage";
	$r=mysqli_query($db,$search_query);
	if($r)
	$num=mysqli_num_rows($r);
	else
	$num=0;
	//$content.=$search_query;
	$top_first=54;
	$vert_dist=50;
	$fieldset_height=$num*50+65;
	
	
	//$content.="$search_query";
	$content.='<fieldset name="search_results" style="height:';$content.=$fieldset_height;$content.='px;" id="fieldset_result">
	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>SEARCH RESULTS</b></span></legend>
	<div name="results" style="position:absolute;top:27px;left:0px;height:50px;">
	
	<div style="position:absolute;left:0px;top:20px;width:30px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Sr. No.</b></span></div>
		<div style="position:absolute;left:31px;top:30px;width:140px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Admission Number</b></span></div>
		<div style="position:absolute;left:172px;top:30px;width:170px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Full Name</b></span></div>
		<div style="position:absolute;left:343px;top:30px;width:160px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Degree Pursuing</b></span></div>
		<div style="position:absolute;left:504px;top:30px;width:170px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Branch</b></span></div>
		<div style="position:absolute;left:675px;top:30px;width:80px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>CGPA</b></span></div>
	<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:2px;top:53px;width:763px;height:1px;z-index:15;">
	';
	for($i=0;$i<$perpage;$i+=1)
	{
	
		if(!($r))
			break;
		$res=mysqli_fetch_array($r);
		if(!($res))
			break;
		$vdist=$vert_dist*$i+$top_first+$i;
		$vdist.='px';
		$srno=$from+$i+1;
		$admno=$res['admno'];
		$fullname=$res['fullname'];
		$degree=$res['degree'];
		$branch=$res['branch'];
		$cgpa=$res['cgpatillnow'];
		$content.='
		<div style="position:absolute;left:0px;top:';$content.=$vdist;$content.=';width:30px;height:50px;z-index:0;vertical-align:middle;text-align:center;">
	<span style="position:absolute;color:#000000;font-family:Arial;font-size:13px;">';$content.=$srno;$content.='</span></div>
		<div style="position:absolute;left:31px;top:';$content.=$vdist;$content.=';width:140px;height:50px;z-index:0;text-align:center;vertical-align:middle;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><a href="./workspace_studentinfodisplay.php?admno=';$content.=$admno;$content.='">';$content.=$admno;$content.='</a></span></div>
		<div style="position:absolute;left:172px;top:';$content.=$vdist;$content.=';width:170px;height:50px;z-index:0;text-align:center;vertical-align:middle;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$fullname;$content.='</span></div>
		<div style="position:absolute;left:343px;top:';$content.=$vdist;$content.=';width:160px;height:50px;z-index:0;text-align:center;vertical-align:middle;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$degree;$content.='</span></div>
		<div style="position:absolute;left:504px;top:';$content.=$vdist;$content.=';width:170px;height:50px;z-index:0;text-align:center;vertical-align:middle;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$branch;$content.='</span></div>
		<div style="position:absolute;left:675px;top:';$content.=$vdist;$content.=';width:80px;height:50px;z-index:0;text-align:center;vertical-align:middle;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$cgpa;$content.='</span></div>
		<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:2px;top:';$content.=$vdist+49;$content.=';width:763px;height:1px;z-index:15;">
	';
	
	}
	$content.='

	</div>

	';
	$content.='</fieldset>
	<div name="buttons" style="position:absolute;top:';$content.=$fieldset_height+50;$content.='px;left:20px;">
	<form action="./workspace_studentsearchresults.php?page=';$content.=$curpage-1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
	<input type="hidden" name="search_query" value="';$content.=$filtersnsorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:10px;top:0px;width:150px;height:30px;" value="Previous Page">
	</form>
	<form action="./workspace_studentsearchresults.php?page=';$content.=$curpage+1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
	<input type="hidden" name="search_query" value="';$content.=$filtersnsorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:550px;top:0px;width:150px;height:30px;" value="Next Page">
	</form>
	</div>
	<div style="position:absolute;top:15px;left:500px;z-index:40;">
	<form action="./workspace_export.php" method="post">
	<input type="hidden" name="filename" value="studentsearchresults">
	<input type="hidden" name="query" value="';$content.=$export_query;$content.='">
	<input type="submit" name="export_submit" value="Click Here to Export the Results">
	</form>
	</div>
	';
	
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