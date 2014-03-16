var nameoforgdone=false;
var usernamedone=false;
var passdone=false;
var addressdone=false;
var contactnodone=false;
var emailaddressdone=false;
function validateonsubmit()
{

	if(nameoforgdone && passdone && usernamedone && addressdone &&  contactnodone)
	{
		return true;
	}
	else
	{
		alert('Please correct the red/blank fields');
		return false;
	}
}
function emailaddressvalidate()
{
	var emailaddressele=document.getElementById('emailaddress');
	var email=emailaddressele.value;
	if(email=="")
	{
		alert("Field: Email Address cannot be empty");
		emailaddressdone=false;
		emailaddressele.style.color='#cc0000';
	}
	//else if(!(email.match("[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]+[\.]{1}[a-z]{3,4}$")))
	else
	{
		var lastaro=email.lastIndexOf('@');
		var firstaro=email.indexOf('@');
		var lastdot=email.lastIndexOf('.');
		var length=email.length;
		if(!(lastaro<lastdot-1 && lastaro==firstaro && firstaro>0 && lastdot<length-2))
		{
			alert("Field: Email Address contains invalid input");
				emailaddressdone=false;
		emailaddressele.style.color='#cc0000';
		}
		else
		{
				emailaddressdone=true;
		emailaddressele.style.color='#000000';
		}
	}
	
}
function nameoforgvalidate()
{
	var nameoforgele=document.getElementById('nameoforganisation');
	
	if(nameoforgele.value=='')
	{
		nameoforgdone=false;
		nameoforgele.style.color='#cc0000';
		alert("Field: Name of Organisation cannot be left blank");
	}
	
	else 
	{
		nameoforgele.style.color='#000000';
		nameoforgdone=true;
	}
}
function passwordvalidate()
{
	var passwordele=document.getElementById('password');
	var confirmpasswordele=document.getElementById('confirmpassword');
		if(passwordele.value!='' && confirmpasswordele.value!='')
		{
			if(passwordele.value!=confirmpasswordele.value )
			{
				alert('The two passwords do not match');
				passwordele.style.color='#cc0000';
				confirmpasswordele.style.color='#cc0000';
				
				passdone=false;
			}
			else if(passwordele.value.length<8)
			{
				alert('Password should be atleast 8 characters long');
				passwordele.style.color='#cc0000';
				confirmpasswordele.style.color='#cc0000';
				
				passdone=false;
			}
			else
			{	
				
				passwordele.style.color='#000000';
				confirmpasswordele.style.color='#000000';
				passdone=true;
			}
		}
		else
		{
			passdone=false;
		}
}
function contactnovalidate()
{
	var contactnoele=document.getElementById('contactno');
	var contactno=contactnoele.value;
	if(contactno=='')
	{
				contactnodone=false;
		contactnoele.style.color='#cc0000';
		alert("Field: Contact number cannot be left blank");
	}
	else if(!(contactno.match('[0-9]+$')))
	{
		contactnodone=false;
		contactnoele.style.color='#cc0000';
		alert("Field: Contact number can only contain digits");
	}
	else
	{
		contactnoele.style.color='#000000';
		contactnodone=true;
	}
}
function addressvalidate()
{
var addressele=document.getElementById('address');
	if(addressele.value=='')
	{
		addressdone=false;
		addressele.style.color='#cc0000';
		alert('Field: Address cannot be left blank');
		
	}
	else
	{
		addressele.style.color='#000000';
		addressdone=true;
	}
}
function usernamevalidate()
{
	var usernameele=document.getElementById('username');
	if(usernameele.value=='')
	{
		usernamedone=false;
		usernameele.style.color='#cc0000';
		alert("Field: Username cannot be left blank");
	}
	else if(usernameele.value.length>20)
	{
		usernamedone=false;
		usernameele.style.color='#cc0000';
		alert("Field: Username cannot be more than 20 characters long");
	}
	else 
	{
		usernameele.style.color='#000000';
		usernamedone=true;
	}
}