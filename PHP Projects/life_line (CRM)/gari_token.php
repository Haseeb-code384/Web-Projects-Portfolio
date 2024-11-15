<?php
 
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}
include("config.php");
include("allFunctions.php");
include("start.php");

if(isset($_REQUEST['submit']))
{
	$gari_no=$_REQUEST['gari_no'];
	$owner_name=$_REQUEST['owner_name'];
	$token_start_date=$_REQUEST['token_start_date'];
	$token_end_date=$_REQUEST['token_end_date'];
	$token_amount=$_REQUEST['token_amount'];
	$sql="INSERT INTO `gari_token` (`id`, `gari_no`, `owner_name`, `token_start_date`, `token_end_date`, `token_amount`, `entered_at`) VALUES (NULL, '$gari_no', '$owner_name', '$token_start_date', '$token_end_date', '$token_amount', '$currentDateTime')";
	$query=mysqli_query($con,$sql);
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Account  </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="background-color: grey">
			
			<br/>
			<br/>
			
		<h1 align="center"><?php echo $project_name; ?><br> Vehicle Token Data</h1>
			<form>
			<div class="border col-lg-12">
				<div class="form-group vAlign">
					<label>Gari ID: <input class="form-control input-lg" type="number" name="id" value="<?php echo getNextId("id","gari_token"); ?>"></label>
					<br/>
					<br/>
					<label class="">Gari No: <input class="form-control input-lg" type="text" required name="gari_no" value=""></label>
					<br/>
					<label class="">Owner Name: <input class="form-control input-lg" type="text" required name="owner_name" value=""></label>
					<br/>
					<label class="">Token Start Date: <input class="form-control input-lg" type="date" required name="token_start_date" value=""></label>
					<br/>
					<label class="">Token End Date: <input class="form-control input-lg" type="date" required name="token_end_date" value=""></label><br/>
					<label class="">Token Amount: <input class="form-control input-lg" type="number" required name="token_amount" value=""></label>
					<br/>
									<br>
					<input type="submit" name="submit" class="btn-sm btn-primary">
				</div>
			</div>
		</div>
			</form>
		<div class="col-lg-12">
				<table class="table">
						<thead>
							
							<tr>
								<th>Gari ID </th>
								<th>Gari No.</th>
								<th>Owner Name</th>
								<th>Token Start Date</th>
								<th>Token End Date</th>
								<th>Days Left</th>
								<th>Token Amount</th>
								<th>Entry Date</th>
								
							</tr>
						</thead>
						<tbody>
							
							<?php
							$sqlview="SELECT *,DATEDIFF(token_end_date, CURRENT_DATE ) AS 'daysleft'  FROM `gari_token` ORDER BY daysleft ASC";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								
								<td><?php echo $rowview[7]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								
							</tr>
							
							<?php } ?>
							</tbody>
					</table>
			</div>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>