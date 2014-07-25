<html>
<head>
<title>SEARCH RESULTS</title>

<script type="text/javascript">
var columnheadingele=Array();
var countcolumnheadings=6;
var previouscolumnheading=Array();
function adjustcontentdivheight(newheight)
{	
	alert('here');
	var content=document.getElementById('searchresults_div');
	content.style.height=newheight;
}
function changecolumn(obj)
{
	var val=obj.value;
	var thisnumber=-1;
	var columnalreadythereflag=0;
	
	for(var i=0;i<countcolumnheadings;i++)
	{
		if(obj==columnheadingele[i])
			thisnumber=i;
		if(columnheadingele[i].value==val && obj!=columnheadingele[i])
		{
			columnalreadythereflag=1;
		}
	}
	if(val=='----')
		columnalreadythereflag=0;
	if(columnalreadythereflag==1)
	{
		alert("This column is already displayed");
		obj.value=previouscolumnheading[thisnumber];
		return;
	}
	
	if(previouscolumnheading[thisnumber]!='----')
	{
		var tohide="column_";
		tohide=tohide+previouscolumnheading[thisnumber];
		var tohideele=document.getElementById(tohide);
		tohideele.style.display='none';
	}
	var toshow="column_";
	toshow=toshow+val;
	previouscolumnheading[thisnumber]=val;
	var toshowele=document.getElementById(toshow);
	toshowele.style.display='block';
	var leftalignreference=document.getElementById(obj.id+"_div");
	toshowele.style.left=leftalignreference.style.left;
	toshowele.style.width=leftalignreference.style.width;
}
function setdefaultcolumns(firstcolumn)
{
	
	var admnocolumn=document.getElementById('column_admno');
	admnocolumn.style.display='block';
	admnocolumn.style.width='140px';
	admnocolumn.style.left='31px';
	
	for(var i=1;i<=countcolumnheadings;i++)
	{
		var nameele='ssr_column';
		nameele=nameele+i;
		previouscolumnheading[i-1]='----';
		columnheadingele[i-1]=document.getElementById(nameele);
	}
	if(firstcolumn!='----' && firstcolumn!='')
	{
		columnheadingele[0].value=firstcolumn;
		changecolumn(columnheadingele[0]);
	}
	if(firstcolumn!='fullname')
	{
		columnheadingele[1].value='fullname';
		changecolumn(columnheadingele[1]);
	}
	if(firstcolumn!='degree')
	{
		columnheadingele[2].value='degree';
		changecolumn(columnheadingele[2]);
	}
	if(firstcolumn!='branch')
	{
		columnheadingele[3].value='branch';
		changecolumn(columnheadingele[3]);
	}
	if(firstcolumn!='admissionyear')
	{
		columnheadingele[4].value='admissionyear';
		changecolumn(columnheadingele[4]);
	}
	if(firstcolumn!='category')
	{
		columnheadingele[5].value='category';
		changecolumn(columnheadingele[5]);
	}
	
}
</script>
<?php 
include('./workspace_files/workspacesessionrelated.in');
include('master_head.in');
$firstcolumn='----';
if(isset($_POST['search_query_sorts']))
{
	$sv=$_POST['search_query_sorts'];
	if($sv!='')
	{
		$sv=explode(' ',$sv);
		if(isset($sv[2]))
		{
			$sv=$sv[2];
			$sv=explode(',',$sv);
			if(sizeof($sv)==1)
				$firstcolumn=$sv[0];
		}
	}
}
echo '
</head>
<body onload=\'expandcollapsesubmenu("submenu_findstudentinfo");setdefaultcolumns("';echo $firstcolumn;echo '");\'>
';

