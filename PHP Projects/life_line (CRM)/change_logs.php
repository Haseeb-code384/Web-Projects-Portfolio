<?php

include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $subject = $_REQUEST[ 'subject' ];
  $description = $_REQUEST[ 'description' ];
  $priority = $_REQUEST[ 'priority' ];


  $sql = "INSERT INTO `change_log` (`id`, `subject`, `description`, `priority`, `status`, `developer_comments`, `closing_comments`, `created_at`, `updated_at`) VALUES (NULL, '$subject', '$description', '$priority', 'Pending', NULL, NULL, '$currentDateTime', '0000-00-00 00:00:00.000000')";
  $query = mysqli_query( $con, $sql );

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
    <form method="post">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-3 text-center bg-info h3"> Total <br>
            <?php echo showQuery("SELECT count(*) FROM `change_log`");  ?> </div>
          <div class="col-3 text-center bg-danger h3"> Pending <br>
            <?php echo showQuery("SELECT count(*) FROM `change_log` WHERE status='Pending'");  ?> </div>
            <div class="col-3 text-center bg-warning h3"> In Progress <br>
            <?php echo showQuery("SELECT count(*) FROM `change_log` WHERE status='In Progress'");  ?> </div>
          <div class="col-3 text-center bg-success h3"> Done <br>
            <?php echo showQuery("SELECT count(*) FROM `change_log` WHERE status='Done'");  ?> </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label class="text-danger"><strong>Subject:</strong></label>
            <input class="form-control input-lg" placeholder="Enter Change Subject" type="text" name="subject" required>
          </div>
          <div class="col-6">
            <label class="text-danger"><strong>Priority:</strong></label>
            <select name="priority" required class="form-select">
              <option value="">Select Priority</option>
              <option>Low</option>
              <option>Normal</option>
              <option>High</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-10">
            <label class="text-danger"><strong>Description:</strong></label>
            <textarea  name="description" required placeholder="Description"  class="form-control input-lg" ></textarea>
          </div>
          <div class="col-2">
            <label class=""><strong></strong></label>
            <input type="submit" name="submit" style="margin-top: 8px;" class="btn-sm btn-primary col-12">
          </div>
        </div>
      </div>
      </div>
    </form>
    <div class="col-lg-12">
      <table border="1" class="table table-sm table-hover table-bordered table-striped">
       
        <?php
        if ( isset( $_REQUEST[ 'cat' ] ) ) {
          $cat = $_REQUEST[ 'cat' ];
          $sqlview = "SELECT * FROM `change_log` ORDER BY id DESC";
        } else {

          $sqlview = "SELECT * FROM `change_log` ORDER BY id DESC";
        }

        $queryview = mysqli_query( $con, $sqlview );
        while ( $rowview = mysqli_fetch_array( $queryview ) ) {
          ?>
           <tr>
          <th>Id</th>
          <th>Subject</th>
          <th>Description</th>
          <th>Priority</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Status</th>
        </tr>
        <tr border="1" onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
          <td><?php echo $rowview[0]; ?></td>
          <td><?php echo $rowview[1]; ?></td>
          <td><?php echo $rowview[2]; ?></td>
          <td><?php echo $rowview[3]; ?></td>
          <td><?php echo $rowview[7]; ?></td>
          <td><?php echo $rowview[8]; ?></td>
          <td rowspan="3" valign="middle" class="<?php if($rowview[4]=="Pending") { echo "bg-danger"; }if($rowview[4]=="In Progress") { echo "bg-warning"; }  if($rowview[4]=="Done") { echo "bg-success"; } ?>"><?php echo $rowview[4]; ?> <br>
            <button title="Double Click To Delete " onDblClick="window.location.href='del.php?change_log_id=<?php echo $rowview[0] ?>'" class="btn btn-danger btn-sm">Delete</button>
            <br>
            <a href="change_logs_edit.php?id=<?php echo $rowview[0] ?>" class="btn btn-success btn-sm">Edit</a></td>
        </tr>
        <tr>
          <th colspan="3">Developer Comments</th>
          <th colspan="3">Closing Comments</th>
        </tr>
        <tr class="bg-info">
          <td colspan="3"><?php echo $rowview[5]; ?></td>
          <td colspan="3"><?php echo $rowview[6]; ?></td>
        </tr>
        <?php } ?>
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