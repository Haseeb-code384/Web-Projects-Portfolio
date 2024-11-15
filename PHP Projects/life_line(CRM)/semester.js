
function change_dist(x){
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","getDist.php?prov="+x,false);
	xmlhttp.send(null);
	document.getElementById("district").innerHTML=xmlhttp.responseText;
	}


function change_Tehsil(x){
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","getTehsil.php?dist="+x,false);
	xmlhttp.send(null);
	document.getElementById("tehsil").innerHTML=xmlhttp.responseText;
	}



