<?php
include( "config.php" );
include( "allFunctions.php" );
include( "preloader.php" );
if(isset($_REQUEST['type']))
{
    
        $sql="SELECT * FROM `medicine_list` WHERE type='$_REQUEST[type]'";       
    $type=$_REQUEST['type'];
}else
{
    
        $sql="SELECT * FROM `medicine_list` ";
    $type="All";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<body>
    <h3 align="center"><?php echo $project_name; ?></h3>
    <table width="100%" border="1">
        <tr>
        <th align="center" colspan="6"><?php echo $type; ?> Medicine List</th>
        </tr>
    	<tr>
								<th>#</th>
								<th>Medicine Name</th>
								<th>Medicine Name</th>
								<th>Roman Name</th>
								<th>Scientific Name</th>
								<th>Urdu Name</th>
							</tr>
        <?php
        $query=mysqli_query($con,$sql);
        $i=1;
        while($row=mysqli_fetch_array($query))
        {
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
        <td><?php echo ucwords($row[0]);  ?></td>
        <td><?php echo ucwords($row[1]);  ?></td>
        <td><?php echo ucwords($row[3]);  ?></td>
        <td><?php echo ucwords($row[4]);  ?></td>
        <td><?php echo ucwords($row[5]);  ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
