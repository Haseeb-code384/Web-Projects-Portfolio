<?php
include( "start.php" ); 
include( "allFunctions.php" );
$username=$_REQUEST['email'];
$yesterday = getDateWithOffset( -1 );
$tenDaysAgo = getDateWithOffset( -10 );
$elevenDaysAgo = getDateWithOffset( -11 );
$twentyDaysAgo = getDateWithOffset( -20 );
$twentyOneDaysAgo = getDateWithOffset( -21 );
$thirtyDaysAgo = getDateWithOffset( -30 );
$thirtyOneDaysAgo = getDateWithOffset( -31 );
$sixtyDaysAgo = getDateWithOffset( -60 );
$sixtyOneDaysAgo = getDateWithOffset( -61 );
$nintyDaysAgo = getDateWithOffset( -90 );
$nintyOneDaysAgo = getDateWithOffset( -91 );
$RedZone = getDateWithOffset( -9000 );

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


    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active"><?php echo(date('D d M Y', strtotime($start_date))." to ".date('D d M Y', strtotime($end_date))); ?>'s Insights</li>
    </ol>
-->
      <h1 align="center"><?php echo $username; ?></h1>
    <div class="row">
      <div class="col-xl-2 col-md-3">
        <div class="card bg-primary text-white mb-4">
          <div class="card-body">Total Allocations</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT count(id) FROM `inquiry` where allocated_to='$username'"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=record_type&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=20&seller=<?php echo $username; ?>" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>     
        <div class="col-xl-2 col-md-3">
        <div class="card bg-success text-white mb-4">
          <div class="card-body">Allocated Inquiries</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT count(id) FROM `inquiry` where allocated_to='$username' and record_type='Inquiry'"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=20&seller=<?php echo $username; ?>" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>    
        
        <div class="col-xl-2 col-md-3">
        <div class="card bg-warning text-white mb-4">
          <div class="card-body">Fresh Inquiries</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT count(id) FROM `inquiry` where allocated_to='$username' and record_type='Inquiry' AND date(allocated_at) BETWEEN '$start_date' AND '$end_date'"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date(allocated_at)&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=20&seller=<?php echo $username; ?>" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
               <div class="col-xl-2 col-md-3">
        <div class="card bg-danger text-white mb-4">
          <div class="card-body">Red Zone</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$username' AND record_type='Inquiry' AND date(allocated_at) BETWEEN '$RedZone' AND '$nintyOneDaysAgo'"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date%28allocated_at%29&&start_date=<?php echo $RedZone; ?>&end_date=<?php echo $nintyOneDaysAgo; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username ?>&tab=Red Zone" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
        
        <div class="col-xl-2 col-md-3">
        <div class="card bg-info text-white mb-4">
          <div class="card-body">Allocated Patients</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"> <?php echo showQuery("SELECT count(id) FROM `inquiry` where allocated_to='$username' and record_type='Patient'"); ?> </h3>
            <a class="small text-white stretched-link" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Patient&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=20&seller=<?php echo $username; ?>" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
        <div class="col-xl-2 col-md-3">
        <div class="card bg-success text-white mb-4">
          <div class="card-body">WhatsApp Contacts</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count1"><?php echo showQuery("SELECT COUNT(id) FROM `whatsapp_history` WHERE date(time) BETWEEN '$date' AND '$date' AND user='$username';"); ?></h3>
            <a class="small text-white stretched-link" href="#view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Patient&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=20&seller=<?php echo $username; ?>" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>
        
<!--
      <div class="col-xl-2 col-md-3">
        <div class="card bg-danger text-white mb-4">
          <div class="card-body">Unallocated</div>
          <div class="card-footer d-flex align-items-center justify-content-between">
            <h3 id="count2"><?php echo showQuery("SELECT count(*) FROM inquiry WHERE allocated_to='' GROUP BY allocated_to ORDER BY count(*) DESC"); ?></h3>
            <a class="small text-white stretched-link" href="view_user_inquiry_all_by_username.php?login_user=" target="new">View </a>
            <div class="small text-white"><i class="fa  fa-angle-right"></i> </div>
          </div>
        </div>
      </div>   
 
-->
     
    </div>
      <hr>
    <?php $login_user=$username; 
      include("view_tasks_tabs.php");
      ?>
      <hr>
    <div class="row">
      <div class="col-lg-6">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Network Wise Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Network</th>
              <th>Allocations</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT phone1network,count(*) FROM `inquiry`  WHERE record_type='Inquiry' and allocated_to='$username' GROUP BY phone1network;";
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo show_network_img($rowview[0]); ?></td>
              <td><?php echo $rowview[1]; ?> <a target="new" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=<?php echo $rowview[0]; ?>&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username; ?>"><i class="fa fa-eye"></i></a></td>
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
                  <strong>Disease Wise Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Disease</th>
              <th>Allocations</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT disease,count(*) FROM `inquiry_disease` WHERE inquiry_id IN (SELECT id FROM `inquiry` WHERE allocated_to='$username' AND record_type='Inquiry') group by disease";
