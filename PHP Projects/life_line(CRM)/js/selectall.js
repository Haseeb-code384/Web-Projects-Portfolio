function selall(x,name) {
	var state=x.checked;
	if(state==true)
		{
	var checkboxes = document.getElementsByName(name);
    for (var checkbox of checkboxes) {
        checkbox.checked="checked";
    }		
		}
	if(state==false)
		{			
	var checkboxes = document.getElementsByName(name);
    for (var checkbox of checkboxes) {
        checkbox.checked=false;
		}
}
}
function selallno(x,name) {
	var no=parseInt(x.value);
	if(no>0)
        {
            var checkboxes = document.getElementsByName(name);
    for (var i=0;i<no;i++) {
        checkboxes[i].checked="checked";
    }
        }
    else
        {
            var checkboxes = document.getElementsByName(name);
    for (var checkbox of checkboxes) {
        checkbox.checked=false;
		}
        }
	
}