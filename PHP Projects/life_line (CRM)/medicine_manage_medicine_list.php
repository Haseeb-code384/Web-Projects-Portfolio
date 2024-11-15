<?php
include("preloader.php");
//$table_name="medicine_potency";
//$column="potency";
$table_name="medicine_list";
include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit'])) 
{
	
		$abbreviation= strtolower($_REQUEST['abbreviation']);
		$medicine_name= strtolower($_REQUEST['medicine_name']);
		$roman_name= strtolower($_REQUEST['roman_name']);
		$type= $_REQUEST['type'];
		$scientific_name= strtolower($_REQUEST['scientific_name']);
		$urdu_name= strtolower($_REQUEST['urdu_name']);

$table_name=$_REQUEST['table_name'];
	$sql="INSERT INTO `medicine_list` (`abbreviation`, `medicine_name`, `type`, `roman_name`, `scientific_name`, `urdu_name`) VALUES ('$abbreviation', '$medicine_name', '$type', '$roman_name', '$scientific_name', '$urdu_name')";
	$query=mysqli_query($con,$sql);
    if($query)
    {
        
	alertredirect("Added Successfully","medicine_manage_medicine_list.php");
    }
    else
    {
        
	alertredirect("Something Went Wrong!!!!","medicine_manage_medicine_list.php");
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
            
          <a href="medicine_list.php" target="new">All Medicines</a>
          <a href="medicine_list.php?type=Herbal" target="new">Herbal Medicines</a>
          <a href="medicine_list.php?type=Homeopathic" target="new">Homeopathic Medicines</a>
                <div class="row">
      <div class="col-3">
          <label class="text-danger"><strong>Abbreviation:</strong></label>
          <input class="form-control" placeholder="Abbreviation" type="text" name="abbreviation" required>
        </div>  
        <div class="col-3">
          <label class="text-danger"><strong>Medicine Name:</strong></label>
          <input class="form-control" placeholder="Medicine Name" type="text" name="medicine_name" required>
        </div>
                    <div class="col-3">
          <label class="text-danger"><strong>Type:</strong></label>
                    <select class="form-select" name="type" required>
                    <?php populateDDsel("remedy_type","remedy_type","remedy_type","") ?>
                    </select>
        </div>
                    <div class="col-3">
          <label class=""><strong>Roman Name:</strong></label>
          <input class="form-control" placeholder="Roman Name" type="text" name="roman_name" >
        </div><div class="col-3">
          <label class=""><strong>Scientific Name:</strong></label>
          <input class="form-control" placeholder="Scientific Name" type="text" name="scientific_name" >
        </div>
                    <div class="col-3">
          <label class=""><strong>Urdu Name:</strong></label>
          <input class="form-control" placeholder="Urdu Name" type="text" name="urdu_name" >
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
								<th>Abbrv.</th>
								<th>Medicine Name</th>
								<th>Type</th>
								<th>Roman Name</th>
								<th>Scientific Name</th>
								<th>Urdu Name</th>
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
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								
								<td>
<!--
									
									<a href="courier_list_edit.php?name=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-success">Edit</button></a>
-->
                                    <?php
                        
                         if(true)
                         {
                             $page=basename( $_SERVER['REQUEST_URI']);
                            // echo $page;
                                    ?>
									<a onClick="return confirm('Do You Want To Delete Permanently?');" href="del.php?del_suggestion_entry=<?php echo "$rowview[0]" ?>"><button class="btn-sm btn-danger">Delete</button></a>
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