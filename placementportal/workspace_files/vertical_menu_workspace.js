function navigationtitlemouseover()
{
		var navtitle=document.getElementById('navigationtitle');
		var navtitlemouseon=document.getElementById('navigationtitlemouseon');
		navtitle.style.display='none';
		navtitlemouseon.style.display='block';
}
function navigationtitlemouseout()
{
	var navtitle=document.getElementById('navigationtitle');
		var navtitlemouseon=document.getElementById('navigationtitlemouseon');
		navtitle.style.display='block';
		navtitlemouseon.style.display='none';
}
function bringbacknavmouseover()
{
	var bringbacknav=document.getElementById('bringbacknav');
	bringbacknav.style.backgroundColor='#666666';
	bringbacknav.style.color='#FFFFFF';
}
function bringbacknavmouseout()
{
	var bringbacknav=document.getElementById('bringbacknav');
	bringbacknav.style.backgroundColor='#C9C9C9';
	bringbacknav.style.color='#000000';
}
function hidenavigation()
{
	var navigation=document.getElementById('vertical_menu');
	var bringbacknav=document.getElementById('bringbacknav');
	var content=document.getElementById('content');
	content.style.left='50px';
	content.style.width='960px';
	navigation.style.display='none';
	bringbacknav.style.display='block';
	
	var resultswindow=document.getElementById('results_window');
	if(resultswindow!=null)
		resultswindow.style.width='780px';
}
function shownavigation()
{
	var navigation=document.getElementById('vertical_menu');
	var bringbacknav=document.getElementById('bringbacknav');
	var content=document.getElementById('content');
	content.style.left='240px';
	content.style.width='770px';
	navigation.style.display='block';
	bringbacknav.style.display='none';
	
	var resultswindow=document.getElementById('results_window');
	if(resultswindow!=null)
		resultswindow.style.width='590px';
}
function expandcollapsesubmenu(tochange)
{
	//alert(tochange);
	var changedisplay=document.getElementById(tochange);
	if(changedisplay.style.display=='none')
		changedisplay.style.display='block';
	else
		changedisplay.style.display='none';
}