<?php
include( "start.php" ); 
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'date' ] ) ) {
  $date = $_REQUEST[ 'date' ];
    
$end_date = $date;
}
else
{
$end_date = $date;
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];    
}
else
{
$start_date = date("Y-m-d");
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
 
 
        <form>
        <div class="row">
            <div class="col-5"><strong>
                <label>Start Date</label></strong>
               <input type="date" name="start_date" id="datepicker" value="<?php echo $start_date; ?>" class="form-control text-center">
            </div>  
            <div class="col-5">
                <strong>
                <label>End Date</label></strong>
      <input type="date" name="date" id="datepicker" value="<?php echo $date; ?>" class="form-control text-center" >
            </div>
            <div class="col-2">
            
      <input type="submit" class="btn btn-primary" value="Filter">
            </div>
        </div>
        </form>
            <button onClick="window.open('distribute_inquiry_wizard_select_users.php');" class="btn btn-danger">Distribute Inquiries</button>
            <button onClick="window.open('dashboard_details.php');" class="btn btn-success">Detailed Dashboard</button>

    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active"><?php echo(date('D d M Y', strtotime($start_date))." to ".date('D d M Y', strtotime($end_date))); ?>'s Insights</li>
    </ol>
    <div class="row">
      <div class="col-xl-2 col-md-3">
        <div class="card bg-primary text-white mb-4">
          <div class="card-body">Total Inquiries</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT count(id) FROM `inquiry`"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-md-3">
        <div class="card bg-danger text-white mb-4">
          <div class="card-body">Unallocated</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"> <?php echo showQuery("SELECT count(*) FROM inquiry WHERE allocated_to='' GROUP BY allocated_to ORDER BY count(*) DESC"); ?> </h3>
            <a class="small text-white stretched-link" href="view_user_inquiry_all_by_username.php?login_user=" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>   
        <div class="col-xl-2 col-md-3">
        <div class="card bg-success text-white mb-4" title="Newly Added Unallocated Inquiries">
          <div class="card-body">Today's Record Date</div>
         
              <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"> <?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE record_date BETWEEN '$start_date' AND '$end_date' and allocated_to!='' and record_type='Inquiry' "); ?> </h3>
            <a class="small text-white stretched-link" href="<?php echo "view_inquiry.php?sql=SELECT *,(SELECT user FROM `feedback_user_orders_allocation` WHERE inquiry_id=id) as 'feedback_consultant' FROM `inquiry`  WHERE record_date BETWEEN '$start_date' AND '$end_date' and allocated_to!='' and record_type='Inquiry' "; ?>&limit=0" target="new">View Allocated</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"> <?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE record_date BETWEEN '$start_date' AND '$end_date'  and allocated_to='' and record_type='Inquiry' "); ?> </h3>
            <a class="small text-white stretched-link" href="<?php echo "view_inquiry.php?sql=SELECT *,(SELECT user FROM `feedback_user_orders_allocation` WHERE inquiry_id=id) as 'feedback_consultant' FROM `inquiry` WHERE record_date BETWEEN '$start_date' AND '$end_date'  and allocated_to='' and record_type='Inquiry' "; ?>&limit=0" target="new">View Unallocated</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
             <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"> <?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE record_date BETWEEN '$start_date' AND '$end_date' and record_type='Inquiry' "); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=record_date&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=" target="new">View All</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>     
     
        <div class="col-xl-2 col-md-3">
        <div class="card bg-warning text-white mb-4" title="Newly Added Unallocated Inquiries">
          <div class="card-body">Inquiries Created Today</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"><span title="Unallocated"> <?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE date(created_at) BETWEEN '$start_date' AND '$end_date' and record_type='Inquiry' AND allocated_to='' "); ?></span></h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date(created_at)&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=" target="new">View Unallocated</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"><span title="Unallocated"><span title="Allocated"> <?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE date(created_at) BETWEEN '$start_date' AND '$end_date' and record_type='Inquiry' AND allocated_to!='' "); ?></span></h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date(created_at)&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=" target="new">View Allocated</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"><?php echo showQuery("SELECT count(*) FROM `inquiry`  WHERE date(created_at) BETWEEN '$start_date' AND '$end_date' and record_type='Inquiry' "); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date(created_at)&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=" target="new">View Created</a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
    </div>
    
    <center>
      <strong>Total Users & Allocations</strong>
    </center>
    <div class="row">
      <?php include("fix_header.php"); ?>
            <tr>
              <th>Username</th>
              <th>Total Allocations</th>
              <th>Total Inquries Added</th>
              <th>Inquries Added Today</th>
              <th>Today Fresh Allocations</th>
              <th>Today All Allocations</th>
              <th>Today Touched Inquiries</th>
              <th>Last Activity</th>
              <th>User Activity</th>
            </tr>
          </thead>
          <tbody>
            <?php


            $sqlview = "SELECT allocated_to as 'usr',count(*),(SELECT count(created_by) FROM inquiry WHERE created_by=usr),(SELECT count(created_by) FROM inquiry WHERE created_by=usr AND date(created_at) BETWEEN '$start_date' AND '$end_date'),(SELECT max(timestamp) FROM `user_activity` WHERE user_name=usr),(SELECT count(*) FROM `inquiry` WHERE date(recall_date) BETWEEN '$start_date' AND '$end_date' AND allocated_to=usr),(SELECT count(*) FROM `inquiry` WHERE date(allocated_at) BETWEEN '$start_date' AND '$end_date' AND allocated_to=usr),(SELECT COUNT(DISTINCT inquiry_id) FROM `inquiry_status_history`  WHERE date(time)  BETWEEN '$start_date' AND '$end_date' AND allocated_to=usr AND type='Call') FROM inquiry WHERE allocated_to!='' GROUP BY allocated_to";
