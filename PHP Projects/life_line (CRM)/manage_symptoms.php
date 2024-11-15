<?php

include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit']))
{
	$symptom_name=$_REQUEST['symptom_name'];
	$sort=$_REQUEST['sort'];
	$active=$_REQUEST['active'];
	$for_inquiry=$_REQUEST['for_inquiry'];
	
		$category=strtoupper($_REQUEST['category']);

	$sql="INSERT INTO `symptoms` (`symptom_name`, `sort`, `active`, `for_inquiry`, `category`) VALUES ('$symptom_name', '$sort', '$active', '$for_inquiry','$category')";
	$query=mysqli_query($con,$sql);
	
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
          <label class="text-danger"><strong>Symptom Name:</strong></label>
          <input class="form-control input-lg" placeholder="Enter Symptom Name" type="text" name="symptom_name" required>
        </div>
         <div class="col-6">
          <label class="text-danger"><strong>Category:</strong></label>
             <input list="category" name="category"  class="form-control input-lg"  type="text"  required placeholder="Enter Category Name">
     					
  <datalist id="category">
      <?php populateDDdistinct("category","symptoms") ?>
  </datalist>
             
        </div>
        
      </div>  
                <div class="row">
      <div class="col-3">
          <label class="text-danger"><strong>Sorting:</strong></label>
          <select name="sort" required class="form-select">
                        <option>Select Priority</option>
                        <option value="0">Top</option>
                        <option value="1">Normal</option>
                    </select>
        </div>
         <div class="col-3">
          <label class=""><strong>Active:</strong></label>
              <select name="active" class="form-select">
                        
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
             
        </div> 
                    <div class="col-3">
          <label class=""><strong>Use In Inquiry:</strong></label>
              <select name="for_inquiry" class="form-select">
                        
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
             
        </div>
        
                    <div class="col-3">
                        <label class=""><strong></strong></label>
                        <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-primary col-12">
      </div>
      </div>
				
					
				
			</div>
		</div>
			</form>
            <?php include("symptoms_tabs.php"); ?>
		<div class="col-lg-12">
						<?php include("fix_header.php"); ?>
							
							<tr>
								<th>Symptom Name</th>
								<th>Category</th>
								<th>Priority</th>
								<th>Active</th>
								<th>Use in Inquiry</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
                               if(isset($_REQUEST['cat']))
{
        $cat=$_REQUEST['cat'];
$sqlview="SELECT * FROM `symptoms`WHERE category='$cat'  order by sort ASC ,symptom_name ASC";
}
                            else
                            {
                                
							$sqlview="SELECT * FROM `symptoms`  order by sort ASC ,symptom_name ASC";
                            }
                            
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo ($rowview['category']); ?></td>
								<td><?php if($rowview[1]==0)
                            { echo "Top";
                            }
                                else
                                {
                                    echo "Normal";
                                }
                                    ?></td>
								<td><?php echo showbool($rowview[2]); ?></td>
								<td><?php echo showbool($rowview[3]); ?></td>
								<td>
									
									<a href="symptom_list_edit.php?name=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-success">Edit</button></a>
									<a href="del.php?symptom=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-danger">Delete</button></a>
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