$currently_at='Workspace > SEARCH RESULTS';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter'))
{
	include('./sql_connect_ro.php');
	include_once('./workspace_files/vertical_menu_workspace.in');
	include('./workspace_files/student_nameofcolumns.in');

	$search_query="select distinct ";
	$search_query.=implode(',',$nameofcolumns);
	$search_query.=" from view_findstudents ";
	$filtersnsorts='';
	$filters='';
	$sorts='';
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
			$cgpa6_low=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa6_low']));
			$cgpa6_high=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa6_high']));
			$cgpa7_low=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa7_low']));
			$cgpa7_high=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa7_high']));
			$cgpa8_low=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa8_low']));
			$cgpa8_high=(int)mysqli_real_escape_string($db,strip_tags($_POST['cgpa8_high']));
			$internship=mysqli_real_escape_string($db,strip_tags($_POST['internship']));
			$electives=mysqli_real_escape_string($db,strip_tags($_POST['electives']));
			$fullname=mysqli_real_escape_string($db,strip_tags($_POST['fullname']));
			$keyword=mysqli_real_escape_string($db,strip_tags($_POST['keyword']));
			$category=mysqli_real_escape_string($db,strip_tags($_POST['category']));
			$gender=mysqli_real_escape_string($db,strip_tags($_POST['gender']));
			$perc10_low=mysqli_real_escape_string($db,strip_tags($_POST['perc10_low']));
			$perc10_high=mysqli_real_escape_string($db,strip_tags($_POST['perc10_high']));
			$perc12_low=mysqli_real_escape_string($db,strip_tags($_POST['perc12_low']));
			$perc12_high=mysqli_real_escape_string($db,strip_tags($_POST['perc12_high']));
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
				else if($val=='filter_cgpa6')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( cgpa6>=$cgpa6_low and cgpa6<=$cgpa6_high) ";
				}
				else if($val=='filter_cgpa7')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( cgpa7>=$cgpa7_low and cgpa7<=$cgpa7_high) ";
				}
				else if($val=='filter_cgpa8')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( cgpa8>=$cgpa8_low and cgpa8<=$cgpa8_high) ";
				}
				else if($val=='filter_category')
				{
				
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( category like '$category') ";
				}
				else if($val=='filter_gender')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( gender like '$gender') ";
				}
				else if($val=='filter_perc12')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( perc12>=$perc12_low and perc12<=$perc12_high) ";
				}
				else if($val=='filter_perc10')
				{
					if($filters!='')
							$filters.=" and ";
					$filters.=" ( perc10>=$perc10_low and perc10<=$perc10_high) ";
				}
				else if($val=='filter_electives' && $electives!='')
				{
					if($filters!='')
							$filters.=" and ";
					$arrayelectives=explode(',',$electives);
					$filters.=" ( listelectives like '%";
					foreach($arrayelectives as $key2=>$val2)
					{
						
						    $arrayelectives[$key2]=trim($val2);
					}
					$electivestr=implode("%' or listelectives like '%",$arrayelectives);
					$filters.=$electivestr;
					$filters.="%' ) ";
					
				}
				else if($val=='filter_internship' && $internship!='')
				{
					if($filters!='')
							$filters.=" and ";
					$arrayinternship=explode(',',$internship);
					$filters.=" ( nameofcompany like '%";
					foreach($arrayinternship as $key2=>$val2)
					{
						
						    $arrayinternship[$key2]=trim($val2);
					}
					$internshipstr=implode("%' or nameofcompany like '%",$arrayinternship);
					$filters.=$internshipstr;
					$filters.="%' ) ";
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
			

	}
	else if(isset($_POST['queryset_submit']))
	{
	
		$filters=$_POST['search_query_filters'];
		$sorts=$_POST['search_query_sorts'];
	}
	else
	{
		$filters='';
		$sorts='';
		
	}
	$filtersnsorts=$filters.$sorts;
	if($sorts=='')
	{
		$filtersnsorts.="order by admno";
	}
	else
	{
		$filtersnsorts.=",admno";
	}
	
	$search_query.=$filtersnsorts;
	$export_query=$search_query;
	
	
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
	if(!(is_numeric($perpage)) || $perpage<2 || $perpage>15)//SET MIN AND MAX ENTRIES PER PAGE
	{
		$perpage=10;
	}
	//$perpage=Number($perpage);
	$from=$curpage*$perpage;
	$r=mysqli_query($db,$search_query);
	if($r)
		$totalresults=mysqli_num_rows($r);
	else
		$totalresults=0;
	$search_query.=" LIMIT $from,$perpage";
	$r=mysqli_query($db,$search_query);
	$searchresultarray=array();
	if($r)
	{
		$num=mysqli_num_rows($r);
		while($res=mysqli_fetch_array($r,MYSQLI_NUM))
		{
			$currenttuple=array();
			foreach($res as $val)
			{
				$currenttuple[]=$val;
			//	$content.="$val  ";
			}
			$searchresultarray[]=$currenttuple;
			
			//$content.="<br> <br>";
		}
		
	}
	else
	$num=0;
	//$content.=$search_query;
	$top_first=54;
	$vert_dist=50;
	$fieldset_height=$num*50+65;
