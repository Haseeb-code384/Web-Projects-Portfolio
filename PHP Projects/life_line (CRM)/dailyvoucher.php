<?php
include( "config.php" );
include( "allFunctions.php" )
?>
<?php include("preloader.php"); ?>
<!DOCTYPE html>
<html>
<head>
<!--
	
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
	
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/css/bootstrap-select.min.css" rel="stylesheet"/>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
	
	
-->

<link href="cdn/bootstrap.min.css" rel="stylesheet"/>
<link href="cdn/bootstrap-select.min.css" rel="stylesheet"/>
<script src="cdn/jquery.min.js"></script> 
<script src="cdn/bootstrap.min.js"></script> 
<script src="cdn/bootstrap-select.min.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<script src="js/invoice.js"></script>
<style>
	.tableFixHead          {   overflow: auto;height: 100%; }
.tableFixHead thead th { background-color: lightgray; position: sticky; top: 0; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 110%; }
th     { background-color: pink; }
	</style>
<script src="jquery-2.1.4.min.js"></script> 
<script type="text/javascript">
    document.addEventListener('keydown', function (event) {
  if (event.keyCode === 13 && event.target.nodeName === 'INPUT') {
    var form = event.target.form;
    var index = Array.prototype.indexOf.call(form, event.target);
    form.elements[index - 1].focus();
    event.preventDefault();
  }
});
    </script>
<style>
	form,nav,input,select,td,select{ font-size: 13pt;}
	</style>
</head>
<?php
include "start.php";
?>
<div class="content-wrapper">
<?php breadcrumb(); ?>
<div class="container-fluid" style="">
<form id="myform" method="POST" action="process_dailyvoucher.php" enctype="multipart/form-data">

<!--
					<a href="sale-invoce.php"><button>New Invoice</button></a>
					<button onClick="window.location.href='edit_invoice.php?invoice='+document.getElementById('inv').value;"><i class="fa fa-search"></i></button>
-->
<div class="row">
<input class ="btn btn-success" type="submit" value="Post" onClick="return confirm('Are You Sure You Want To Submit Voucher?')" id="submit_btn" style="visibility: hidden;">
<div class="col-sm-12 text-center">
   <div class=" row border border-secondry">
    <div class="col-sm-2">
     <label>Voucher #:</label>
<input class ="form-control" value="<?php echo getNextId("id","daily_voucher") ?>" type="text" placeholder="Enter invoice number" name="invoice_no" required id="inv" >
					</div>
        <div class="col-sm-2">
       <label>Date:</label>
       <input class ="form-control" type="date" required name="date" id="date" value="<?php echo date("Y-m-d"); ?>"
					</div>
  </div>
   <div class="col-sm-4">
    <label>Remarks:</label>
    <textarea placeholder="Enter Remarks" class ="form-control"  required name="remarks" id="remarks"></textarea>
  </div>
   <div class="col-sm-4">
    <label>Type:</label>
    <select name="type" class="form-select" required>
       <option value="">Select Voucher Type</option>
       <option value="CPV">Cash Payment Voucher (CPV)</option>
       <option value="CRV">Cash Receipt Voucher (CRV)</option>
       <option value="BPV">Bank Payment Voucher (BPV)</option>
       <option value="BRV">Bank Receipt Voucher (BRV)</option>
       <option value="JV">Journal Voucher (JV)</option>
     </select>
  </div>
 </div>
<div class="row text-center">
<input type="hidden" id="press" value="1">
<div class="table-responsive-sm tableFixHead">
<table id="myTable" class="table table-striped table-bordered table-sm" >
<thead>
   <tr>
    <th style="background-color: #00FF2C" colspan="3">Out Side Dr (بنام)(لینے والا)</th>
    <th colspan="3" style="background-color: #00B3FF">In Side Cr (جمع) (دینے والا)</th>
  </tr>
   <tr> 
    <!--
							<th>Upload</th>

