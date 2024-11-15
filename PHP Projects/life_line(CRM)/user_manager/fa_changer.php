<?php
include("../config.php");
$id=$_REQUEST['id'];
$sqlold="SELECT fa_icon FROM `menu` WHERE menu_id='$id'";
$query_old=mysqli_query($con,$sqlold);
$rowold=mysqli_fetch_array($query_old);

$sql="SELECT * FROM `fa4_7_0` order by icon='$rowold[0]' DESC;";

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
<table border="1">
	<tr>
	<th>NAME</th>
	<th>ICON</th>
	</tr>
	<?php
	while($row=mysqli_fetch_array($query))
	{
	?>
	<tr>
	<td><?php echo $row[1]; ?>
	<i style="font-size: 26pt;" class="fa <?php echo $row[1]; ?>"></i>
		
		</td>
		<td>
			<button>
		<a href="update_icon.php?id=<?php echo $id; ?>&f=<?php echo $row[1]; ?>">Select</a></button>
		</td>
	</tr>
	<?php } ?>
	</table>
	</body>
</html>
