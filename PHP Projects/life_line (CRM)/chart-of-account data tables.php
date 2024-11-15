<?php
include("config.php");
include("allFunctions.php");

if(isset($_REQUEST['submit']))
{
$m_accountid=$_REQUEST['m_accountid'];	
$account=$_REQUEST['account'];	
$accounttype=$_REQUEST['accounttype'];	
$remarks=$_REQUEST['remarks'];	
$address=$_REQUEST['address'];	
$contactno=$_REQUEST['contactno'];	
$crlimit=$_REQUEST['crlimit'];	
$netbalance=$_REQUEST['netbalance'];	
$acct_no=$_REQUEST['acct_no'];	
$selbal=$_REQUEST['selbal'];	
$commitee=$_REQUEST['commitee'];	
$weight_less=$_REQUEST['weight_less'];	
$rate=$_REQUEST['rate'];	
$act_code=$_REQUEST['act_code'];	
$sms=$_REQUEST['sms'];	
	
$sql="INSERT INTO `master_account` (`m_accountid`, `account`, `accounttype`, `remarks`, `address`, `contactno`, `crlimit`, `netbalance`, `acct_no`, `selbal`, `commitee`, `weight_less`, `rate`, `act_code`, `sms`, `trial170`) VALUES (NULL, '$account', '$accounttype', '$remarks', '$address', '$contactno', '$crlimit', '0', NULL, '$selbal', '$commitee', '$weight_less', '$rate', '$act_code', '$sms', NULL)";
$query=mysqli_query($con,$sql);
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Chart of Account </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="background-color: #B4E320">
			<div class="col-lg-8">
				<div class="border ">
					<input type="button" value="First">
					<input type="button" value="Next">
					<input type="button" value="Previous">
					<input type="button" value="Last">
					<input type="button" value="New">
					<input type="button" value="...">
					<a href="index.php">
					<button class=" btn-danger element-align-left">Close</button></a>
				</div>
			</div>
			<div class="border col-lg-4">
				
			</div>
			<br/>
			<br/>
			<form method="post">
			<div class="border col-lg-8">
				<div class="form-group">
					<label>Account ID: <input class="form-control" type="number" name="m_accountid" value="<?php echo getNextId("m_accountid","master_account"); ?>"></label>
					<label class="element-align-left">Act_Code: <input class="form-control" type="number" name="act_code" value=""></label>
					<br/>
					<br/>
					<label>Account: <input class="form-control" type="text" name="account" value=""></label>
					<label class="element-align-left">Account Type: 
						<select class="form-control" required name="accounttype">
						<option value="">Select Type</option>
							<?php populateDD("accounttype","accountdescription","accounttypeid") ?>
						</select></label>
					<br/>
					<br/>
					<label>Area:
						<select class="form-control" required name="address">
						<option value="">Select Area</option>
							<?php populateDD("arealist","areaname","areaid") ?>
						</select></label>
					<label class="element-align-left">contact number: <input class="form-control" type="text" name="contactno" value=""></label>
					<br/>
					<br/>
					<label>Remarks: <input class="form-control" type="text" name="remarks" value=""></label>
					<label class="element-align-left">Credit Limit<input class="form-control" type="number" name="crlimit" value=""></label>
					<br/>
					<br/>
					<div class="vAlign">
						<label>Committee
						<select class="form-control" name="commitee">
						<option>YES</option>	
						<option>NO</option>	
						</select>
						</label>
						<label class="">Rate<input class="mediumInputBox form-control"type="number" name="rate" value=""></label>
						<label class="">Weight_less<input class="mediumInputBox form-control"type="number" name="weight_less" value=""></label>
					</div>
					<br/>
					<br/>
					<div class="vAlign">
						<label class="">Show Balance:<input class="form-check-input" type="checkbox" name="selbal" value="1"></label>
						<label class="">SMS:<select class="form-control" name="sms">
							<option>YES</option>
							<option>NO</option>
							</select></label>
						<br>
						<input type="submit" name="submit" class="btn btn-primary">
						<input type="reset" class="btn btn-secondary" value="Clear All">
					</div>
				</div>
			
			</div>
			<div class="border col-lg-4 text-center">
				<h1><?php echo $project_name; ?></h1>
			</div>
		</div>
			</form>
		<div class="col-lg-12">
				<div class="table-responsive">
					<table id="employee_data" class="table table-striped table-bordered" style="width:100%">  
                          <thead>  
                               <tr>  
                                    <th>Acc_Code</th>
									<th>Account_ID</th>
									<th>Account Name</th>
									<th>Account Type</th>
									<th>Balance</th>
									<th>Area</th>
									<th>Contact #</th>
									<th>Remarks</th>
									<th>Credit</th>
									<th>Show Balance</th>
									<th>Committee</th>
									<th>Weight</th>
									<th>SMS</th>
									<th>Rate</th>
									<th>Edit</th>
									<th>Delete</th>
                               </tr>  
                          </thead>  
                          <?php  
                          $query ="SELECT * FROM `master_account`  
							ORDER BY `master_account`.`m_accountid`  DESC";  
							 $result = mysqli_query($con, $query);  
                          while($rowview = mysqli_fetch_array($result)){ ?>


                          	<tr>
								<td><?php echo $rowview[13]; ?></td>
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo showQuery("SELECT accountdescription FROM `accounttype` WHERE accounttypeid='$rowview[2]'") ; ?></td>
								<td><?php echo $rowview[7]; ?></td>
								<td><?php echo showQuery("SELECT areaname FROM `arealist` WHERE areaid='$rowview[4]'") ; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[10]; ?></td>
								<td><?php echo $rowview[11]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
								<td><?php echo $rowview[12]; ?></td>
								<td><a href="chart_of_account_edit.php?chart_of_account_id=<?php echo $rowview['m_accountid'];?>"><button class="btn btn-success btn-sm">Edit</button></a></td>
								<td><a href="chart_of_account_delete.php?chart_of_account_id=<?php echo $rowview['m_accountid'];?>"><button class="btn btn-danger btn-sm">Delete</button></a></td>
							</tr>
                             <?php } ?>  
                     </table>  
				</div>
				</div>
			</div>
	</div>
<br>
<br>
<br>
 

           
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
 <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />            
 
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script> 