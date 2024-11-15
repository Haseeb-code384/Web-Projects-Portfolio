<?php
include("config.php");
$id=$_REQUEST['id'];
$sql="SELECT * FROM `inquiry` WHERE id='$id'";

			$queryview=mysqli_query($con,$sql);
							$rowview=mysqli_fetch_array($queryview); ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<h1 align="center">Inquiry Information</h1>
<body>
	<table border="1" width="100%">
		<thead align="center">
			<tr align="center" bgcolor="#48BDD5">
								<th>ID</th>
								<th>Given By</th>
								<th>Source</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Province</th>
								<th>District</th>
								<th>Tehsil</th>
								<th>Area</th>
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview['gender']; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
		</tr>
					
	</table>
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>Address 1</th>
								<th>Address 2</th>
								<th>Phone 1</th>
								<th>Phone 1 Network</th>
								<th>Phone 2</th>
								<th>Phone 2 Network</th>
								<th>WhatsApp</th>
								<th>Profile</th>
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[8]; ?></td>
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[10]; ?></td>
								<td><?php echo $rowview[11]; ?></td>
								<td><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[13]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
								<td><a href="<?php echo $rowview[15]; ?>" target="new"><button>Visit Link</button></a></td>
		</tr>
					
	</table>
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>CNIC</th>
								<th>Referral</th>
								<th>Age</th>
								<th>Height</th>
								<th>Weight</th>
								<th>Marital Status</th>
								<th>Children</th>
								<th>Education</th>
								<th>Occupation</th>
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview['cnic']; ?></td>
								<td><?php echo $rowview['referral']; ?></td>
								<td><?php echo $rowview['age']; ?></td>
								<td><?php echo $rowview['height']; ?></td>
								<td><?php echo $rowview['weight']; ?></td>
								<td><?php echo $rowview['marital_status']; ?></td>
								<td><?php echo $rowview['children']; ?></td>
								<td><?php echo $rowview['education']; ?></td>
								<td><?php echo $rowview['occupation']; ?></td>
		</tr>
					
	</table>
	
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th colspan="3" >Symptoms</th>
							</tr>
            <tr>
                <th>SN</th>
                <th>Symptom</th>
                <th>Description</th>
            </tr>
						</thead>
        <?php
        $i=1;
        $sqlsymp="SELECT symptom_name,description FROM `symptom_inquiry` WHERE inquiry_id='$id'";
        $querysymp=mysqli_query($con,$sqlsymp);
        while($rowsymp=mysqli_fetch_array($querysymp))
        {
        
        ?>
		<tr align="center">
							<td><?php echo $i; ?></td>
							<td><?php echo $rowsymp[0]; ?></td>
							<td><?php echo $rowsymp[1]; ?></td>
		</tr>
        <?php $i++; } ?>
	</table>
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>Call Status</th>
								<th>Called At</th>
								<th>Recall Date</th>
								<th>Order Status</th>
								<th>Order Confirmed At</th>
								<th>Committed Amount</th>
								<th>Appointment At</th>
								<th>Comments</th>
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[16]; ?></td>
								<td><?php echo $rowview[17]; ?></td>
								<td><?php echo $rowview[18]; ?></td>
								<td><?php echo $rowview[19]; ?></td>
								<td><?php echo $rowview[20]; ?></td>
								<td><?php echo $rowview['committed_amount']; ?></td>
								<td><?php echo $rowview[21]; ?></td>
								<td><?php echo $rowview[22]; ?></td>
								
		</tr>
					
	</table>
	
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>Allocated To</th>
								<th>Allocated At</th>
								<th>Created By</th>
								<th>Created At</th>
								<th>Last Activity</th>
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[23]; ?></td>
								<td><?php echo $rowview[24]; ?></td>
								<td><?php echo $rowview[25]; ?></td>
								<td><?php echo $rowview[26]; ?></td>
								<td><?php echo $rowview[27]; ?></td>
								
		</tr>
					
	</table>
	
</body>
</html>
