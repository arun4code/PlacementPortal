*********************NOT USED******************************

<html>
<head>
<title>FIND STUDENT INFORMATION</title>


<?php 

include('master_head.in');
include('./workspace_files/workspacesessionrelated.in');
?>
<script type ="text/javascript">

function changeby(str,change)
{
	
	var i=0;
	var num='';
	while(str[i]!='p')
	{
		num+=str[i];
		i+=1;
	}
	num=Number(num);
	num+=change;
	num+="px";
	return num;
}
function checksort(obj)
{
	var i=0;
	var objdivelement=document.getElementsByName(obj.id+"div");
	while(i<3)
	{
		var curelement=document.getElementById(sortarray[i]);
		if(obj!=curelement && obj.value==curelement.value && obj.value!="----")
		{
			obj.value="----";
			emptymsgelement_sort[0].style.display="none";
			errormsgelement_sort[0].style.display="block";
			errormsgelement_sort[0].style.top=objdivelement[0].style.top;
			return;
		}
		i++;
	}
	emptymsgelement_sort[0].style.display="none";
	errormsgelement_sort[0].style.display="none";

}
function increasesorts()
{
	
	var i=0;
	while(i<3)
	{
		var curelement=document.getElementById(sortarray[i]);
		var curdivelement=document.getElementsByName(sortarray[i]+"div");
		if(curdivelement[0].style.display=="none")
		{
			curdivelement[0].style.display="block";
			var searchsubmitelement=document.getElementsByName("search_submit");
			searchsubmitelement[0].style.top=changeby(searchsubmitelement[0].style.top,90);
		
			searchoptionselement[0].style.height=changeby(searchoptionselement[0].style.height,90);
			break;
			
		}
		if(curelement.value=="----" && i!=2)
		{
			
			errormsgelement_sort[0].style.display="none";
			emptymsgelement_sort[0].style.display="block";
			emptymsgelement_sort[0].style.top=curdivelement[0].style.top;
			break;
		}
		i+=1;
	}
}
function increasefilters()
{

	var i=0;
	while(i<5)
	{
		var curelement=document.getElementById(filterarray[i]);
		var curdivelement=document.getElementsByName(filterarray[i]+"div");
		if(curdivelement[0].style.display=="none")
		{
			curdivelement[0].style.display="block";

			sortbyandsubmitelement[0].style.top=changeby(sortbyandsubmitelement[0].style.top,90);
			
			searchoptionselement[0].style.height=changeby(searchoptionselement[0].style.height,90);
			break;
			
		}
		if(curelement.value=="----" && i!=5)
		{
			
			errormsgelement_filter[0].style.display="none";
			emptymsgelement_filter[0].style.display="block";
			emptymsgelement_filter[0].style.top=curdivelement[0].style.top;
			break;
		}
		i+=1;
	}
	
}
function showfilter(obj)
{
	var i=0;
	var objdivelement=document.getElementsByName(obj.id+"div");
	var which=0;
	i=0;
	while(i<5)
	{
			var curelement=document.getElementById(filterarray[i]);
		if(obj==curelement)
			which=i;
		i+=1;
	}
	i=0;
	while(i<5)
	{
		var curelement=document.getElementById(filterarray[i]);
		
		if(obj!=curelement && obj.value==curelement.value && obj.value!="----")
		{
			
			obj.value="----";
			emptymsgelement_filter[0].style.display="none";
			errormsgelement_filter[0].style.display="block";
			errormsgelement_filter[0].style.top=objdivelement[0].style.top;
			break;
		}
		i+=1;
	}
/*	var curfilterelement=document.getElementById(prevfilterval[which]);
			curfilterelement.style.display="none";*/
	if(prevfilterval[which]!="----")
	{
		var prevfilter=document.getElementById(prevfilterval[which]);
		prevfilter.style.display="none";
		prevfilterval[which]="----";
	}
	if(i!=5)
		return;
	emptymsgelement_filter[0].style.display="none";
	errormsgelement_filter[0].style.display="none";
	var nowfilter=document.getElementById(obj.value);
	nowfilter.style.display="block";
	nowfilter.style.top=objdivelement[0].style.top;
	prevfilterval[which]=obj.value;
}
function startanewsearch()
{
	
	var i=0;
	while(i<6)
	{
		
		var obj=document.getElementById(filterways[i]);
	//	alert(filterways[i]);
		obj.style.display="none";
		i+=1;
	}
	i=1;

	while(i<5)
	{
		var obj=document.getElementsByName(filterarray[i]+"div");
		//alert(filterarray[i]+"div");
		obj[0].style.display="none";
		i+=1;
	}
	i=1;
	while(i<3)
	{
		var obj=document.getElementsByName(sortarray[i]+"div");
		obj[0].style.display="none";
		i+=1;
	}
	errormsgelement_filter[0].style.display="none";
	errormsgelement_sort[0].style.display="none"
	emptymsgelement_filter[0].style.display="none";
	emptymsgelement_sort[0].style.display="none";
	searchoptionselement[0].style.height="300px";
	sortbyandsubmitelement[0].style.top="215px";
	var prevfilterval=Array();
	prevfilterval[0]="----";
	prevfilterval[1]="----";
	prevfilterval[2]="----";
	prevfilterval[3]="----";
	prevfilterval[4]="----";
	var searchsubmitelement=document.getElementsByName("search_submit");
			searchsubmitelement[0].style.top="50px";
	
}
</script>

