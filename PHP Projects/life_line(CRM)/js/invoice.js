
var clk=1;
function show_post()
{
    
    if(document.getElementById('total_bamount').value>document.getElementById('total_wazan').value)
        {
            document.getElementById('total_bamount').style.backgroundColor='pink';
        }
    else
    {
        
            document.getElementById('total_bamount').style.backgroundColor='#e9ecef';
    }
    if(document.getElementById('total_bamount').value<document.getElementById('total_wazan').value)
        {
            document.getElementById('total_wazan').style.backgroundColor='pink';
        }
    else
        {
            
            document.getElementById('total_wazan').style.backgroundColor='#e9ecef';
        }
    
    if(document.getElementById('total_bamount').value==document.getElementById('total_wazan').value)
        {
            
            document.getElementById('total_bamount').style.backgroundColor='darkseagreen';
            document.getElementById('total_wazan').style.backgroundColor='darkseagreen';
            
            document.getElementById('submit_btn').style.visibility='visible';
        }
}
function weight()
{
var total_weight=parseFloat(document.getElementById("total_weight").value);
var current_weight=parseFloat(document.getElementById("current_weight").value);
		
var net_weight=total_weight-current_weight;
	if(current_weight=="")
		{
	net_weight=total_weight;}
	document.getElementById("net_weight").value=net_weight;
}

function ins() {
	clk=clk+1;
	document.getElementById("press").value=clk;
    document.getElementById("r"+clk).style.display="";		
							
}

function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("myTable").deleteRow(i);
}
	function rem() {
	   clk=clk-1;
    var table = document.getElementById("myTable");
	   
	document.getElementById("press").value=clk;
    
    document.getElementById("r"+clk).style.display="none";
   }




function sumwasooli()
{
	var i=document.getElementById("ival").value;
	var sum=0;
	var x=0;
	var num=0;
	for(x=0;x<=i;x++)
		{
			num=0;
			num=parseFloat(document.getElementById("wasooli"+x).value);
		if(!isNaN(num))
			{
				sum=sum+num;
			}
		}
	document.getElementById("total_wasooli").value=sum;
}
function sumwazan()
{
	var i=document.getElementById("ival").value;
	var sum=0;
	var x=0;
	var num=0;
	for(x=0;x<=i;x++)
		{
			num=0;
			num=parseFloat(document.getElementById("wazan"+x).value);
		if(!isNaN(num))
			{
				sum=sum+num;
				//document.getElementById("amount"+x).value=parseFloat(document.getElementById("c_rate"+x).value)*num;
			}
		}
	document.getElementById("total_wazan").value=sum;
	
}

function sumamount()
{
	var i=document.getElementById("ival").value;
	var sum=0;
	var x=0;
	var num=0;
	for(x=0;x<=i;x++)
		{
			num=0;
			num=parseFloat(document.getElementById("amount"+x).value);
		if(!isNaN(num))
			{
				sum=sum+num;
			}
		}
	document.getElementById("total_bamount").value=sum;

}