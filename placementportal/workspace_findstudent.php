<html>
<head>
<title>FIND STUDENT INFORMATION</title>


<?php 
include('./workspace_files/workspacesessionrelated.in');
include('master_head.in');

?>
<script type ="text/javascript">
var filterways=Array();
filterways[0]="filter_keyword";
filterways[1]="filter_fullname";
filterways[2]="filter_internship";
filterways[3]="filter_branch";
filterways[4]="filter_cgpa6";
filterways[5]="filter_cgpa7";
filterways[6]="filter_cgpa8";
filterways[7]="filter_electives";
filterways[8]="filter_category";
filterways[9]="filter_perc10";
filterways[10]="filter_perc12";
filterways[11]="filter_gender";
var filterarray=Array();
filterarray[0]="filterby1";
filterarray[1]="filterby2";
filterarray[2]="filterby3";
filterarray[3]="filterby4";
filterarray[4]="filterby5";
var sortarray=Array();
sortarray[0]="sortby1";
sortarray[1]="sortby2";
sortarray[2]="sortby3";
var prevfilterval=Array();
prevfilterval[0]="----";
prevfilterval[1]="----";
prevfilterval[2]="----";
prevfilterval[3]="----";
prevfilterval[4]="----";
var emptymsgelement_filter=document.getElementsByName("emptymsg_filter");
var errormsgelement_filter=document.getElementsByName("errormsg_filter");
var emptymsgelement_sort=document.getElementsByName("emptymsg_sort");
var errormsgelement_sort=document.getElementsByName("errormsg_sort");
var searchoptionselement=document.getElementsByName("searchoptions");
var sortbyandsubmitelement=document.getElementsByName("sortbyandsubmit");


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
	while(i<12)
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
	/*i=1;
	while(i<3)
	{
		var obj=document.getElementsByName(sortarray[i]+"div");
		obj[0].style.display="none";
		i+=1;
	}*/
	errormsgelement_filter[0].style.display="none";
	//errormsgelement_sort[0].style.display="none"
	emptymsgelement_filter[0].style.display="none";
	//emptymsgelement_sort[0].style.display="none";
	searchoptionselement[0].style.height="250px";
	sortbyandsubmitelement[0].style.top="215px";
	var prevfilterval=Array();
	prevfilterval[0]="----";
	prevfilterval[1]="----";
	prevfilterval[2]="----";
	prevfilterval[3]="----";
	prevfilterval[4]="----";
	var searchsubmitelement=document.getElementsByName("search_submit");
			searchsubmitelement[0].style.top="0px";
	
}


function cgpavalidate(obj)
{
	var cgpa=obj.value;
	var wrongflag=0;
	if(!(cgpa.match("[0-9\.]+$")))
	{
		
		alert("Field: CGPA contains invalid characters");
		wrongflag=1;
		
	}
	else if(!(((cgpa.length==2|| cgpa.length==1) && cgpa.indexOf('.')==-1) || (cgpa.length>3 && cgpa.length<=6 && cgpa.indexOf('.')==2) || (cgpa.indexOf('.')==1 && cgpa.length>2 && cgpa.length<=5)))
	{
	
		alert("Field: CGPA has invalid format");
		wrongflag=1;
	}
	else if(cgpa<0 || cgpa>10)
	{
		alert("Field: CGPA has invalid input. CGPA cannot be less than 0 or greater than 10.");
		wrongflag=1;
	}
	if(wrongflag==1)
	{
		if(obj.name=='cgpa_low6' || obj.name=='cgpa_low7' || obj.name=='cgpa_low8')
			obj.value=0;
		else if(obj.name=='cgpa_high6' || obj.name=='cgpa_high7' || obj.name=='cgpa_high8')
			obj.value=10;
	}
}
function percvalidate(obj)
{
	var perc=obj.value;
	var error="";
	var wrongflag=0;
	if(perc=="")
	{
		
		error+="Field: Percentagecannot be left blank";
		wrongflag=1;
	}
	else if(!(perc.match("[0-9\.]+$")))
	{
		error+="Field: Percentage contains invalid characters";
		wrongflag=1;
	}
	else if(!(((perc.length==2|| perc.length==1) && perc.indexOf('.')==-1) || (perc.length>3 && perc.length<=6 && perc.indexOf('.')==2) || (perc.indexOf('.')==1 && perc.length>2 && perc.length<=5)) && perc!=100)
	{
	
		error+="Field: Percentage has invalid format";
		wrongflag=1;
	}
	if(wrongflag==1)
	{
		if(obj.name=='perc12_low' || obj.name=='perc10_low')
		{
			obj.value=0;
		}
		else if(obj.name=='perc10_high' || obj.name=='perc12_high')
		{
			obj.value=100;
		}
	}
	if(error!='')
		alert(error);
}
</script>
</head>
<body onload='expandcollapsesubmenu("submenu_findstudentinfo");'>
<?php

