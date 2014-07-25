
function nsi_firstname(obj)
{
	var error="";
	var fullname=obj.value;
	error+=nsi_fullnamevalidate(fullname);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_fullnamevalidate(fullname)
{
	var error="";
	if(fullname=="")
		error+="Field: Full name cannot be left blank\n";
	else if(!(fullname.match("[a-zA-Z.]+$")))
	{
		error+="Field: Full name can have only upper and lower case alphabets\n";
	}
	return error;
	
}

function nsi_dob(obj)
{
	var error="";
	var dob=obj.value;
	error+=nsi_dobvalidate(dob);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_dobvalidate(dob)
{
	
	var error="";
	if(dob=="")
	{
		error+="Field: Date of Birth cannot be left blank";
	}
	else if(!(dob.match("[0-9+$]")))
	{
		error+="Field: Date of Birth has invalid character";
	}
	else
	{
		var spl=dob.split('-');
		var d=new Date(spl[0],spl[1]-1,spl[2]);
		
		/*alert(d);
		alert(spl[0]);
		alert(d.getYear());
		alert(spl[2]);
		alert(d.getDate());
		
		alert(spl[1]);
		alert(d.getMonth());*/
		
		if(!(d  && d.getDate()==spl[2] && d.getMonth()==spl[1]-1))
		{
			
			error+="Field: Date of Birth has invalid input";
		}
		
	}
	return error;
}
function nsi_presentphoneno(obj)
{
	var error="";
	var permphone=obj.value;
	error+=nsi_presentphonenovalidate(permphone);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_presentphonenovalidate(phoneno)
{
	var error='';
	if(!(phoneno.match("[0-9]+$")) && phoneno!='')
	{
		error+="Field: Present Phone Number can contain only digits";
	}
	return error;
}


function nsi_presentemail(obj)
{
	var error="";
	var email=obj.value;

	error+=nsi_presentemailvalidate(email);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		
		obj.style.color= '#000000';
	}
}
function nsi_presentemailvalidate(email)
{
	var error='';
	if(email=='')
		return error;
	var lastaro=email.lastIndexOf('@');
	var firstaro=email.indexOf('@');
	var lastdot=email.lastIndexOf('.');
	var length=email.length;
	if(!(lastaro<lastdot-1 && lastaro==firstaro && firstaro>0 && lastdot<length-2))
		error+="Field: Email Address contains invalid input";
	
	return error;
}
function nsi_presentmobno(obj)
{
	var error="";
	var presentmobile=obj.value;
	error+=nsi_presentmobilenovalidate(presentmobile);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}

function nsi_presentmobilenovalidate(mobno)
{
	var error='';
	if(!(mobno.match("[0-9]+$")) && mobno!='')
	{
		error+="Field: Present Mobile Number can contain only digits";
	}
	return error;
}
function nsi_permadd(obj)
{
	var error="";
	var permadd=obj.value;
	error+=nsi_permaddressvalidate(permadd);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_permaddressvalidate(permadd)
{
	
	var error="";
	if(permadd=="")
		error+="Field: Permanent Address cannot be left empty";
	return error;
}

function nsi_permemail(obj)
{
	var error="";
	var email=obj.value;

	error+=nsi_permemailvalidate(email);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
	
		obj.style.color= '#000000';
	}
}
function nsi_permemailvalidate(email)
{	
	
	var error="";
	if(email=="")
	{
		error+="Field: Permanent Email Address cannot be empty";
	}
	//else if(!(email.match("[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]+[\.]{1}[a-z]{3,4}$")))
	else
	{
		var lastaro=email.lastIndexOf('@');
		var firstaro=email.indexOf('@');
		var lastdot=email.lastIndexOf('.');
		var length=email.length;
		if(!(lastaro<lastdot-1 && lastaro==firstaro && firstaro>0 && lastdot<length-2))
			error+="Field: Email Address contains invalid input";
	}
	return error;
	
}

function nsi_permphone(obj)
{
	var error="";
	var permphone=obj.value;
	error+=nsi_permphonenovalidate(permphone);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_permphonenovalidate(permphone)
{
	
	var error="";
	if(permphone=="")
	{
		error+="Field: Permanent Phone Number cannot be empty";
	}
	else if(!(permphone.match("[0-9]+$")))
	{
		error+="Field: Permanent Phone Number can contain only digits";
	}
	return error;
}

function nsi_permmob(obj)
{
	var error="";
	var permmobile=obj.value;
	error+=nsi_permmobilenovalidate(permmobile);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_permmobilenovalidate(permmobile)
{
	
	var error="";
	if(permmobile=="")
	{
		error+="Field: Permanent Mobile Number cannot be empty";
	}
	else if(!(permmobile.match("[0-9]+$")))
	{
		error+="Field: Permanent Mobile Number can contain only digits";
	}
	return error;
}


function nsi_board(obj)
{
	var error="";
	var board=obj.value;
	error+=nsi_boardvalidate(board);
	if(error!="")
	{
		alert(error);
		obj.style.color= '#cc0000';
	}
	else
	{
		obj.style.color= '#000000';
	}
}
function nsi_boardvalidate(board)
{
	var error="";
	if(board=="")
	{
		error+="Field: Board cannot be left empty";
	}
	return error;
}

function nsi_perc(obj)
{
	
	var error="";
	var perc=obj.value;
	error+=nsi_percvalidate(perc);
	if(error!="")
	{
		alert(error);
		obj.style.color = '#cc0000';
	}
	else
	{
		
		obj.style.color= '#000000';
	}
}

function nsi_percvalidate(perc)
{
	
	var error="";
	
	if(perc=="")
	{
		
		error+="Field: Percentagecannot be left blank";
	}
	else if(!(perc.match("[0-9\.]+$")))
	{
		
		error+="Field: Percentage contains invalid characters";
	}
	else if(!(((perc.length==2|| perc.length==1) && perc.indexOf('.')==-1) || (perc.length>3 && perc.length<=6 && perc.indexOf('.')==2) || (perc.indexOf('.')==1 && perc.length>2 && perc.length<=5)) && perc!=100)
	{
	
		error+="Field: Percentage has invalid format";
	}
	
	return error;
}
function nsi_sgpavalidate(sgpa,a)
{
	
	var error="";

	if(sgpa!="")
		a=1;
	if(a==1)
	{
		if(sgpa=="")
		{
			
			error+="Field: SGPA/CGPA cannot be left blank";
		}
		else if(!(sgpa.match("[0-9\.]+$"))) 
		{
			
			error+="Field: SGPA/CGPA contains invalid characters";
		}
		else if(!(sgpa.length==1 || ((sgpa.length==3 || sgpa.length==4 )&& sgpa.indexOf('.')==1 )) && sgpa!=10)
		{
			
		
			error+="Field: SGPA/CGPA has invalid format";
		}
	}
	
	return error;
}
function nsi_sgpa(obj,a)
{
	var error="";
	var sgpa=obj.value;
	error+=nsi_sgpavalidate(sgpa,a);
	if(error!="")
	{
		alert(error);
		obj.style.color = '#cc0000';
	}
	else
	{
		
		obj.style.color= '#000000';
	}
}
function nsi_mysemvalidate(monthyear,a)
{
	
	var error="";
	if(monthyear!='')
		a=1;
	if(a==1)
	{
		if(monthyear=="")
		{
			error+="Field: Month of passing cannot be left blank";
			
		}
		else if(!(monthyear.match("[0-9+$]")))
		{
			error+="Field: Month of passing has invalid characters";
		}
		else
		{
			if(!(monthyear.lastIndexOf('-')==4 && monthyear.indexOf('-')==4) || monthyear.length!=7)
			{
				error+="Field: Month of passing has invalid format";
			}
			else if(!((monthyear[5]=='0' && monthyear[6]!='0') || (monthyear[5]=='1' && ( monthyear[6]=='1' || monthyear[6]=='2' || monthyear[6]=='0'))))
			{
				error+="Field: Month of passing has invalid month";
			}
			
		}
	}
	return error;
}
function nsi_mysem(obj,a)
{
	var error="";
	var monthyear=obj.value;

	error+=nsi_mysemvalidate(monthyear,a);
	if(error!="")
	{
		alert(error);
		obj.style.color = '#cc0000';
	}
	else
	{
		
		obj.style.color= '#000000';
	}
	
}


function nsi_interndays(obj)
{
	var error="";
	var days=obj.value;
	error+=nsi_interndaysvalidate(days);
	if(error!="")
	{
		alert(error);
		obj.style.color = '#cc0000';
	}
	else
	{
		
		obj.style.color= '#000000';
	}
}
function nsi_interndaysvalidate(days)
{
	var error="";
	if(!(days.match("[0-9]+$")))
	{
		error="Field: Duration (in days) can contain only numbers";
	}
	else if(days<=0)
	{
		error="Field: Duration (in days) can contain only positive numbers";
	}
	return error;
}
function resume_validate(obj)
{
	var name=obj.value;
	var size=obj.files[0].size;
	var ext=name.substring(name.lastIndexOf('.'));
	if(size>5242880)
	{
		obj.value='';
		alert("Only Files of size 5 MB or less are acceptable");
	}
	else if(ext!='.doc' && ext!='.docx' && ext!='.pdf')
	{
		obj.value='';
		alert("File type not allowed!");
	}
}

function student_validate()
{
	//alert("here");

	if(nsi_fullnamevalidate(document.newstudentinfo.fullname.value) || nsi_dobvalidate(document.newstudentinfo.dob.value) 
	|| nsi_permaddressvalidate(document.newstudentinfo.permaddress.value) || nsi_permphonenovalidate(document.newstudentinfo.permphone.value) 
	||  nsi_permmobilenovalidate(document.newstudentinfo.permmobno.value) || nsi_permemailvalidate(document.newstudentinfo.permemail.value)
	|| nsi_presentphonenovalidate(document.newstudentinfo.presentphone.value) 
	||  nsi_presentmobilenovalidate(document.newstudentinfo.presentmobno.value) || nsi_presentemailvalidate(document.newstudentinfo.presentemail.value)
	|| nsi_boardvalidate(document.newstudentinfo.board10.value) || nsi_boardvalidate(document.newstudentinfo.board12.value)
	|| nsi_percvalidate(document.newstudentinfo.perc10.value) || nsi_percvalidate(document.newstudentinfo.perc12.value) 
	|| nsi_sgpavalidate(document.newstudentinfo.sgpa1.value,1) || nsi_sgpavalidate(document.newstudentinfo.sgpa2.value,1)
	|| nsi_sgpavalidate(document.newstudentinfo.sgpa3.value,1) || nsi_sgpavalidate(document.newstudentinfo.sgpa4.value,1)
|| nsi_sgpavalidate(document.newstudentinfo.sgpa5.value,2) || nsi_sgpavalidate(document.newstudentinfo.sgpa6.value,2)
	|| nsi_sgpavalidate(document.newstudentinfo.sgpa7.value,2) || nsi_sgpavalidate(document.newstudentinfo.sgpa8.value,2)
	|| nsi_mysemvalidate(document.newstudentinfo.mysem1.value,1)|| nsi_mysemvalidate(document.newstudentinfo.mysem2.value,1) 
	|| nsi_mysemvalidate(document.newstudentinfo.mysem3.value,1)|| nsi_mysemvalidate(document.newstudentinfo.mysem4.value,1)
	|| nsi_mysemvalidate(document.newstudentinfo.mysem5.value,2)|| nsi_mysemvalidate(document.newstudentinfo.mysem6.value,2) 
	|| nsi_mysemvalidate(document.newstudentinfo.mysem7.value,2)|| nsi_mysemvalidate(document.newstudentinfo.mysem8.value,2) 
	|| nsi_sgpavalidate(document.newstudentinfo.cgpa1.value,1) || nsi_sgpavalidate(document.newstudentinfo.cgpa2.value,1)
	|| nsi_sgpavalidate(document.newstudentinfo.cgpa3.value,1) || nsi_sgpavalidate(document.newstudentinfo.cgpa4.value,1)
|| nsi_sgpavalidate(document.newstudentinfo.cgpa5.value,2) || nsi_sgpavalidate(document.newstudentinfo.cgpa6.value,2)
	|| nsi_sgpavalidate(document.newstudentinfo.cgpa7.value,2) || nsi_sgpavalidate(document.newstudentinfo.cgpa8.value,2)
		)
	/*	
		|| nsi_mysemvalidate(document.newstudentinfo.mysem5.value)|| nsi_mysemvalidate(document.newstudentinfo.mysem6.value) 
	|| nsi_mysemvalidate(document.newstudentinfo.mysem7.value)|| nsi_mysemvalidate(document.newstudentinfo.mysem8.value)
	|| nsi_percvalidate(document.newstudentinfo.sgpa5.value) || nsi_percvalidate(document.newstudentinfo.sgpa6.value)
	|| nsi_percvalidate(document.newstudentinfo.sgpa7.value) || nsi_percvalidate(document.newstudentinfo.sgpa8.value)
	|| nsi_interndaysvalidate(document.newstudentinfo.intern_days[0]) || nsi_interndaysvalidate(document.newstudentinfo.intern_days[1])
	|| nsi_interndaysvalidate(document.newstudentinfo.intern_days[2]) || nsi_interndaysvalidate(document.newstudentinfo.intern_days[3]) 
	|| nsi_interndaysvalidate(document.newstudentinfo.intern_days[4]) 	|| nsi_interndaysvalidate(document.newstudentinfo.intern_days[5])
		|| nsi_interndaysvalidate(document.newstudentinfo.intern_days[6])
	if(typeof(document.newstudentinfo.mysem1.value)=='undefined' || document.newstudentinfo.mysem1.value==null || nsi_mysemvalidate(document.newstudentinfo.mysem1.value))
	
	 nsi_percvalidate(document.newstudentinfo.perc10.value) || nsi_percvalidate(document.newstudentinfo.perc12.value) 
	|| nsi_percvalidate(document.newstudentinfo.sgpa1.value) || nsi_percvalidate(document.newstudentinfo.sgpa2.value)
	|| nsi_percvalidate(document.newstudentinfo.sgpa3.value) || nsi_percvalidate(document.newstudentinfo.sgpa4.value))*/
	{
		alert("Please correct the input in the blank/red fields");
		return false;
	}
	else
	{
		//alert("allright");
		return true;
	}
	
}
