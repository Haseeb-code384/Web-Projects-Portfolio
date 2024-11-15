<?php

include("config.php");
include("allFunctions.php");
$sql_info="SELECT * FROM `status_list`";
$query_info=mysqli_query($con,$sql_info);
if(isset($_REQUEST['submit']))
{
     $status_name = $_REQUEST['status_name'];
     $color = $_REQUEST['color'];
   for($i=0;$i<count($status_name);$i++)
   {
       	$sql="UPDATE `status_list` SET `color` = '$color[$i]' WHERE `status_list`.`status_name` = '$status_name[$i]';";
	$query=mysqli_query($con,$sql);
   }
    
        
  alertredirect( "Saved Successfully", "edit_call_status.php" );
	
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
                     <td><input type="hidden" value="<?php echo $row_info[0]; ?>" name="status_name[]"><?php echo $row_info[0]; ?></td>
                     <td><input type="color" value="<?php echo $row_info[1]; ?>" name="color[]"></td>
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