<?php
include( "start.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'date' ] ) ) {
  $date = $_REQUEST[ 'date' ];

  $end_date = $date;
} else {

  $end_date = $date;
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
} else {
  $start_date = date( "Y-m-d" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!--
<script>
		function sbmt(x)
		{
        var path="dashboard.php?date="+x;
            window.location.href=path;
		}
	</script>
    
-->
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<link href="css/style.css" rel="stylesheet"/>
<link href="css/styles.css" rel="stylesheet"/>
</head>

<body>
<div>
  <div id="layoutSidenav_content" class="content-wrapper">
  <main>
    <div class="container-fluid">
      <?php breadcrumb(); ?>
<!--
      <form>
        <div class="row">
          <div class="col-5"><strong>
            <label>Start Date</label>
            </strong>
            <input type="date" name="start_date" id="datepicker" value="<?php echo $start_date; ?>" class="form-control text-center">
          </div>
          <div class="col-5"> <strong>
            <label>End Date</label>
            </strong>
            <input type="date" name="date" id="datepicker" value="<?php echo $date; ?>" class="form-control text-center" >
          </div>
          <div class="col-2">
            <input type="submit" class="btn btn-primary" value="Filter">
          </div>
        </div>
      </form>

      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><?php echo(date('D d M Y', strtotime($start_date))." to ".date('D d M Y', strtotime($end_date))); ?>'s Insights</li>
      </ol>
-->      
      <!--
						<div class="col-xl-2 col-md-3">
							<div class="card bg-primary text-white mb-4">
								<div class="card-body">Total Allocation</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT COUNT(*)FROM `employee_shift_allocation` WHERE date='$date' "); ?>
									</h1>
									<a class="small text-white stretched-link" href="reports/daily_all_status.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>" target="new">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-3">
							<div class="card bg-success text-white mb-4">
								<div class="card-body">Total Present</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead WHERE employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND attendence.date BETWEEN '$date' AND '$date'"); ?>
									</h1>
									<a class="small text-white stretched-link" href="reports/daily_present.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>" target="new">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-3">
							<div class="card bg-warning text-white mb-4">
								<div class="card-body">Late Today</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT count(*)  FROM attendence,shift WHERE attendence.shift_name=shift.shift_name AND attendence.time>shift.start_time AND date BETWEEN '$date' AND '$date'  AND inOrOut='IN'"); ?>
									</h1>
									<a class="small text-white stretched-link" href="reports/daily_late.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>" target="new">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-3">
							<div class="card bg-danger text-white mb-4">
								<div class="card-body">Total Absent</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT count(*) FROM employee_shift_allocation e
LEFT JOIN attendence ON e.employee = attendence.emp_no

WHERE attendence.emp_no IS NULL AND e.date = '$date'  AND status='Allocated'"); ?>
									</h1>
									<a class="small text-white stretched-link" href="reports/daily_absent.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>" target="new">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-3">
							<div class="card bg-dark text-white mb-4">
								<div class="card-body">Visitors <?php echo showQuery("SELECT count(*) FROM `visitor` WHERE visit_date='$date' AND time_out='0000-00-00 00:00:00'"); ?> IN  <?php echo showQuery("SELECT count(*) FROM `visitor` WHERE time_out!='0000-00-00 00:00:00' AND date(time_out)='$date'"); ?> OUT </div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT COUNT(*) FROM `visitor` WHERE visit_date='$date'"); ?>
									</h1>
									<a class="small text-white stretched-link" target="new" href="reports/daily_visitor.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-2 col-md-3">
							<div class="card bg-info text-white mb-4">
								<div class="card-body">Vehicles <?php echo showQuery("SELECT count(*) FROM `vehicle` WHERE status='IN' AND date(created_at)='$date'"); ?> IN  <?php echo showQuery("SELECT count(*) FROM `vehicle` WHERE status='OUT' AND date(time_out)='$date'"); ?> OUT</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<h1>
										<?php echo showQuery("SELECT count(*) FROM vehicle v WHERE date(v.created_at)='$date'"); ?>
									</h1>
									<a class="small text-white stretched-link" target="new" href="reports/daily_vehicles.php?date_start=<?php echo $date; ?>&date_end=<?php echo $date; ?>">View Details</a>
									<div class="small text-white"><i class="fa  fa-angle-right"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
-->
      
      <center>
        <strong>Detailed Dashboard</strong>
      </center>
      <?php
      $field = array( 'province', 'district', 'tehsil', 'phone1network', 'phone2network', 'call_status', 'order_status', 'allocated_to', 'created_by', 'gender', 'referral', 'age', 'height', 'weight', 'marital_status', 'children', 'education', 'occupation', 'record_type','disease' );
      ?>
      <ul class="nav nav-tabs">
        <?php


        foreach ( $field as $rowcol ) {
          ?>
        <li  class="nav-link  <?php echo $_REQUEST['type']==$rowcol ? 'active bg-dark' : '' ?>"><a href="dashboard_details.php?type=<?php echo $rowcol; ?>"><?php echo strtoupper( str_replace("_", " ", $rowcol)); ?></a></li>
        <?php } ?>
      </ul>
      <?php
      foreach ( $field as $rowcol ) {
          if(isset($_REQUEST['type']))
      if ($rowcol==$_REQUEST['type']) {
                  ?>
        <?php include("fix_header.php"); ?>
     
        <tr>
          <th><?php echo strtoupper( str_replace("_", " ", $rowcol)); ?></th>
          <th>Count</th>
          <th>View</th>
        </tr>
        </thead>
        
        <tbody>
          <?php

          $sqlview = "SELECT $rowcol,COUNT(*) FROM `inquiry` GROUP BY $_REQUEST[type] order by count(*) desc";
          if($_REQUEST['type']=="disease")
          {
          $sqlview = "SELECT disease,count(*) FROM `inquiry_disease` WHERE inquiry_id IN (SELECT id FROM `inquiry` WHERE record_type='Inquiry')  GROUP BY disease  
ORDER BY `count(*)`  DESC";
          }
          $queryview = mysqli_query( $con, $sqlview );
//          echo $sqlview;
          while ( $rowview = mysqli_fetch_array( $queryview ) ) {
            ?>
          <tr>
            <td><?php echo $rowview[0]; ?></td>
            <td><?php echo $rowview[1]; ?></td>
            <td><a class="btn btn-primary text-white" target="new" href="view_inquiry.php?<?php echo "$rowcol=$rowview[0]&limit=20&record_type=Inquiry"; ?>">View</a></td>
          </tr>
          <?php } } } ?>
        </tbody>
      </table>
      <?php // } ?>
    </div>
    <!--
						<div class="col-lg-6">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="bg-light" colspan="3">
											<center><strong>Employees Shifts Status</strong>
											</center>
										</th>
									</tr>
									<tr>
										<th>No Of Employees</th>
										<th>Status</th>
										<th>Shift Name</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$sqlview = "SELECT COUNT(*),status,shift_name FROM `employee_shift_allocation` WHERE date='$date' GROUP BY status,shift_name";
									$queryview = mysqli_query( $con, $sqlview );
									while ( $rowview = mysqli_fetch_array( $queryview ) ) {
										?>
									<tr>
										<td>
											<?php echo $rowview[0]; ?>
										</td>
										<td>
											<?php echo $rowview[1]; ?>
										</td>
										<td>
											<?php echo $rowview[2]; ?>
										</td>


									</tr>

									<?php } ?>
								</tbody>
							</table>
						</div>
-->
    
    </div>
    <div class="row"> 
      <!--
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa  fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                           
--> 
      <!--
						<div class="col-xl-4">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fa  fa-chart-bar me-1"></i> Bar Chart
								</div>
								<div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas>
								</div>
							</div>
						</div>
					</div>
--> 
      
    </div>
  </main>
</div>
</div>
<br>
<br>
<br>
<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> 
<script src="js/scripts.js"></script> 
<script src="vendor/chart.js/Chart.min.js" crossorigin="anonymous"></script> 
<script src="demo/chart-area-demo.js"></script> 
<script src="demo/chart-bar-demo.js"></script> 
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