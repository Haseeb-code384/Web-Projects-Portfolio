<?php
include( "config.php" );
include( "allFunctions.php" );
$id=$_REQUEST['id'];
$sql_data="SELECT * FROM `inquiry` WHERE id='$id'";
$query_data=mysqli_query($con,$sql_data);
$row_data=mysqli_fetch_array($query_data);
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
				document.getElementById(x).setAttribute('', '');
		
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
    
<script src="network.js"></script>
</head>

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
 
  <?php breadcrumb(); ?>
  <div class="row" style="">
  <form method="post" action="process_update_inquiry.php">
      
          <label  class="text-danger"><strong>Inquiry No:</strong> </label>
      <input type="text" required readonly name="id" class="form-control" value="<?php echo $id ?>">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Contact Information Form</div>
      </div>
        
      <div class="row">
        <div class="col-sm-6">
          <label  class="text-danger"><strong>PHONE 1:</strong> </label>
          <input  class="form-control <?php if($rowview['phone1']=="") 
{ 
    echo 'bg-danger text-white'; 
} ?>"  onKeyUp="get_network1(this.value);" type="text" name="phone1"   placeholder="Enter Phone 1"  required  id="phone1" maxlength="15" value="<?php echo $row_data['phone1'] ?>" >
        </div>
        <div class="col-sm-6">
          <label  class="text-danger"><strong>Phone 1 Network:</strong></label>
          <select name="phone1network"  required  id="phone1network"   class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['phone1network']) ?>
            <?php populateDDdistinct("network","network") ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label><strong>PHONE 2:</strong> </label>
          <input  class="form-control" type="text"  onKeyUp="get_network2(this.value);"  name="phone2" id="phone2" placeholder="Enter Phone 2"  maxlength="15" value="<?php echo $row_data['phone2'] ?>" >
        </div>
        <div class="col-sm-6">
          <label><strong>Phone 2 Network:</strong></label>
          <select name="phone2network"  id="phone2network"   class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['phone2network']) ?>
            <?php populateDDdistinct("network","network") ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label><strong>WhatsApp:</strong>
            <input type="radio" onClick="copynum(this.value);" value="phone1" name="cpy">
            Same as Phone 1
            <input type="radio" onClick="copynum(this.value);" value="phone2" name="cpy">
            Same as Phone 2 </label>
          <input class="form-control <?php if($rowview['whatsapp']=="") 
{ 
    echo 'bg-danger text-white'; 
} ?>"  value="<?php echo $row_data['whatsapp'] ?>" type="text" name="whatsapp" placeholder="923xxxxxxxxx" maxlength="12" id="whatsapp" pattern="923([0-9])[0-9]{8}" title="923xxxxxxxxx">
        </div>
        <div class="col-sm-6">
          <label><strong>Profile Link: </strong></label>
          <input class="form-control" type="url"  value="<?php echo $row_data['profile_link'] ?>" name="profile_link"  placeholder="Enter Social Media Profile Link">
        </div>
      </div>
          <div class="row">
        <div class="col-12">
          <label class=""><strong>Customer Name: </strong></label>
          <input class="form-control <?php if($rowview['name']=="") 
{ 
    echo 'bg-danger text-white'; 
} ?>"  value="<?php echo $row_data['name'] ?>" type="text" name="name"  placeholder="Enter Customer Name">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Given By:</strong></label>
          <select name="given_by"  class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['given_by']) ?>
            <option>Office</option>
            <option>Seller</option>
            <option>Walk In Customer</option>
          </select>
        </div>
        <div class="col-sm-6">
          <label class="text-danger"><strong>Source:</strong></label>
          <select name="source" required class="form-select">
            <?php populateDDsel("source_platform","source_platform","source_platform",$row_data['source']) ?>
          </select>
        </div>
      </div>
            <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Record Type:</strong></label>
          <select name="record_type "  class="form-select <?php if($rowview['record_type']!="Patient") 
{ 
    echo 'bg-danger text-white'; 
} ?>">
         <?php populateDDsel("patient_record_type","patient_record_type","patient_record_type",$row_data['record_type']); ?>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>Record Date:</strong></label>
       <input type="date" name="patient_since" class="form-control" value="<?php echo $row_data['patient_since'] ?>" >
        </div>
      </div>    
        <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Patient Id:</strong></label>
       <input type="text" name="patient_id" class="form-control"  value="<?php echo $row_data['patient_id'] ?>" >
        </div>
            <div class="col-sm-6">
          <label class=""><strong>Google Drive Link:</strong></label>
        
       <input type="text" name="google_drive_link" class="form-control"  value="<?php echo $row_data['google_drive_link'] ?>" >
        </div>
      </div>
    <div class="row">
        
        <div class="col-sm-6">
          <label class=""><strong>Delivery Status:</strong></label>
       <input type="text" name="delivery_status" class="form-control"  value="<?php echo $row_data['delivery_status'] ?>" >
        </div>
           <div class="col-sm-6">
          <label class=""><strong>Expected Reorder Date:</strong></label>
       <input type="date" name="expected_reorder_date" class="form-control"  value="<?php echo $row_data['expected_reorder_date'] ?>" >
        </div>
      </div>
          
        <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Other Information:</strong></label>
    <textarea name="other_information" class="form-control"><?php echo $row_data['other_information'] ?></textarea>    
    
        </div>    <div class="col-sm-6">
          <label class=""><strong>Record Remarks:</strong></label>
             <textarea name="record_remarks" class="form-control"><?php echo $row_data['record_remarks'] ?></textarea>  
        </div>  
    
        </div>
 
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Province:</strong></label>
          <select name="province" id="province"   onChange="change_dist(this.value);"  class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['province']) ?>
            <?php populateDDdistinct("province","tehsils") ?>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>District:</strong></label>
          <select name="district"  onChange="change_Tehsil(this.value);" id="district"  class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['district']) ?>
            <option value="">Select District</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Tehsil:</strong></label>
          <select name="tehsil"  id="tehsil"  class="form-select">
              
   <?php setSelectOptionIfNotNull($row_data['tehsil']) ?>
            <option  value="">Select Tehsil</option>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>Area: </strong></label>
          <input class="form-control"  value="<?php echo $row_data['area'] ?>" type="text" name="area"  placeholder="Enter Area Name">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Postal Address 1: </strong></label>
          <textarea   class="form-control <?php if($rowview['address1']=="") 
{ 
    echo 'bg-danger text-white'; 
} ?>" placeholder="Postal Address 1" rows="5" name="address1"><?php echo $row_data['address1'] ?></textarea>
        </div>
        <div class="col-sm-6">
          <label><strong>Postal Address 2: </strong></label>
          <textarea class="form-control" placeholder="Postal Address 2" rows="5" name="address2"><?php echo $row_data['address2'] ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label><strong>CNIC:</strong></label>
          <input class="form-control" type="text" name="cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" placeholder="xxxxx-xxxxxxx-x"  value="<?php echo $row_data['cnic'] ?>" title="format is xxxxx-xxxxxxx-x" maxlength="15">
        </div>
        <div class="col-sm-6">
          <label><strong>Referral: </strong></label>
          <input class="form-control"  value="<?php echo $row_data['referral'] ?>" type="text" name="referral"  placeholder="Enter Reference or Referral Name">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label><strong>Education:</strong></label>
          <input class="form-control" value="<?php echo $row_data['education'] ?>" type="text" name="education" placeholder="MA/BA/PhD" >
        </div>
        <div class="col-sm-6">
          <label><strong>Occupation: </strong></label>
          <input class="form-control"  value="<?php echo $row_data['occupation'] ?>" type="text" name="occupation"  placeholder="Doctor/Engineer/Farmer/Student">
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Biological Information </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Gender:</strong></label>
          <select class="form-select"  name="gender" >
              
   <?php setSelectOptionIfNotNull($row_data['gender']) ?>
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>Age: </strong></label>
          <input class="form-control"  value="<?php echo $row_data['age'] ?>" type="number" name="age" maxlength="2"  placeholder="Enter Age e.g 18/32/66" >
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>Height: </strong></label>
          <select class="form-select" name="height" >
              
   <?php setSelectOptionIfNotNull($row_data['height']) ?>
            <option value="">Select Height</option>
            <?php
            for ( $ft = 2; $ft <= 7; $ft++ ) {
              for ( $in = 0; $in <= 11; $in++ ) {
                ?>
            <option><?php echo $ft.".".$in; ?></option>
            <?php
            }
            }

            ?>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>Weight: </strong></label>
          <input class="form-control"  value="<?php echo $row_data['weight'] ?>" type="number" name="weight" maxlength="3"  placeholder="100" >
        </div>
      </div>
      <div class="row">
		  <div class="col-sm-6">
          <label class=""><strong>Marital Status: </strong></label>
          <select class="form-select" name="marital_status" >
   <?php setSelectOptionIfNotNull($row_data['marital_status']) ?>
            <option value="">Select Marital Status</option>
            <option>Married</option>
            <option>Unmarried</option>
            <option>Divorced</option>
          </select>
        </div>
        <div class="col-sm-6">
          <label class=""><strong>Children: </strong></label>
          <select class="form-select" name="children" >
              
            <option><?php echo $row_data['children']; ?></option>
            <?php

            for ( $in = 0; $in <= 20; $in++ ) {
              ?>
            <option><?php echo $in; ?></option>
            <?php
            }

            ?>
          </select>
        </div>
        <div class="col-sm-12">
          <label class=""><strong>Disease (Press CTRL To Select Multiple):</strong></label>
          <select multiple name="disease[]" id="disease" style="height: 300px;" title="Press CTRL To Select Multiple"  class="form-select">
            
            <?php populateDDsel("disease WHERE disease NOT IN (SELECT disease FROM `inquiry_disease` WHERE inquiry_id='$id')","disease","disease","") ?>
          </select>
          </div>
      </div>
		       <script>
     function show_symp()           
{
    if ( document.getElementById("eye").classList.contains('fa-eye') )
        {
          document.getElementById("eye").classList.remove('fa-eye');
    document.getElementById("eye").classList.add('fa-eye-slash');
document.getElementById("symp_row").style.display="contents";   
        }
    else
        {
            
    document.getElementById("eye").classList.remove('fa-eye-slash');
          document.getElementById("eye").classList.add('fa-eye');
document.getElementById("symp_row").style.display="none";   
        }
   
}
        </script>
		     <div class="row">
        <div class="col-12 text-center h5" style="background-color: #7A382C;color: #F8C401;"> Symptoms <i class="fa fa-eye" id="eye" title="Hide / Unhide Symptoms" onClick="show_symp()"></i></div>
      </div>
      <div class="row" style="display: none;" id="symp_row">
        <div class="col-md-12">
			
      <div class="row">
        <div class="col-md-12">
			
      <div class="row">
			<?php
          $sympdesc="";
          $cat="";
			$sqlsymp="SELECT symptom_name,category FROM `symptoms` WHERE active=1 AND for_inquiry=1 order by category,sort ASC ,symptom_name ASC";
			$querysymp=mysqli_query($con,$sqlsymp);
			while($rowsymp=mysqli_fetch_array($querysymp))
			{
                ?>
          
          <?php
			if($cat!=$rowsymp[1])
            {
             $cat=$rowsymp[1];
                ?>
            <div class="col-12 bg-secondary text-capitalize text-center h5"><?php echo $cat; ?></div>
          
          <?php
            }
                 $sympdesc=showQuery("SELECT description FROM `symptom_inquiry` WHERE inquiry_id='$id' AND symptom_name='$rowsymp[0]' "); 
                
			?>
          
        <div class="col-md-4">
		<input type="text" class="form-control"  name="symptom_value[]" placeholder="Description for <?php echo $rowsymp[0]; ?>" value='<?php echo $sympdesc; ?>' id="<?php echo $rowsymp[0]; ?>_tb" style="<?php
        
        if($sympdesc=="")
        {
            echo "display: none";
        }
        ?>; margin-bottom: 8px;">
         <input type="checkbox" onClick="en_textbox(this.value)" name="symptom_name[]" value="<?php echo $rowsymp[0]; ?>" <?php   if($sympdesc!="")
        {
            echo "checked";
        } ?> class="btn-check" id="<?php echo $rowsymp[0]; ?>" autocomplete="off">
			
<label class="btn-sm btn-outline-danger col-12" style="<?php
        if($sympdesc!="")
        {
            echo "background-color: #dc3545; color: white;";
        }?>" for="<?php echo $rowsymp[0]; ?>"><?php echo $rowsymp[0]; ?></label>
			
			
			 </div>
		
			<?php $sympdesc=""; } ?>
        </div>
        </div>
      
      </div>
		
		
    </div>
    </div>
    <div class="col-12 text-center"> <br>
        <div class="col-12 text-center">
            <label>Permanently Allocate:</label>
        <select name="permanent_allocation" class="form-select text-center" required>
        <option  value="<?php $row_data['permanent_allocation'] ?>"><?php echo showbool($row_data['permanent_allocation']) ?></option>
        <option  value="0">No</option>
        <option  value="1">Yes</option>
        </select>
        
        </div>
        <br>
      <input type="submit" name="submit" class="btn-sm btn-primary">
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