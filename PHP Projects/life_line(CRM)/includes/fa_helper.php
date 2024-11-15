<?php
include("../config.php");
$sql="SELECT * FROM `fa4_7_0`";
$query=mysqli_query($con,$sql);
?>
<!doctype html>
<html>
<head>
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

<meta charset="utf-8">
<title>FA HELPER</title>
</head>

<body>
<table>
	<tr>
	<th>ID</th>
	<th>NAME</th>
	<th>ICON</th>
	</tr>
	<?php
	while($row=mysqli_fetch_array($query))
	{
	?>
	<tr>
		
	<td><?php echo $row[1]; ?></td>
	<td><?php echo $row[0]; ?></td>
	<td><i style="font-size: 26pt;" class="fa <?php echo $row[1]; ?>"></i></td>
	</tr>
	<?php } ?>
	</table>
	</body>
</html>
