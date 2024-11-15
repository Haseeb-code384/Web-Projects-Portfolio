<?php
 
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}

include("config.php");
include("allFunctions.php")
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
	<script src="js/invoice.js"></script>
	<style>
	.tableFixHead          { overflow: auto; height: 500px; }
.tableFixHead thead th { background-color: lightgray; position: sticky; top: 0; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px;  }
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
</head>
<body>
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper"  style="margin-top: -37px;">
	<div class="container-fluid" style="margin-top: -50px;">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2><u> Sales Invoice </u></h2>
			</div>
		</div>
		
		<form action="process_invoice.php" id="myform">
					<label>Invoice #:</label>
					<input class ="mediumInputBox" value="<?php echo getNextId("invoice_no","tbl_dailysale") ?>" type="text" placeholder="Enter invoice number" name="invoice_no" required id="inv" onDblClick="window.location.href='edit_invoice.php?invoice='+document.getElementById('inv').value;">
					<a href="sale-invoce.php"><button>New Invoice</button></a>
					<button onClick="window.location.href='edit_invoice.php?invoice='+document.getElementById('inv').value;"><i class="fa fa-search"></i></button>
		<div class="row">
			
					<input class ="btn btn-success" type="submit" value="Post Invoice">
			<div class="col-lg-12 text-center">
				<div class=" row border border-secondry">
					
					
			<div class="col-lg-3 ">
					<label>Date:</label>
					<input class ="form-control" type="date" required name="date" id="date" onChange="document.getElementById('total_weight').focus();">
					</div>
			<div class="col-lg-3 ">
			
					<label>پارٹی کا نام:</label>
					ِ<select class="form-select" required name="supplier_id" onChange="document.getElementById('date').focus();">	
					
					<?php
					populateDD("master_account","concat(account,'|',netbalance)","m_accountid");
					?>
					</select>
				</div>
			
				<div class="col-lg-2 ">
				<label>ڈیزل</label>
					<input id="diesel" type="number" class="form-control" required name="diesel">
					</div>
				<div class="col-lg-2 ">
				<label>گاڑی نمبر</label>
					<input id="gari_number" type="text" class="form-control" required name="gari_number">
					</div>
			<div class="col-lg-2 ">
			
				<label>روٹ</label>
				<select class="form-select" required name="route" autofocus onChange="document.getElementById('gari_number').focus();">
					<?php
					populateDD("arealist","areaname","areaid");
					?>
					</select>
					
				</div>
				</div>
			</div>
			<div class="col-lg-12 text-center">
				<div class="row">
					
			<div class="col-lg-2 ">
					<input  class="smallInputBox" type="number" name="total_amount" id="total_amount" required value="0" readonly style="background-color: lightgrey;" step="any" onBlur="document.getElementById('sel0').focus();">
					<label> کل رقم</label>
					</div>
					
			<div class="col-lg-2 ">
					<input class ="smallInputBox" type="number" name="supplier_rate" id="party_rate" step="any" onKeyUp="get_irate(this.value);" placeholder="پارٹی ریٹ">
					<label>پارٹی ریٹ</label>
				</div>
					
			<div class="col-lg-2 ">
					<input class ="smallInputBox" type="number" step="any" name="farm_rate" id="farm_rate" placeholder=" فارم ریٹ">
					<label> فارم ریٹ</label>
				</div>
					
			<div class="col-lg-2 ">
					<input class ="smallInputBox" type="number" step="any" name="supplied_net_weight" value="0" readonly style="background-color: lightgrey;" id="net_weight">
					<label>بقایا وزن</label>
				</div>
					
			<div class="col-lg-2 ">
					<input class ="smallInputBox" type="number" step="any" name="supplied_less_weight" id="current_weight" onKeyUp="weight();" placeholder="کم وزن">
					<label>کم وزن</label>
				</div>
					
			<div class="col-lg-2 ">
					<input class="smallInputBox" type="number" step="any" name="supplied_total_weight" placeholder="ٹوٹل وزن" id="total_weight" required onKeyUp="weight();">
					<label>ٹوٹل وزن</label>
				</div>
				</div>
	<input type="hidden" id="press" value="1">
				<div class="table-responsive-lg tableFixHead">
				
				<table id="myTable" class="table table-striped table-bordered table-sm">
					<thead>
						<tr>
							<th>Delete Row</th>
							<th>تفصیل</th>
							<th><input type="text" class="smallInputBox fw-bolder" value="0" required readonly id="total_wasooli" name="sold_received" ><br>وصولی</th>
							<th><input type="text" class="smallInputBox fw-bolder" value="0"  required readonly  id="total_bamount" name="sold_amount"><br>مال رقم</th>
							<th>ریٹ</th>
							<th><input type="text" class="smallInputBox fw-bolder" value="0"  required readonly id="total_wazan" name="sold_weight"><br>وزن</th>
							<th>فرق</th>
							<th>دکان دار کا نام</th>
							<th> ٹوٹل بل  </th>
							<th> لیمٹ</th>
						</tr>
							<tr style="background-color: pink;">
						<th></th>
						<th></th>
						<th></th>
							
							<th></th>
						<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					
					</thead>
				
					<tbody>
						<?php for($i=0;$i<=70;$i++)
{
	
	 ?> 
						
						<tr>
							<td><button title="Delete This Row"  onclick="deleteRow(this)"><i class="fa fa-trash text-danger" ></i></button></td>
						<td><input type='text' placeholder='تفصیل' name='tafseel[]' class='smallInputBox' disabled  id="tafseel<?php echo $i; ?>"  onBlur="document.getElementById('seِl<?php echo $i+1; ?>').focus();"></td>
							<td><input type='number' placeholder='وصولی' name='wasooli[]'  class='smallInputBox' id="wasooli<?php echo $i; ?>" onKeyUp="sumwasooli();" disabled></td>
							<td><input type='number' placeholder='مال رقم' name='amount[]'  class='smallInputBox' id="amount<?php echo $i; ?>" onKeyUp="sumamount();" disabled></td>
							<td><input type='number' placeholder='ریٹ' name='rate[]'  class='smallInputBox' id="c_rate<?php echo $i; ?>" disabled></td>
							<td><input type='number' placeholder='وزن' name='wazan[]'  class='smallInputBox' id="wazan<?php echo $i; ?>" onKeyUp="sumwazan();" disabled></td>
							<td><input type='number' placeholder='فرق' name='farq[]' id="fark<?php echo $i; ?>"  class='smallInputBox' disabled></td>
							<td><select class="form-select-sm" name="customer[]" onChange="get_limit(this.value,<?php echo $i; ?>);" id="sel<?php echo $i; ?>">
								<?php 
					populateDD('master_account','account','m_accountid'); ?>
								</select></td>
							
							<td id='total_bill<?php echo $i; ?>'></td>
							<td id='limit<?php echo $i; ?>'></td>
							
							
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
				<button class="btn-lg btn-success" type="button" onclick="ins()" title="Add More Rows">+</button>
<button class="btn-lg btn-danger"  type="button"  onclick="rem()" title="Remove Last Row">-</button>
-->
				
	<input type="hidden" id="ival" value="<?php echo $i-1; ?>">
			</div>
		</div>
	</div>
</body>
</html>