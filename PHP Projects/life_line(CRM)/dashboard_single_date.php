<?php
include( "start.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'date' ] ) ) {
  $date = $_REQUEST[ 'date' ];
}
$end_date = $date;
$start_date = $date;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
		function sbmt(x)
		{
        var path="dashboard.php?date="+x;
            window.location.href=path;
		}
	</script>
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
    <div class="col-sm-6">
      <input type="date" name="date" id="datepicker" value="<?php echo $date; ?>" class="form-control col-sm-6" onChange="sbmt(this.value);">
    </div>
    <script>document.addEventListener("DOMContentLoaded", () => {
 function counter(id, start, end, duration) {
  let obj = document.getElementById(id),
   current = start,
   range = end - start,
   increment = end > start ? 1 : -1,
   step = Math.abs(Math.floor(duration / range)),
   timer = setInterval(() => {
    current += increment;
    obj.textContent = current;
    if (current == end) {
     clearInterval(timer);
    }
   }, step);
 }
 counter("count1", 5000, <?php echo showQuery("SELECT count(id) FROM `inquiry`"); ?>, 5);
 counter("count2", 1000, <?php echo showQuery("SELECT count(*) FROM inquiry WHERE allocated_to='' GROUP BY allocated_to ORDER BY count(*) DESC"); ?>, 5);
});
</script>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active"><?php echo(date('D d M Y', strtotime($date))); ?>'s Insights</li>
    </ol>
    <div class="row">
      <div class="col-xl-2 col-md-3">
        <div class="card bg-primary text-white mb-4">
          <div class="card-body">Total Inquiries</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h1 id="count1"> 0 </h1>
            <a class="small text-white stretched-link" href="view_inquiry.php" target="new">View Details</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-md-3">
        <div class="card bg-danger text-white mb-4">
          <div class="card-body">Unallocated</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h1 id="count2"> 0 </h1>
            <a class="small text-white stretched-link" href="view_user_inquiry_all_by_username.php?login_user=" target="new">View Details</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
    </div>
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
      <strong>Total Users & Allocations</strong>
    </center>
    <div class="row">
      <?php include("fix_header.php"); ?>
            <tr>
              <th>Username</th>
              <th>Allocations</th>
              <th>Inquries Added</th>
              <th>Inquries Added Today</th>
              <th>Calls</th>
              <th>Orders</th>
              <th>Today Calls</th>
              <th>Today Orders</th>
              <th>Last Activity</th>
            </tr>
          </thead>
          <tbody>
            <?php


            $sqlview = "SELECT allocated_to,count(*) FROM inquiry WHERE allocated_to!='' GROUP BY allocated_to ORDER BY count(*) DESC";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr class="text-center" >
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"><?php echo $rowview[0]; ?></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"><?php echo $rowview[1];?><a class="fa fa-eye float-right" href="view_user_inquiry_all_by_username.php?login_user=<?php echo $rowview[0]; ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"><?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE created_by='$rowview[0]'"); ?><a class="fa fa-eye float-right" href="view_user_inquiry_date_created.php?login_user=<?php echo $rowview[0]; ?>&start_date=2022-01-01&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"><?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE created_by='$rowview[0]' AND date(created_at)='$date'"); ?> <a class="fa fa-eye float-right" href="view_user_inquiry_date_created.php?login_user=<?php echo $rowview[0]; ?>&start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');" title="<?php 
                                                   $query_calldetail=mysqli_query($con,"SELECT status,count(*) FROM `inquiry_status_history` WHERE type='call' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]') GROUP BY status");
                                        while($row_call_detail=mysqli_fetch_array($query_calldetail))
                                        {
                                            echo $row_call_detail[0]." ".$row_call_detail[1]." &#013";
                                        }
                                                   
                                                   ?>"><?php echo showQuery("SELECT distinct count(*) FROM `inquiry_status_history` WHERE type='call' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]')"); ?> <a class="fa fa-eye float-right" href="view_user_inquiry_date_calls_done.php?login_user=<?php echo $rowview[0]; ?>&start_date=<?php echo "2022-01-01" ?>&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');" title="<?php 
                                                   $query_calldetail=mysqli_query($con,"SELECT status,count(*) FROM `inquiry_status_history` WHERE type='order' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]') GROUP BY status");
                                        while($row_call_detail=mysqli_fetch_array($query_calldetail))
                                        {
                                            echo $row_call_detail[0]." ".$row_call_detail[1]." &#013";
                                        }
                                                   
                                                   ?>"><?php echo showQuery("SELECT count(*) FROM `inquiry_status_history` WHERE type='order' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]')"); ?> <a class="fa fa-eye float-right" href="view_user_inquiry_date_orders_done.php?login_user=<?php echo $rowview[0]; ?>&start_date=<?php echo "2022-01-01" ?>&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');" title="<?php 
                                                   $query_calldetail=mysqli_query($con,"SELECT status,count(*) FROM `inquiry_status_history` WHERE type='call' AND date(time)='$date' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]') GROUP BY status");
                                        while($row_call_detail=mysqli_fetch_array($query_calldetail))
                                        {
                                            echo $row_call_detail[0]." ".$row_call_detail[1]." &#013";
                                        }
                                                   
                                                   ?>"><?php echo showQuery("SELECT count(*) FROM `inquiry_status_history` WHERE type='call'  AND date(time)='$date' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]')"); ?> <a class="fa fa-eye float-right" href="view_user_inquiry_date_calls_done.php?login_user=<?php echo $rowview[0]; ?>&start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');" title="<?php 
                                                   $query_calldetail=mysqli_query($con,"SELECT status,count(*) FROM `inquiry_status_history` WHERE type='order' AND date(time)='$date' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]') GROUP BY status");
                                        while($row_call_detail=mysqli_fetch_array($query_calldetail))
                                        {
                                            echo $row_call_detail[0]." ".$row_call_detail[1]." &#013";
                                        }
                                                   
                                                   ?>"><?php echo showQuery("SELECT count(*) FROM `inquiry_status_history` WHERE type='order' AND date(time)='$date' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$rowview[0]')"); ?><a class="fa fa-eye float-right" href="view_user_inquiry_date_orders_done.php?login_user=<?php echo $rowview[0]; ?>&start_date=<?php echo $start_date ?>&end_date=<?php echo $end_date ?>" target="new"></a></td>
              <td onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"><strong><?php echo showQuery("SELECT max(last_updated_at) FROM `inquiry` WHERE allocated_to='$rowview[0]'"); ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Total Users & Today's Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Username</th>
              <th>Allocations</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT allocated_to,count(*) FROM inquiry WHERE allocated_to='' AND date(allocated_at)='$date' GROUP BY allocated_to ORDER BY count(*) DESC";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr class="bg-danger">
              <td> Unallocated </td>
              <td><?php echo $rowview[1];    ?></td>
            </tr>
            <?php
            }
            $sqlview = "SELECT allocated_to,count(*) FROM inquiry WHERE allocated_to!='' AND date(allocated_at)='$date' GROUP BY allocated_to ORDER BY count(*) DESC";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1];    ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
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