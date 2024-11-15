
function get_network(x){
   
         
	x=x.substring(0,5);
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","getNetwork.php?num="+x,false);
	xmlhttp.send(null);
	document.getElementById("phone1network").innerHTML=xmlhttp.responseText;   
        }
	
function get_network1(x){
    if(x.length==5)
        {
         
	x=x.substring(0,5);
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","getNetwork.php?num="+x,false);
	xmlhttp.send(null);
	document.getElementById("phone1network").innerHTML=xmlhttp.responseText;   
        }
	}

function get_network2(x){
    if(x.length==5)
        {
         
	x=x.substring(0,5)
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","getNetwork.php?num="+x,false);
	xmlhttp.send(null);
	document.getElementById("phone2network").innerHTML=xmlhttp.responseText;
	}
	}




