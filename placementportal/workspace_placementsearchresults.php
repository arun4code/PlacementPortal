<html>
<head>
<title>PLACEMENT SEARCH RESULTS</title>


<?php 

include('master_head.in');

?>
<script type="text/javascript">
function deleteplacementconfirm()
{
	return confirm("Are you sure you want to delete this entry? ");
}
</script>
</head>
<body  onload='expandcollapsesubmenu("submenu_placementinfo");'>
<?php
include('./workspace_files/workspacesessionrelated.in');
$currently_at='Workspace > Placement Search Results';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && $_SESSION['type']=='admin')
{
	include('./sql_connect_ro.php');
	include_once('./workspace_files/vertical_menu_workspace.in');
	
	$search_query="select * from students_placement ";
	$filtersnsorts='';
	include('sql_connect_ro.php');
	if(isset($_POST['placementsearchbyadmno_submit']))
	{
		
		$degree=mysqli_real_escape_string($db,strip_tags($_POST['degree']));
		$admyear=mysqli_real_escape_string($db,strip_tags($_POST['admyear']));
		if($degree=='U')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchbtech']));
		else if($degree=='I')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmsc']));
		else if($degree=='P')
				$branch=mysqli_real_escape_string($db,strip_tags($_POST['branchmtech']));
		$admno=$degree.$admyear[2].$admyear[3].$branch;
		$branchrollno=mysqli_real_escape_string($db,strip_tags($_POST['branchrollno']));
		if($branchrollno<=9)
			$admno.="00";
		else if($branchrollno<=99)
			$admno.="0";
		$admno.=$branchrollno;
		$sortby='nameoforganisation';
		$filtersnsorts=" where admno = '$admno' ";
		$filtersnsorts.=" order by $sortby";
	}
	else if(isset($_POST['placementsearchbyorgname_submit']))
	{
		$nameoforganisation=mysqli_real_escape_string($db,strip_tags($_POST['nameoforganisation']));
			$sortby='nameoforganisation,admno';
		$filtersnsorts=" where nameoforganisation like '%$nameoforganisation%' ";
		$filtersnsorts.=" order by $sortby";
	}
	else if(isset($_POST['placementqueryset_submit']))
	{
	
		$filtersnsorts=$_POST['search_query'];
		//$content.="filter: $filtersnsorts";
	}
	else
	{
		$filtersnsorts=' order by nameoforganisation,admno ';
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
	$search_query.=" LIMIT $from,$perpage";
	$r=mysqli_query($db,$search_query);
	if($r)
	$num=mysqli_num_rows($r);
	else
	$num=0;
	$top_first=54;
	$vert_dist=50;
	$fieldset_height=$num*51+60;
	//$content.="SEARCH QUERY: $search_query";
	$content.='<fieldset name="search_results" style="height:';$content.=$fieldset_height;$content.='px;width:738px;" id="fieldset_result">
	<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>Placement Search Results</b></span></legend>
	<form action="./workspace_deleteplacemententry.php" method="post" onsubmit="deleteplacementconfirm()">
	<div name="results" style="position:absolute;top:27px;left:0px;height:50px;">
	
	<div style="position:absolute;left:0px;top:30px;width:50px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Sr. No.</b></span></div>
		<div style="position:absolute;left:55px;top:30px;width:150px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Admission Number</b></span></div>
		<div style="position:absolute;left:210px;top:30px;width:300px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Name Of Organsation</b></span></div>
	<div style="position:absolute;left:515px;top:30px;width:130px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;"><b>Date of Placement</b></span></div>
	<div style="position:absolute;left:625px;top:24px;width:130px;height:20px;z-index:0;text-align:center;">
	<input type="submit" name="placemententry_delete" value="Delete">
	
	</div>
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
		$nameoforganisation=$res['nameoforganisation'];
		$dateofplacement=$res['dateofplacement'];
		$content.='
	<div style="position:absolute;left:0px;top:';$content.=$vdist;$content.=';width:50px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$srno;$content.='</span></div>
		<div style="position:absolute;left:55px;top:';$content.=$vdist;$content.=';width:150px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$admno;$content.='</span></div>
		<div style="position:absolute;left:210px;top:';$content.=$vdist;$content.=';width:300px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$nameoforganisation;$content.='</span></div>
		<div style="position:absolute;left:515px;top:';$content.=$vdist;$content.=';width:130px;height:20px;z-index:0;text-align:center;">
	<span style="color:#000000;font-family:Arial;font-size:13px;">';$content.=$dateofplacement;$content.='</span></div>
		<div style="position:absolute;left:680px;top:';$content.=$vdist;$content.=';width:20px;height:20px;z-index:0;text-align:center;">
	
	<input type="checkbox" name="admno_orgname[]" value="';$content.="$admno\$$nameoforganisation";$content.='">
	
	</div>
		<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:2px;top:';$content.=$vdist+49;$content.=';width:763px;height:1px;z-index:15;">
	';
	
	}
	$content.='

	</div>
	</form>
	';
	$content.='</fieldset>
	<div name="buttons" style="position:absolute;top:';$content.=$fieldset_height+30;$content.='px;left:20px;">
	<form action="./workspace_placementsearchresults.php?page=';$content.=$curpage-1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
	<input type="hidden" name="search_query" value="';$content.=$filtersnsorts;$content.='">
	<input type="submit" name="placementqueryset_submit" style="position:absolute;left:10px;top:0px;width:150px;height:30px;" value="Previous Page">
	</form>
	<form action="./workspace_placementsearchresults.php?page=';$content.=$curpage+1;$content.='&perpage=';$content.=$perpage;$content.='" method="post">
	<input type="hidden" name="search_query" value="';$content.=$filtersnsorts;$content.='">
	<input type="submit" name="placementqueryset_submit" style="position:absolute;left:550px;top:0px;width:150px;height:30px;" value="Next Page">
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