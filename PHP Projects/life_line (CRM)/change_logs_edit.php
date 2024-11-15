<?php
$id=$_REQUEST['id'];

include("config.php");
include("allFunctions.php");

$row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `change_log` WHERE id='$id'"));

if(isset($_REQUEST['submit']))
{
	$subject=$_REQUEST['subject'];
	$description=$_REQUEST['description'];
	$priority=$_REQUEST['priority'];
	$developer_comments=$_REQUEST['developer_comments'];
	$closing_comments=$_REQUEST['closing_comments'];
	$status=$_REQUEST['status'];
	

	$sql="UPDATE `change_log` SET `subject` = '$subject', `description` = '$description',`status` = '$status', `priority` = '$priority',developer_comments = '$developer_comments',closing_comments = '$closing_comments' WHERE `change_log`.`id` = '$id'";
	$query=mysqli_query($con,$sql);
	alertredirect("Log Changed Successfully","change_logs.php");
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
                <input type="hidden" value="<?php echo $id; ?>" name="id">
			<div class="col-lg-12">
                <div class="row">
      <div class="col-6">
          <label class="text-danger"><strong>Subject:</strong></label>
          <input class="form-control input-lg" value="<?php echo $row['subject'] ?>" placeholder="Enter Change Subject" type="text" name="subject" required>
        </div>
                      <div class="col-6">
          <label class="text-danger"><strong>Priority:</strong></label>
          <select name="priority" required class="form-select">
                        <option><?php echo $row['priority'] ?></option>
              <option>Low</option>
              <option>Normal</option>
              <option>High</option>
                    </select>
        </div>
        
        
      </div>  
                <div class="row">
     <div class="col-12">
          <label class="text-danger"><strong>Description:</strong></label>
             <textarea  name="description" required placeholder="Description"  class="form-control input-lg" ><?php echo $row['description'] ?></textarea>
         
     				
             
        </div>
     </div>
                  <div class="row">
     <div class="col-12">
          <label class=""><strong>developer_comments:</strong></label>
             <textarea  name="developer_comments" placeholder="developer_comments"  class="form-control input-lg" ><?php echo $row['developer_comments'] ?></textarea>
         
     				
             
        </div>
     </div>        <div class="row">
     <div class="col-12">
          <label class=""><strong>closing_comments:</strong></label>
             <textarea  name="closing_comments" placeholder="closing_comments"  class="form-control input-lg" ><?php echo $row['closing_comments'] ?></textarea>
         
     				
             
        </div>
     </div>
               
                <div class="row">
                  <label class="text-danger"><strong>status:</strong></label>
          <select name="status" required class="form-select col-6">
                        <option><?php echo $row['status'] ?></option>
              <option>Pending</option>
              <option>In Progress</option>
              <option>Done</option>
                    </select>
                </div>
                <div class="row">
        
                    <div class="col-2">
                        <label class=""><strong></strong></label>
                        <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-success col-12" value="Update">
      </div>
      </div>
     
				
					
				
			</div>
		</div>
			</form>
	
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