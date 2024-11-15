<?php

include( "config.php" );
include( "allFunctions.php" );

$id = $_REQUEST[ 'order_patient_id' ];
$sql_info = "SELECT type,status,time,allocated_to,allocated_by,order_no,comments,call_type,duration FROM `inquiry_status_history` WHERE inquiry_id='$id' and type='Feedback' ORDER BY id DESC";;
$query_info = mysqli_query( $con, $sql_info );
if ( isset( $_REQUEST[ 'comment' ] ) ) {
  session_start();
  $inquiry_id = $_REQUEST[ 'order_patient_id' ];
  $comment = ucwords( $_REQUEST[ 'comment' ] );
  $step_name =  $_REQUEST[ 'step_name' ] ;
  $call_type =  $_REQUEST[ 'call_type' ] ;
  $duration =  $_REQUEST[ 'duration' ] ;
  $call_status =  $_REQUEST[ 'call_status' ] ;
  $medicine_status =  $_REQUEST[ 'medicine_status' ] ;
  $patient_feedback =  $_REQUEST[ 'patient_feedback' ] ;
  $email = $_SESSION[ 'email' ];
  $seller = showQuery( "SELECT allocated_to FROM `inquiry` WHERE id='$inquiry_id'" );

  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`,`entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiry_id', 'Feedback', '$step_name', '$currentDateTime', '$seller', '$email', '', '$comment', '$duration', '$call_type','$email','$call_status','$medicine_status','$patient_feedback')" );


  alertredirect( "Saved Successfully", "view_feedback.php?order_patient_id=$inquiry_id" );

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
    <div class="row" >
    <?php breadcrumb(); ?>
    <form method="post">
      <div class="col-lg-12">
        <div class="row">
       
          <div class="col-sm-3">
            <label>Step Name</label>
            <select name="step_name" class="form-control" required>
              <?php populateDDsel("`feedback_steps_checklist`  
ORDER BY `feedback_steps_checklist`.`sort` ASC","step_name","step_name","") ?>
            </select>
          </div> 
            
            <div class="col-sm-3">
            <label>Call Status</label>
            <select name="call_status" class="form-control" required>
              <?php populateDDsel("status_list","status_name","status_name","") ?>
            </select>
          </div>
            <div class="col-sm-3">
            <label>Medicine Status</label>
            <select name="medicine_status" id="medicine_status" class="form-control" required>
              <?php populateDDdistinctSel("order_status","feedback_status","") ?>
            </select>
          </div>   
            
            <div class="col-sm-3">
            <label>Patient Feedback</label>
            <select name="patient_feedback" id="patient_feedback" class="form-control" required>
              <?php populateDDdistinctSel("reason","feedback_status","") ?>
            </select>
                  <script>
    const parentDropdown = document.getElementById("medicine_status");
    const childDropdown = document.getElementById("patient_feedback");

    parentDropdown.addEventListener("change", (event) => {
      const selectedCategory = event.target.value;

      // Clear existing options in the child dropdown
      childDropdown.innerHTML = "";

      // Populate child dropdown based on selected category
        <?php 
        $sql_parent="SELECT DISTINCT order_status FROM `feedback_status`";
                $query_parent=mysqli_query($con,$sql_parent);
                while($row_parent=mysqli_fetch_array($query_parent))
                {
        ?>
      if (selectedCategory === "<?php echo $row_parent[0]; ?>") {
        childDropdown.innerHTML = `
<option value=''>Select</option>
<?php
$sql_child="SELECT reason,description FROM `feedback_status` WHERE order_status='$row_parent[0]' order by reason";
                $query_child=mysqli_query($con,$sql_child);
                while($row_child=mysqli_fetch_array($query_child))
                {
                    echo    "<option title='$row_child[1]'>$row_child[0]</option>";
          
                }
?>
       
        `;
      } 
        <?php } ?>
    });
  </script>
          </div>
             <div class="col-sm-3">
            <label>Contact Type</label>
            <select name="call_type" class="form-control" required>
              <?php populateDDsel("call_type","call_type","call_type","") ?>
            </select>
          </div>  
            <div class="col-sm-3">
            <label>Duration (If Any)</label>
                <input type="text" value="00:00:00" name="duration" class="form-control" placeholder="Enter Duration In Minutes">
          </div>
               <div class="col-sm-12">
            <label>Feedback Comment</label>
            <textarea name="comment" required placeholder="Please Write Customer Comment"></textarea>
          </div>
          <div class="col-sm-6"> <br>
            <input type="submit" value="Submit" name="submit" class="btn-sm btn-primary">
          </div>
        </div>
        <div class="row">
          <?php include("fix_header.php"); ?>
              <th>Type</th>
                <th>Step/Status</th>
                <th>Comment</th>
                <th>Time</th>
                <th>Seller</th>
                <th>Feedback By</th>
                <th>Contact Type</th>
                <th>Duration</th>
                <th>Call Status</th>
                <th>Medicine Status</th>
                <th>Patient Feedback</th>
              </tr>
              </thead>
              
              <?php
              while ( $rowview = mysqli_fetch_array( $query_info ) ) {
                ?>
              <tr>
                <td><?php echo $rowview[0]; ?></td>
                <td><?php echo $rowview[1]; ?></td>
                <td><?php echo  $rowview[6]; ?></td>
                <td><?php echo change_datetime_ddmmyyyhis($rowview[2]); ?></td>
                <td><?php echo $rowview[3]; ?></td>
                <td><?php echo $rowview[4]; ?></td>
                <td><?php echo $rowview['call_type']; ?></td>
                <td><?php echo $rowview['duration']; ?></td>
                <td><?php echo $rowview['call_status']; ?></td>
                <td><?php echo $rowview['medicine_status']; ?></td>
                <td><?php echo $rowview['patient_feedback']; ?></td>
                
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
</body>
</html>