//              echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr  onClick="chnage_row_clr(this,'lightgreen');" class="text-center" >
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[2]; ?></td>
              <td><?php echo $rowview[3]; ?></td>
              <td><?php echo $rowview[5]; ?></td>
              <td><?php echo $rowview[6]; ?></td>
              <td><?php echo $rowview[7]; ?></td>
              <td title="<?php echo $rowview[4]; ?>"><?php echo ($rowview[4]!='') ? timeAgo($rowview[4]) : '';?></td>
                <td><a href="user_activity_dashboard.php?email=<?php echo $rowview[0]; ?>" target="new"><i class="fa fa-eye" title=" View Details"></i></a></td>
              
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
              <th class="bg-light" colspan="7"> <center>
                  <strong>Total Users & Today's Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Username</th>
              <th>Allocations</th>
              <th>Today Impressions</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT allocated_to,count(*) FROM inquiry WHERE allocated_to='' AND date(allocated_at) between'$start_date' AND '$end_date' GROUP BY allocated_to ORDER BY count(*) DESC";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr class="bg-danger">
              <td> Unallocated </td>
              <td><?php echo $rowview[1];    ?></td>
                <td></td>
            </tr>
            <?php
            }
            $sqlview = "SELECT allocated_to,count(*) FROM inquiry WHERE allocated_to!='' AND date(allocated_at) between'$start_date' AND '$end_date' GROUP BY allocated_to ORDER BY count(*) DESC";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[2]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    
-->
<!--
    
        <div class="col-lg-6">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Total Users & Fresh Inquiries </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Username</th>
              <th>Date</th>
              <th>Allocations</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT allocated_to,date(allocated_at),count(*) FROM `inquiry`  WHERE allocated_to='' AND record_date BETWEEN '$start_date' AND '$end_date' GROUP BY allocated_to,date(allocated_at)  
ORDER BY `inquiry`.`allocated_to` ASC;";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr class="bg-danger">
              <td> Unallocated </td>
              <td><?php echo $rowview[1];    ?></td>
              <td><?php echo $rowview[2];    ?></td>
            </tr>
            <?php
            }
            $sqlview = "SELECT allocated_to,date(allocated_at),count(*) FROM `inquiry`  WHERE  allocated_to!=''  AND record_date BETWEEN '$start_date' AND '$end_date' GROUP BY allocated_to,date(allocated_at)  
ORDER BY `inquiry`.`allocated_to` ASC;";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[2]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      
-->
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