/*	if($fieldset_height>581)
	{
		$fieldset_height=581;
	}*/
	$content.='
	
	
	<div name="search_results" style="height:';$content.=$fieldset_height+50;$content.='px;width:100%;border-style:groove;border-width:6px;z-index:10;" id="fieldset_result" >

	<legend><span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;top:-7px;left:10px;padding:2px 2px 2px 2px;background-color:#ffffff;"><b>SEARCH RESULTS</b></span></legend>
		<div style="position:absolute;left:8px;top:47px;width:30px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Sr. No.</b></span></div>
	<div style="position:absolute;left:36px;top:47px;width:140px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Admission Number</b></span></div>
	<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:0px;top:100px;width:182px;height:3px;z-index:15;">
	<div style="position:absolute;left:173px;top:35px;width:2px;height:';$content.=$fieldset_height+22;$content.='px;box-shadow:5px 0px 10px 2px #C9C9C9;"></div>';
	$content.="<div id='column_srno' style='display:block;position:absolute;top:105px;left:8px;z-index:10;'>";
	for($i=1;$i<=$num;$i++)
	{
		$vdist=$vert_dist*$i+$i-1;
		$vdist.='px';
		$tvert_dist=$vert_dist."px";
		$cursrno=$from+$i;
		$content.="<div style='position:absolute:top:$vdist;width:30px;height:$tvert_dist;line-height:$tvert_dist;text-align:center;' ><span style='font-family:Arial;font-size:13px;'>$cursrno.</span></div>";
		if($i!=$num)
		{
			$content.='<hr style="margin:0;padding:0;left:0px;height:1px;width:177px;position:absolute;top:';$content.=($vdist-2);$content.='px;">';
		}
	}
	$content.="</div>";
	$content.="<div id='column_admno' style='display:block;position:absolute;top:105px;left:36px;z-index:10;'>";
	for($i=0;$i<$num;$i++)
	{
		$vdist=$vert_dist*$i+$i;
		$vdist.='px';
		$tvert_dist=$vert_dist."px";
		$admno=$searchresultarray[$i][0];
		$content.="<div style='position:absolute:top:$vdist;width:140px;height:$tvert_dist;line-height:$tvert_dist;text-align:center;' ><span style='font-family:Arial;font-size:13px;'><a href='./workspace_studentinfodisplay.php?admno=$admno'>$admno</a></span></div>";
	}
	$content.='</div>
	
	<div id="results_window" style="position:absolute;left:182px;top:0px;width:590px;height:';$content.=$fieldset_height+82;$content.='px;overflow:auto;text-align:center;">

	<div name="results" style="position:absolute;top:27px;left:-177px;height:50px;width:923px;">
	
		<div id="ssr_column1_div" style="position:absolute;left:172px;top:20px;width:182px;height:20px;z-index:0;text-align:center;" >
	<select id="ssr_column1" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
		<div id="ssr_column2_div" style="position:absolute;left:355px;top:20px;width:182px;height:20px;z-index:0;text-align:center;">
	<select id="ssr_column2" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
		<div id="ssr_column3_div" style="position:absolute;left:538px;top:20px;width:182px;height:20px;z-index:0;text-align:center;">
	<select id="ssr_column3" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
		<div  id="ssr_column4_div" style="position:absolute;left:721px;top:20px;width:182px;height:20px;z-index:0;text-align:center;">
	<select id="ssr_column4" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
	<div id="ssr_column5_div" style="position:absolute;left:904px;top:20px;width:182px;height:20px;z-index:0;text-align:center;">
	<select id="ssr_column5" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
		<div id="ssr_column6_div" style="position:absolute;left:1087px;top:20px;width:182px;height:20px;z-index:0;text-align:center;">
	<select id="ssr_column6" style="width:150px;" onchange="changecolumn(this)">';include('./workspace_files/allcolumnsindropdown.in');$content.='</select></div>
	<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:0px;top:73px;width:1260px;height:3px;z-index:15;">
	
	';
	
	for($i=1;$i<$num;$i++)
	{
		$vdist=77+$vert_dist*$i+$i;
		if($i!=$num)
		{
			$content.='<hr style="margin:0;padding:0;left:0px;height:1px;width:1260px;position:absolute;top:';$content.=($vdist-2);$content.='px;">';
		}
	}
	/**/
		foreach($nameofcolumns as $key=>$namecol)
		{
			$content.="<div id='column_$namecol' style='display:none;position:absolute;top:58px;left:0px;'>
			<form action='./workspace_studentsearchresults.php' method='post'>
			<input type='submit' name='queryset_submit' value='&uarr;' style='position:absolute;top:-13px;left:13px;'>
			<input type='hidden' name='search_query_filters' value=\"$filters\">
			<input type='hidden' name='search_query_sorts' value=\"order by $namecol\">
			</form>
			<span style='font-family:Arial;font-size:13px;position:absolute;left:38px;top:-10px;width:105px;height:30px;'>Sort Results</span>
			<form action='./workspace_studentsearchresults.php' method='post'>
			<input type='submit' name='queryset_submit' value='&darr;' style='position:absolute;top:-13px;left:141px;'>
			<input type='hidden' name='search_query_filters' value=\"$filters\">
			<input type='hidden' name='search_query_sorts' value=\"order by $namecol desc\">
			</form>
			";
			for($i=0;$i<$num;$i++)
			{
				$vdist=$vert_dist*$i+$i+20;
				$vdist.='px';
				$width='182px';
				$tvert_dist=$vert_dist."px";
				if($namecol=='admno')
					$width='140px';
				
				$content.="<div style='position:absolute;top:$vdist;width:";$content.=$width;$content.=";height:$tvert_dist;line-height:$tvert_dist;text-align:center;overflow:auto;' ><span style='font-family:Arial;font-size:13px;'>";$content.=$searchresultarray[$i][$key];$content.="</span></div>";
			}
				
			$content.="
			</div>
			";
		
		}
	

	
	$content.='</div>
		</div>
		</div>

	<div name="buttons" style="position:absolute;top:';$content.=$fieldset_height+90;$content.='px;left:20px;">
	<form action="./workspace_studentsearchresults.php?page=';$content.='0&perpage=';$content.=$perpage;$content.='" method="post">
