<?php
//$table_name="medicine_potency";
//$column="potency";
$table_name=$_REQUEST['table_name'];
$column=$_REQUEST['column'];
include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit'])) 
{
	
		$column_val=ucwords($_REQUEST['column']);
$pg=$_REQUEST['pg'];
$table_name=$_REQUEST['table_name'];
$column=$_REQUEST['column_name'];
	$sql="INSERT INTO `$table_name` (`$column`, `sort`) VALUES ('$column_val', '1000')";
	$query=mysqli_query($con,$sql);
    if($query)
    {
        
	alertredirect("$column_val Added Successfully",$pg);
    }
    else
    {
        
	alertredirect("Something Went Wrong!!!!",$pg);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="">
			<?php breadcrumb(); ?>
			<form>
			<div class="col-lg-12">
                <div class="row">
      <div class="col-6">
          <label class="text-danger"><strong><?php echo ucwords($column); ?>:</strong></label>
          <input class="form-control input-lg" placeholder="<?php echo ucwords($column); ?>" type="text" name="column" required>
          <input type="hidden" name="pg" value="<?php  echo basename( $_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="table_name" value="<?php echo $table_name ?>">
          <input type="hidden" name="column_name" value="<?php echo $column ?>">
        </div>
                <div class="col-3">
                        <label class=""><strong></strong></label>
                        <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-primary col-12">
      </div>
        
      </div>  
               
            
				
					
				
			</div>
		</div>
			</form>
            <?php //include("symptoms_tabs.php"); ?>
		<div class="col-lg-12">
						<?php include("fix_header.php"); ?>
							
							<tr>
								<th><?php echo ucwords($column); ?></th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
                                
							$sqlview="SELECT * FROM `$table_name` ";
                            
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								
								<td>
<!--
									
									<a href="courier_list_edit.php?name=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-success">Edit</button></a>
-->
                                    <?php
                                     $times=showQuery("SELECT COUNT(*) FROM `$table_name` WHERE $column='$rowview[0]'");
                        
                         if(true)
                         {
                             $page=basename( $_SERVER['REQUEST_URI']);
                            // echo $page;
                                    ?>
									<a onClick="return confirm('Do You Want To Delete Permanently?');" href="del.php?del_suggestion=<?php echo "$rowview[0]&table_name=$table_name&column=$column&page=$page" ?>"><button class="btn-sm btn-danger">Delete</button></a>
                                    <?php } ?>
</td>
								
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
<script src="vendor/jquery/jquery.js"></script>  
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
 <script src="vendor/datatables/jquery.dataTables.js"></script>  
 <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
 <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />   
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script> 
</html>