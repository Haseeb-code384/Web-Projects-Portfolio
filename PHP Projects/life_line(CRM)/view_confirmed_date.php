<?php
include( "config.php" );
include( "allFunctions.php" );
$start_date=$date;
$end_date=$date;
$seller_sql="";
if(isset($_REQUEST['start_date']))
{
	$start_date=$_REQUEST['start_date'];
}
if(isset($_REQUEST['start_date']))
{
	$end_date=$_REQUEST['end_date'];
}
if(isset($_REQUEST['seller']))
{
    if($_REQUEST['seller']!="")
{
$seller = $_REQUEST['seller'];
      $seller_sql="AND i.allocated_to='$seller'";
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
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
      <form>
          <div class="col-sm-12">
          
             <div class="row">
               <div class="col-sm-3">
                   <label>Start Date</label>
                   
          <input type="date" class="form-control" name="start_date" value="<?php echo $start_date ?>">
               </div>   
                 <div class="col-sm-3">
                   <label>End Date</label>
                   
          <input type="date" class="form-control" name="end_date"  value="<?php echo $end_date ?>">
               </div>
          
                 <div class="col-sm-3">
                     <?php 
    include("admin_selective_user_dropdown.php"); ?>
          </div>    
                 <div class="col-sm-3">
                     <br>
          <input type="submit" class="btn btn-sm btn-primary"></div>
              </div>
          </div>
      </form>
    <?php
    include( "fix_header.php" );
    $sqlview = "SELECT
    i.*,
    GROUP_CONCAT(id.disease ORDER BY id.disease ASC) AS diseases,
    GROUP_CONCAT(d.color ORDER BY id.disease ASC) AS diseases_color,
    h.time AS order_time
FROM
    inquiry AS i
LEFT JOIN
    inquiry_disease AS id ON i.id = id.inquiry_id
LEFT JOIN
    disease AS d ON id.disease = d.disease
LEFT JOIN
    inquiry_status_history AS h ON i.id = h.inquiry_id
WHERE
    i.order_status = 'Agreed To Order'
    AND h.status = 'Agreed to order'
    AND date(h.time) BETWEEN '$start_date' AND '$end_date' $seller_sql
GROUP BY
    i.id;";
  //    echo $sqlview;
//    $sqlview = "SELECT *
//        ,(SELECT GROUP_CONCAT(disease ORDER BY disease ASC)  FROM  inquiry_disease WHERE inquiry_disease.inquiry_id=inquiry.id GROUP BY inquiry_id) AS diseases
//        ,(SELECT (SELECT color FROM disease WHERE disease.disease=inquiry_disease.disease)   FROM  inquiry_disease WHERE inquiry_disease.inquiry_id=inquiry.id GROUP BY inquiry_id) AS diseases_color
//        ,(SELECT time FROM `inquiry_status_history`  WHERE status='Agreed to order' AND inquiry_status_history.inquiry_id=inquiry.id ORDER BY time DESC LIMIT 1) AS order_time FROM `inquiry` WHERE order_status='Agreed To Order'";
    $queryview = mysqli_query( $con, $sqlview );
    include( "confirmed_table.php" );
    ?>
  </div>
</div>
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