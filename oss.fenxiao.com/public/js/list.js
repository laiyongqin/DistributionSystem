window.onload=function()
{
	var oLi=document.getElementsByTagName('li')	
	for(var i=0;i<oLi.length;i++)
	{
		if(i%2==0)
		{oLi[i].style.background='#FFF'}
		else
		{oLi[i].style.background='#f8f8f8'}
		
	}	
}