$currently_at='Workspace > Find Student Information ';
$content='';
$vertical_menu='';
if(isset($_SESSION['type']) && ($_SESSION['type']=='admin' || $_SESSION['type']=='recruiter'))
{
	



	include_once('./workspace_files/vertical_menu_workspace.in');
	{
			
		$content='<fieldset name="searchoptions" style="height:250px;width:735px;overflow:auto">
				<legend><span style="color:#000000;font-family:Arial;font-size:13px;"><b>SEARCH OPTIONS</b></span></legend>
				<input type="button" name="addfilter" value="Add a Filter" style="position:absolute;left:20px;top:20px;height:30px;width:150px;font-family:Arial;font-size:11px;z-index:30;" onclick="increasefilters()">';
				
				/*<input type="button" name="addsort" value="Add a Sort" style="position:absolute;left:190px;top:20px;height:30px;width:150px;font-family:Arial;font-size:11px;z-index:30;" onclick="increasesorts()">*/
				$content.='
				<span style="color:#ff0000;font-family:Arial;font-size:13px;position:absolute;left:40px;top:60px;width:500px;"><b>*The result will show the students who satisfy all the filter conditions</b></span>
				<hr id="line_divide" style="margin:0;padding:0;position:absolute;left:2px;top:90px;width:763px;height:1px;z-index:15;">
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
				<div id="filter_branch" style="display:none;position:absolute;left:-70px;">
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
				<div id="filter_cgpa6" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY CGPA RANGE: </span>
				<input type="text" name="cgpa6_low" style="position:absolute;left:80px;top:0px;width:50px;z-index:30;" value="0" onblur="cgpavalidate(this)">
				<input type="text" name="cgpa6_high" style="position:absolute;left:150px;top:0px;width:50px;z-index:30;" value="10" onblur="cgpavalidate(this)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:135px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_category" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">CATEGORY: </span>
				<select name="category" style="position:absolute;left:80px;top:-3px;width:200px;z-index:30;height:30px;">
				<option value="GENERAL">General</option>
				<option value="OBC">OBC</option>
				<option value="SC">SC</option>
				<option value="ST">ST</option>
				</select>
			
				</div>
				<div id="filter_cgpa7" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY CGPA RANGE: </span>
				<input type="text" name="cgpa7_low" style="position:absolute;left:80px;top:0px;width:50px;z-index:30;" value="0" onblur="cgpavalidate(this)">
				<input type="text" name="cgpa7_high" style="position:absolute;left:150px;top:0px;width:50px;z-index:30;" value="10" onblur="cgpavalidate(this)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:135px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_cgpa8" style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY CGPA RANGE: </span>
				<input type="text" name="cgpa8_low" style="position:absolute;left:80px;top:0px;width:50px;z-index:30;" value="0" onblur="cgpavalidate(this)">
				<input type="text" name="cgpa8_high" style="position:absolute;left:150px;top:0px;width:50px;z-index:30;" value="10" onblur="cgpavalidate(this)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:135px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_electives"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">ELECTIVES:</span>
				<textarea name="electives"  style="position:absolute;left:80px;top:-15px;z-index:30;" rows="3" cols="30">ENTER NAMES OF ELECTIVES SEPARATED BY A COMMA(,)</textarea>
				</div>
				<div id="filter_perc10"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY PERCENTAGE RANGE: </span>
				<input type="text" name="perc10_low" style="position:absolute;left:100px;top:0px;width:50px;z-index:30;" value="0" onblur="percvalidate(this)">
				<input type="text" name="perc10_high" style="position:absolute;left:170px;top:0px;width:50px;z-index:30;" value="100" onblur="percvalidate(this)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:155px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_perc12"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">SPECIFY PERCENTAGE RANGE: </span>
				<input type="text" name="perc12_low" style="position:absolute;left:100px;top:0px;width:50px;z-index:30;" value="0" onblur="percvalidate(this)">
				<input type="text" name="perc12_high" style="position:absolute;left:170px;top:0px;width:50px;z-index:30;" value="100" onblur="percvalidate(this)">
				<span style="color:#000000;font-family:Arial;font-size:11px;position:absolute;left:155px;top:5px;width:10px;z-index:30;">To</span>
				</div>
				<div id="filter_gender"  style="display:none;position:absolute;">
				<span style="color:#000000;font-family:Arial;font-size:13px;">GENDER: </span>
				<select name="gender" style="position:absolute;left:80px;top:0px;z-index:30;height:30px;">
				<option value="MALE">MALE</option>
				<option value="FEMALE">FEMALE</option>
				</select>
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
				<div name="sortby1div" style="position:absolute;display:none;top:0px;width:200px;height:25px;z-index:30;">
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
			
				<input type="submit" name="search_submit" value="Search" style="position:absolute;left:120px;top:00px;width:150px;height:30px;z-index:30;">
				
				</div>
			
				</form>';
				
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