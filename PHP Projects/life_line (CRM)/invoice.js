function cal_dis(x)
{
	
var r1=parseFloat(document.getElementById("reading1").value);
var r2=parseFloat(x);
	var dis= r2-r1;
	document.getElementById("distance").value=dis;
	
}

function fuel(x)
{
var distance=parseFloat(document.getElementById("distance").value);
var per_km=parseFloat(document.getElementById("per_km").value);
var fuel_rate=parseFloat(document.getElementById("fuel_rate").value);
	var fuel_charges= fuel_rate*(distance/per_km);
	document.getElementById("fuel_charges").value=fuel_charges;
	
}