</head>
<body  onload='expandcollapsesubmenu("submenu_recruiteraccounts");'>
<?php

$currently_at='Workspace > Find Student Information ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter'))
{
	



	include_once('./workspace_files/vertical_menu_workspace.in');
	{
			
		$content='<fieldset name="searchoptions" style="height:300px;width:735px;overflow:auto">
				<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>SEARCH OPTIONS</b></span></legend>
				<input type="button" name="addfilter" value="Add a Filter" style="position:absolute;left:20px;top:20px;height:30px;width:150px;font-family:Arial;font-size:11px;z-index:30;" onclick="increasefilters()">
				<input type="button" name="addsort" value="Add a Sort" style="position:absolute;left:190px;top:20px;height:30px;width:150px;font-family:Arial;font-size:11px;z-index:30;" onclick="increasesorts()">
				
				<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:2px;top:60px;width:763px;height:1px;z-index:15;">
				<form name="findstudentinfo" action="./workspace_studentsearchresults.php" method="post">';
				//------------------------------FILTERBYS-----------------------------------------------------------------------------
		$content.='
				<input type="reset" name="clearform" value="Start a New Search" style="position:absolute;left:360px;top:20px;height:30px;width:150px;font-family:Arial;font-size:11px;z-index:30;" onclick="startanewsearch()">
				<div name="filterby1div" style="position:absolute;left:20px;top:125px;width:200px;height:25px;z-index:30;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FILTER BY 1:</span>
				<select name="filterby[]"  id="filterby1"  style="position:absolute;left:100px;width:180px;height:30px" onchange="showfilter(this)">
				';
				include('workspace_files/filterbyoptions.in');
		$content.='
				</select>
				</div>
					<div name="filterby2div" style="position:absolute;display:none;left:20px;top:215px;width:200px;height:25px;z-index:30;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FILTER BY 2:</span>
				<select name="filterby[]" id="filterby2" style="position:absolute;left:100px;width:180px;height:30px" onchange="showfilter(this)">
				';
				include('workspace_files/filterbyoptions.in');
		$content.='
				</select>
				</div>
					<div name="filterby3div" style="position:absolute;display:none;left:20px;top:305px;width:200px;height:25px;z-index:30;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FILTER BY 3:</span>
				<select name="filterby[]" id="filterby3" style="position:absolute;left:100px;width:180px;height:30px" onchange="showfilter(this)">
				';
				include('workspace_files/filterbyoptions.in');
		$content.='
				</select>
				
				</div>
					<div name="filterby4div" style="position:absolute;display:none;left:20px;top:395px;width:200px;height:25px;z-index:30;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FILTER BY 4:</span>
				<select name="filterby[]" id="filterby4" style="position:absolute;left:100px;width:180px;height:30px" onchange="showfilter(this)">
				';
				include('workspace_files/filterbyoptions.in');
		$content.='
				</select>
				
				</div>
					<div name="filterby5div" style="position:absolute;display:none;left:20px;top:485px;width:200px;height:25px;z-index:30;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FILTER BY 5:</span>
				<select name="filterby[]" id="filterby5" style="position:absolute;left:100px;width:180px;height:30px" onchange="showfilter(this)">
				';
				include('workspace_files/filterbyoptions.in');
		$content.='
				</select>
				</div>
				<div name="emptymsg_filter" style="position:absolute;display:none;top:0px;left:330px;width:100px;">
				<span style="color:#000000;font-family:Arial;font-size:11px;color:red">PLEASE ENTER THIS FILTER FIRST</span>
				</div>
				<div name="errormsg_filter" style="position:absolute;display:none;top:0px;left:330px;width:100px;">
				<span style="color:#000000;font-family:Arial;font-size:11px;color:red">A FILTER BY THIS VALUE ALREADY EXISTS</span>
				</div>';
				//----------------------------------------------------------END OF FILTERBYS----------------------------------------------------
		$content.='
				
				<div name="filterkey" style="position:absolute;left:390px;width:60px;top:0px;height:25px;z-index:30;">			
				<div id="filter_branch" style="display:none;position:absolute;left:-70px">
				<span style="position:absolute;left:-200px;top:30px;color:#000000;font-family:Arial;font-size:13px;">(Ctrl + Click to select multiple)</span>
				<select name="branchbtech_2[]" multiple="multiple" style="position:absolute;left:-15px;top:-20px;width:150px;height:70px;z-index:30;">
					<option value="%">ALL BTECH. BRANCHES</option>
					<option value="Computer Engineering">Computer Engineering</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Electrical Engineering">Electrical Engineering</option>
					<option value="Electronics and Communication Enginnering">Electronics and Communication Enginnering</option>
					<option value="Chemical Engineering">Chemical Engineering</option>
					<option value="Civil Engineering">Civil Engineering</option>
				</select>
				<select name="branchmtech_2[]" multiple="multiple" style="position:absolute;left:140px;top:-25px;width:200px;height:80px;z-index:30;">
					<option value="%">ALL MTECH. BRANCHES</option>
					<option value="Power Systems">Power Systems</option>
					<option value="Thermal System Design">Thermal System Design</option>
					<option value="Communication System">Communication System</option>
					<option value="Environmental Enginnering">Environmental Enginnering</option>
					<option value="VLSI and Embedded Systems">VLSI and Embedded Systems</option>
					<option value="CAD/CAM">CAD/CAM</option>
					<option value="Computer Enginnering">Computer Enginnering</option>
					<option value="Chemical Engineering">Chemical Engineering</option>
					<option value="Industrial Process Equipment Design">Industrial Process Equipment Design</option>
					<option value="Mechanical Enginnering">Mechanical Enginnering</option>
					<option value="Power Electronics and Electrical Drives">Power Electronics and Electrical Drives</option>
					<option value="Water Resources Engineering">Water Resources Engineering</option>
					<option value="Turbo Machines">Turbo Machines</option>
					<option value="Urban Planning">Urban Planning</option>
					<option value="Soil Mechanics and Foundation Engineering">Soil Mechanics and Foundation Engineering</option>
					<option value="Structural Engineering">Structural Engineering</option>
					<option value="Transportation Enginnering and Planning">Transportation Enginnering and Planning</option>
				</select>
				<select name="branchmsc_2[]" multiple="multiple" style="position:absolute;left:345px;top:-25px;width:100px;height:60px;z-index:30;">
					<option value="%">ALL MSC. BRANCHES</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Physics">Physics</option>
					<option value="Chemistry">Chemistry</option>
				</select>
				
				</div>
				<div id="filter_cgpa" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY CGPA RANGE: </span>
				<input type="number" name="cgpa_low" style="position:absolute;left:80px;top:0px;width:50px;z-index:30;" value="0" onblur="cgpavalidate(this)">
				<input type="number" name="cgpa_high" style="position:absolute;left:150px;top:0px;width:50px;z-index:30;" value="10" onblur="cgpavalidate(thiss)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:135px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_electives"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">ELECTIVES:</span>
				<textarea name="electives"  style="position:absolute;left:80px;top:-15px;z-index:30;" rows="3" cols="30">ENTER NAMES OF ELECTIVES SEPARATED BY A COMMA(,)</textarea>
				</div>
				<div id="filter_fullname"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">FULL NAME :</span>
				<input type="text" name="fullname" style="position:absolute;left:80px;top:2px;width:200px;height:30px;z-index:30;">
				</div>
				<div id="filter_keyword" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">OTHER KEYWORDS:</span>
				<input type="text" name="keyword" style="position:absolute;left:90px;top:2px;width:200px;height:30px;z-index:30;">
				</div>
				<div id="filter_internship" style="display:none;position:absolute">
				<span style="color:#000000;font-family:Arial;font-size:13px;">INTERNED AT:</span>
			
				<textarea name="internship"  style="position:absolute;left:80px;top:-15px;z-index:30;" rows="3" cols="30">ENTER NAMES OF INSTITUES/ORGANISATIONS INTERNED AT SEPARATED BY A COMMA(,)</textarea>
				
				</div>
				</div>
				<div name="sortbyandsubmit" style="position:absolute;left:20px;top:215px;width:500px;height:500px;z-index:30;">
					<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:-18px;top:-20px;width:763px;height:1px;z-index:15;">
					<div name="emptymsg_sort" style="position:absolute;display:none;top:0px;left:330px;width:100px;">
						<span style="color:#000000;font-family:Arial;font-size:11px;color:red">PLEASE ENTER THIS SORT FIRST</span>
					</div>
					<div name="errormsg_sort" style="position:absolute;display:none;top:0px;left:330px;width:100px;">
						<span style="color:#000000;font-family:Arial;font-size:11px;color:red">A SORT BY THIS VALUE ALREADY EXISTS</span>
					</div>
				<div name="sortby1div" style="position:absolute;display:block;top:0px;width:200px;height:25px;z-index:30;">
					<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;left:0px;top:0px;">SORT BY 1:</span>
					<select name="sortby[]" id="sortby1" style="position:absolute;left:100px;width:180px;height:30px;" onchange="checksort(this)">
					
				';
				include('workspace_files/sortbyoptions.in');
			$content.='
					</select>
				</div>
				<div name="sortby2div" style="position:absolute;display:none;top:70px;width:200px;height:25px;z-index:30;">
					<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;left:0px;top:0px;">SORT BY 2:</span>
					<select name="sortby[]" id="sortby2" style="position:absolute;left:100px;width:180px;height:30px;" onchange="checksort(this)">
					
				';
				include('workspace_files/sortbyoptions.in');
			$content.='
					</select>
				</div>
				<div name="sortby3div" style="position:absolute;display:none;top:140px;width:200px;height:25px;z-index:30;">
					<span style="color:#000000;font-family:Arial;font-size:13px;position:absolute;left:0px;top:0px;">SORT BY 3:</span>
					<select name="sortby[]" id="sortby3" style="position:absolute;left:100px;width:180px;height:30px;" onchange="checksort(this)">
					
				';
				include('workspace_files/sortbyoptions.in');
			$content.='
					</select>
				</div>
				<input type="submit" name="search_submit" value="Search" style="position:absolute;left:120px;top:50px;width:150px;height:30px;z-index:30;">
				</div>
			
				</form>';
				/*
				</fieldset>
				<fieldset style="height:600px">
				<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>SEARCH RESULTS</b></span></legend>
				</fieldset>
				*/
	}
	
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