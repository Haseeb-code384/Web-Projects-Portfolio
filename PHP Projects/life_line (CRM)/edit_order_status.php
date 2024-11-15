<?php

include("config.php");
include("allFunctions.php");
$sql_info="SELECT * FROM `order_status`";
$query_info=mysqli_query($con,$sql_info);
if(isset($_REQUEST['submit']))
{
     $order_status = $_REQUEST['order_status'];
     $color = $_REQUEST['color'];
   for($i=0;$i<count($order_status);$i++)
   {
       	$sql="UPDATE `order_status` SET `color` = '$color[$i]' WHERE `order_status`.`order_status` = '$order_status[$i]';";
	$query=mysqli_query($con,$sql);
   }
    
        
  alertredirect( "Saved Successfully", "edit_order_status.php" );
	
}
?>
<!DOCTYPE html>
<html>
<head>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
    <style>
    textarea {
      width: 100%;
      height: 300px;
    }
  </style>
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="">
			
		
			<?php breadcrumb(); ?>
			<form method="post">
			<div class="col-lg-12">
                <div class="row">
              
                 <table class="table-sm table-bordered table-hover">
                    <tr>
                     <th>Status Name</th>
                     <th>Color</th>
                     </tr>
                     <?php
                     while($row_info=mysqli_fetch_array($query_info))
                     {
                     ?>
                     <tr>
                     <td><input type="hidden" value="<?php echo $row_info[0]; ?>" name="order_status[]"><?php echo $row_info[0]; ?></td>
                     <td><input type="color" value="<?php echo $row_info[2]; ?>" name="color[]"></td>
                     </tr>
                     <?php } ?>
                    </table>   
                 
                    
                </div>
				    
                  <br>
                 
                  
					<input type="submit" value="Save" name="submit" class="btn-sm btn-success">
				</div>
			</div>
		</div>
			</form>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>