-->
    <th><input type="text" class="form-control fw-bolder" value="0" style="font-size: 12pt;"  required readonly  id="total_bamount" name="sold_amount">
       <br>
       Total Dr Amount</th>
    <th>Description</th>
    <th>Account</th>
    <!--
							
							<th>Upload</th>
							
-->
    <th><input type="text" class="form-control fw-bolder" value="0" style="font-size: 12pt;"  required readonly id="total_wazan" name="sold_weight">
       <br>
       Total Cr Amount</th>
    <th >Description</th>
    <th>Account</th>
  </tr>
 </thead>
<tbody>
   <?php
   for ( $i = 0; $i <= 20; $i++ ) {

     ?>
   <tr> 
    
    <!--
							<td><input style="font-size: 5px;" type='file' name='drupload[]'></td>
						
-->
    <td><input type='number' step="0.01" <?php echo ($i == 0) ? "required" : ""; ?>  class="form-control" placeholder='Dr Amount' name='damount[]'id="amount<?php echo $i; ?>" onKeyUp="sumamount();show_post();" ></td>
    <td><textarea  <?php echo ($i == 0) ? "required" : ""; ?> type='text'  class="form-control" placeholder='Description' name='ddesc[]' onKeyUp="document.getElementById('crdesc<?php echo $i; ?>').value=this.value;" id="drdesc<?php echo $i; ?>"></textarea></td>
    <!--
							<td>

								<select class="form-select-sm" name="drtype[]" id="sel<?php //echo $i; ?>">
								<?php 
				//	populateDD('inv_type','name','id'); ?>
								</select>

</td>
-->
    <td><select  <?php echo ($i == 0) ? "required" : ""; ?>  class="form-control selectpicker  form-select-sm"  id="select-country" data-live-search="true" name="draccount[]" style="height: 200px;">
       <?php
       $account_filter="Dr";
       include( "voucher_optgroup_element.php" )
       ?>
</select>
</td>

<!--							<td><input  style="font-size: 5px;"  type='file' name='crupload[]' ></td>-->
<td><input class="form-control"  <?php echo ($i == 0) ? "required" : ""; ?> type='number' placeholder='Cr Amount' step="0.01" name='wazan[]'id="wazan<?php echo $i; ?>" onKeyUp="sumwazan();show_post();" ></td>
<td><textarea type='text'  <?php echo ($i == 0) ? "required" : ""; ?> class="form-control" placeholder='Description' onKeyUp="document.getElementById('drdesc<?php echo $i; ?>').value=this.value;" name='farq[]' id="crdesc<?php echo $i; ?>"></textarea></td>

<!--
							<td>

								<select class="form-select-sm" name="crtype[]" id="sel<?php echo $i; ?>">
								<?php 
					//populateDD('inv_type','name','id'); ?>
								</select></td>
-->
<td><select  <?php echo ($i == 0) ? "required" : ""; ?>   class="form-control selectpicker "  id="select-country" data-live-search="true" name="craccount[]" >
    <?php
$account_filter="Cr";
    include( "voucher_optgroup_element.php" );
    ?>
    
								?>
  </select></td>
</tr>
<?php
}
?>
</tbody>
</table>
<br>
<br>
<br>
</div>
</form>
<!--
				<button class="btn-sm btn-success" type="button" onclick="ins()" title="Add More Rows">+</button>
<button class="btn-sm btn-danger"  type="button"  onclick="rem()" title="Remove Last Row">-</button>
-->

<input type="hidden" id="ival" value="<?php echo $i-1; ?>">
</div>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
 	
 	jQuery(document).ready(function($){
    let picker = $('.selectpicker');
        picker.selectpicker();

    $(document).on('click', picker, function () {
        $('#group').html(
            $('option:selected', picker).parent('optgroup').prop('label') || 'no group'
        );
        $('#text').html(
            $('option:selected', picker).text()
        );
        $('#value').html(
            picker.val()
        );
    });
});

 </script>