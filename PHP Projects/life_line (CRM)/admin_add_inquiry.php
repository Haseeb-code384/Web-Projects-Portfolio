<?php
include( "config.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
    $phone1=$_REQUEST['phone1'];
    $sqlsearch="SELECT id FROM `inquiry` WHERE phone1='$phone1' OR phone2='$phone1' OR whatsapp='$phone1'";
    if(showQuery($sqlsearch)!="")
    {
        alertredirect("This Number Already Exists In Database","#");
    }
    else
    {
        header("Location: admin_add_inquiry_form.php?num=$phone1");
        echo "<script>window.location.href=' admin_add_inquiry_form.php?num=$phone1';</script>";
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<script>
		function copynum(x)
{
	document.getElementById("whatsapp").value=document.getElementById(x).value;
}
	function en_textbox(x)
	{
			var val=x;
		x=x+"_tb";
		if(document.getElementById(val).checked == true)
			{
				document.getElementById(x).style.display = "block";
				document.getElementById(x).setAttribute('required', '');
		
		document.getElementById(x).focus();
			}
		else
			{
				
				document.getElementById(x).style.display = "none";
				document.getElementById(x).value = "";
			}
		
	
	//	alert(x);
	//	document.getElementById(x).disabled = false;
		
	}
	</script> 
<script src="semester.js"></script>
<script>
    
    function putcode()
    {
var x=document.getElementById('phone1'); 
    x.value=document.getElementById('ccode').value;
       if(x.value=="92")
           {
               
				x.setAttribute('pattern', '923([0-9])[0-9]{8}');
				x.setAttribute('maxlength', '12');
           }
        else
           {
               
				x.removeAttribute("pattern");
				x.removeAttribute("maxlength");
           }
        
    x.focus();   
    }    
</script>
</head>

<body onLoad="putcode();">
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
 
  <?php breadcrumb(); ?>
  <div class="row" style="">
  <form method="post">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Contact Information </div>
      </div>
    
      <div class="row">
        <div class="col-sm-12">
          <label  class="text-danger"><strong>PHONE or WhatsApp:</strong> </label>
            <div class="row">
            <div class="col-sm-3">
            <select class="form-select" required id="ccode" onChange="putcode();">
            <?php populateDDsel("countrycode","concat(code,' ',name)","code","92"); ?>
            </select>
                
        </div>
                
            <div class="col-sm-9">
          <input name="phone1" type="text" placeholder="923xxxxxxxxx" pattern="923([0-9])[0-9]{8}" title="923xxxxxxxxx"  required class="form-control" id="phone1" placeholder="Enter Phone Number"  title="Enter Phone Number"   maxlength="12">
        </div>
                
            
        </div>
        </div>
     
      </div>
     
    </div>
    <div class="col-12 text-center"> <br>
      <input type="submit" name="submit" value="Search" class="btn-sm btn-primary">
      <input type="reset" class="btn-sm btn-secondary" value="Clear All">
    </div>
    </div>
    </div>
  </form>
</div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>