//              echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?> <a target="new" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=call_status&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=<?php echo $rowview[0]; ?>&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username; ?>"><i class="fa fa-eye"></i></a></td>
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
                  <strong>Call Status Wise Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Status</th>
              <th>Allocations</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT call_status,count(*) FROM `inquiry` WHERE record_type='Inquiry' AND allocated_to='$username' GROUP BY call_status";
//              echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?> <a target="new" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=<?php echo $rowview[0]; ?>&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username; ?>"><i class="fa fa-eye"></i></a></td>
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
                  <strong>Whatsapp Contacts Today</strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Number</th>
              <th>Inquiry ID</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT number,inquiry_id,time FROM `whatsapp_history` WHERE date(time) BETWEEN '$date' AND '$date' AND user='$username';";
//              echo $sqlview;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><a href="whatsapp_handler.php?number=<?php echo $rowview[0]; ?>&inquiry_id=<?php echo $rowview[1]; ?>" onClick="return confirm('Onep Whatsapp Chat');" target="new"><?php echo $rowview[0]; ?></a></td>
              <td><a href="inquiry_details.php?id=<?php echo $rowview[1]; ?>" target="new"><?php echo $rowview[1]; ?></a></td>
              <td><?php echo $rowview[2]; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
        
  <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Today's Activities</strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>#</th>
              <th>Inquiry ID</th>
              <th>Status</th>
              <th>Comments</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sqlview = "SELECT inquiry_id,type,status,comments,time FROM `inquiry_status_history`  WHERE allocated_to='$username' AND date(time) BETWEEN '$date' AND '$date' AND type='Call' order by id desc";
//              echo $sqlview;
              $i=1;
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><a href="inquiry_details.php?id=<?php echo $rowview[0]; ?>" target="new"><?php echo $rowview[0]; ?></a></td>
              <td><?php echo $rowview[1]; ?> 
              <td><?php echo $rowview['comments']; ?> 
              <td><?php echo $rowview['time']; ?> (<?php echo ($rowview['time']!='') ? timeAgo($rowview['time']) : '';?>)
<!--
                  <a target="new" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=<?php echo $rowview[0]; ?>&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username; ?>"><i class="fa fa-eye"></i></a>
                
-->
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

  <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Today's System Activities
                  <br>Start Time
                      <b><?php echo showQuery("SELECT min(timestamp) FROM `user_activity` WHERE user_name='$username' AND date(timestamp) BETWEEN '$date' AND '$date'") ?></b>
                           <br> End Time
             
                      <b><?php echo showQuery("SELECT max(timestamp) FROM `user_activity` WHERE user_name='$username' AND date(timestamp) BETWEEN '$date' AND '$date'"); ?></b>
                      <br>
                      <b><?php 
                          
            $sqlview = "SELECT * FROM `user_activity` WHERE user_name='$username' AND date(timestamp) BETWEEN '$date' AND '$date'  
ORDER BY `user_activity`.`id` DESC";
//              echo $sqlview;
              $i=1;
            $queryview = mysqli_query( $con, $sqlview );
                          
                          echo mysqli_num_rows($queryview); ?> Entries</b>
                  </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>#</th>
              <th width="300">Time</th>
              <th>IP</th>
                
              <th width="100">Visited Page</th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td style="width: 300px;"><?php echo $rowview['timestamp']; ?> (<?php echo ($rowview['timestamp']!='') ? timeAgo($rowview['timestamp']) : '';?>) </td>
              <td><?php echo $rowview['ip']; ?> </td>
                
                <td><a target="new" href="<?php echo $rowview['page']; ?>" title="<?php echo $rowview['page']; ?>">Open</a></td> 
<!--
                  <a target="new" href="view_inquiry.php?date_type=date_type&start_date=<?php echo $date; ?>&end_date=<?php echo $date; ?>&order_status=order_status&call_status=<?php echo $rowview[0]; ?>&gender=gender&phone1network=phone1network&phone2network=phone2network&disease=disease&source=source&record_type=Inquiry&age=age&committed_amount=committed_amount&province=province&district=district&tehsil=tehsil&limit=50&seller=<?php echo $username; ?>"><i class="fa fa-eye"></i></a>
                
-->
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      </div>
    
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