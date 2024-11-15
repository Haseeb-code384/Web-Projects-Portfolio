<?php
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
$sql = "SELECT * FROM `order_dispatch_info` WHERE order_id='$id'";

mysqli_set_charset($con, "utf8mb4");
$queryview = mysqli_query( $con, $sql );
$rowview = mysqli_fetch_array( $queryview );

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" /><meta name="referrer" content="no-referrer" /><meta name="robots" content="noindex,nofollow" /><meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
  <div class="border col-lg-12 text-center"> </div>
  <?php breadcrumb(); ?>
  <div class="row" style="">
  <h1 align="center">Order Checklist</h1>
  <body>
  <div class="table-responsive">



    <input type="hidden" name="id" value="<?php echo $rowview[0]; ?>">
    <input type="hidden" name="old_status" value="<?php echo $rowview['status']; ?>">
   <center>
       <table  class="table-bordered table-hover" width="60%">
      <thead>
        <tr align="center" bgcolor="#48BDD5">
         <th>Status</th>
          <th>Checkbox</th>
          <th>Time</th>
        
        </tr>
      </thead>
     
          <?php  $sql_checklist="SELECT * FROM `order_steps_checklist` ORDER BY `sort` ASC"; 
            $query_checklist=mysqli_query($con,$sql_checklist);
           $i=0;
          while($row_checklist=mysqli_fetch_array($query_checklist))
          {
              $arr=return_resultarray("SELECT * FROM `order_steps_checklist_data` WHERE order_id='$id' AND status_name='$row_checklist[0]'");
    if($arr!="")
    {
           ?>
           
          <tr>
          <th><?php echo $row_checklist[0]; ?></th>
          <th align="center">
              <i class="fa fa-2x fa-check-square-o text-primary"></i>
              </th>
              <th><?php echo $arr['time'] ?></th>
              
          </tr>
          <?php  } 
          
           else
          {
              ?>
             <tr>
          <th><?php echo $row_checklist[0]; ?></th>
          <th align="center">
              <i onClick="window.open('process_order_checklist.php?<?php echo "order_id=$id&user=$_SESSION[email]&status_name=$row_checklist[0]" ?>', 'Update List', 'width=1,height=1'); this.classList.remove('fa-square-o');this.classList.add('fa-check-square-o'); document.getElementById('box<?php echo $i; ?>').innerHTML='<?php echo $currentDateTime; ?>'" class="fa fa-2x fa-square-o text-primary"></i>
              </th>
                <th id="box<?php echo $i; $i++;  ?>">
<!--              <a href="https://api.whatsapp.com/send/?phone=923006029757&text=<?php echo $urdu; ?>&type=phone_number&app_absent=0" target="new">ok</a> -->
                </th>
          </tr>
           <?php 
          } }
           ?>  
       
       
    </table>
      </center>
<!--
      <table>
      
      </table>
-->
      
    </div>

    </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>