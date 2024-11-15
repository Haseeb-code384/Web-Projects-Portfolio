.html<?php
 
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
</head><script>
	function loadcntnt()
		{
			document.getElementById("preloader").style.display="none";
			document.getElementById("cntnt").style.visibility="visible";
		}
	</script>
</head>
<div id="preloader">
	<center>
	<img src="img/loading.gif" style="width: 100px; vertical-align: middle;">
	</center>
	
	</div>
<body  onLoad="loadcntnt();">

	<?php 
include "start.php"; ?></div>
			<div id="cntnt" style="visibility: hidden;" >
<div class="content-wrapper"  style="margin-top: -37px;">
	<div class="container-fluid" style="">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2><u>Demand</u></h2>
			</div>
		</div>
		
		<form id="myform" method="POST" action="process_dailyvoucher.php" enctype="multipart/form-data">
			
				
		<div class="row">
			
					<input class ="btn btn-success" type="submit" value="Post">
			<div class="col-sm-12 text-center">
				<div class=" row border border-secondry">
					
					
			<div class="col-sm-4">
					<label>Date:</label>
					<input class ="form-control" type="date" required name="date" id="date" value="<?php echo date("Y-m-d"); ?>"
					</div>
				</div>
			<div class="col-sm-4">
					<label>Remarks:</label>
					<input class ="form-control" type="text"  name="remarks" id="remarks"
					>
				
			</div>
			<div class="col-sm-4">
					<label>Salesman</label>
					<select required class="form-control selectpicker  form-select-sm"  id="select-country" data-live-search="true" name="salesman" style="height: 200px;">
								<?php 
					include("optgroup_element.php") ?>
								</select>
				
			</div>
			</div>
				
			<div class="row text-center">
				
	<input type="hidden" id="press" value="1">
				<div class="table-responsive-sm tableFixHead">
				
				<table id="myTable" class="table table-striped table-bordered table-sm" >
					<thead>
						<tr>
						
							
							<th>SN</th>
							<th width="50%">Product</th>
							<th width="50%">Quantity</th>
							
						</tr>
					
					</thead>
				
					<tbody>
						<?php for($i=1;$i<=150;$i++)
{
	
	 ?> 
						
						<tr>
							<td><?php echo $i; ?></td>
							
							<td>
								<select  class="form-control selectpicker  form-select-sm"  id="select-country" data-live-search="true" name="product[]" style="height: 200px;">
								<?php 
					include("optgroup_items.php") ?>
								</select>
							</td>
							
							<td>
							<input type="number" name="quantity[]" value="0">
							</td>
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