<input type="hidden" name="search_query_filters" value="';$content.=$filters;$content.='">
	<input type="hidden" name="search_query_sorts" value="';$content.=$sorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:10px;top:0px;width:50px;height:30px;" value="<<">
	</form>
	<form action="./workspace_studentsearchresults.php?page=';$content.=$curpage-1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
	<input type="hidden" name="search_query_filters" value="';$content.=$filters;$content.='">
	<input type="hidden" name="search_query_sorts" value="';$content.=$sorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:60px;top:0px;width:50px;height:30px;" value="<">
	</form>
	<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;left:150px;top:10px;width:300px;">Showing ';$content.=$from+1;$content.=' - ';$content.=$from+$perpage;$content.=' out of a total of ';$content.=$totalresults;$content.=' results </span>
	<form action="./workspace_studentsearchresults.php?page=';$content.=$curpage+1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
<input type="hidden" name="search_query_filters" value="';$content.=$filters;$content.='">
	<input type="hidden" name="search_query_sorts" value="';$content.=$sorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:620px;top:0px;width:50px;height:30px;" value=">">
	</form>
	<form action="./workspace_studentsearchresults.php?page=';
	$totalpages=(int)($totalresults/$perpage);
	if($totalresults%$perpage==0)
		$totalpages--;
	$content.=$totalpages;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
<input type="hidden" name="search_query_filters" value="';$content.=$filters;$content.='">
	<input type="hidden" name="search_query_sorts" value="';$content.=$sorts;$content.='">
	<input type="submit" name="queryset_submit" style="position:absolute;left:670px;top:0px;width:50px;height:30px;" value=">>">
	</form>
	</div>
	<div style="position:absolute;top:15px;left:10px;z-index:40;">
	<form action="./workspace_selectcolumnstoexport.php" method="post">
	<input type="hidden" name="filtersnsorts" value="';$content.=$filtersnsorts;$content.='">
	<input type="submit" name="export_presubmit" value="Click Here to Export the Results">
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