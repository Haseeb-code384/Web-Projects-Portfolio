<?php
include( "config.php" );
include( "allFunctions.php" );
$sql_info = "SELECT * FROM `disease_category`";
$query_info = mysqli_query( $con, $sql_info );
if ( isset( $_REQUEST[ 'disease' ] ) ) {
  $disease = ucwords( $_REQUEST[ 'disease' ] );
  executeQuery( "INSERT INTO `disease_category` (`disease_category`) VALUES ('$disease')");
}
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $cat = $_REQUEST[ 'cat' ];
  $status_name = $_REQUEST[ 'status_name' ];
  $color = $_REQUEST[ 'color' ];

  for ( $i = 0; $i < count( $status_name ); $i++ ) {
    $sql = "UPDATE `disease_category` SET `color` = '$color[$i]',`category`= '$cat[$i]' WHERE `disease_category`.`disease_category` = '$status_name[$i]';";
    $query = mysqli_query( $con, $sql );
  }


  alertredirect( "Saved Successfully", "edit_disease_category.php" );

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
          <div class="col-sm-12">
            <label>New Disease Category Name</label>
            <input class="form-control" placeholder="Enter New Disease Category Name" type="text" name="disease">
          </div>
          <div class="col-sm-6"> <br>
            <input type="submit" value="Submit" name="submit" class="btn-sm btn-primary">
          </div>
        </div>
        <div class="row">
          <?php include("fix_header.php"); ?>
              <th>Disease Category Name</th>
                <th>Department</th>
                <th>Used Times</th>
                <th>Delete</th>
              </tr>
              </thead>
              
              <?php
              while ( $row_info = mysqli_fetch_array( $query_info ) ) {
                ?>
              <tr>
                <td><input type="hidden" value="<?php echo $row_info[0]; ?>" name="status_name[]">
                  <?php echo $row_info[0]; ?></td>
        <td><?php echo $row_info['parent']; ?>          
        </td>
               
                <td><?php
                $times = showQuery( "SELECT COUNT(*) FROM `disease` WHERE category='$row_info[0]'" );
                echo $times;
                ?></td>
                <td><?php
                if ( $times <= 0 ) {
                  ?>
                  <a onClick="return confirm('Do You Really Want To Delete <?php echo $row_info[0]; ?> ?')" href="del.php?basic_disease_cat=<?php echo $row_info[0]; ?>"><i class="fa fa-trash text-danger"></i></a>
                  <?php } ?></td>
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