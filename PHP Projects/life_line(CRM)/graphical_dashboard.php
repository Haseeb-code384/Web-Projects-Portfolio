<?php
include( "start.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
	$date=$_REQUEST['date'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <script src="chart.js"></script>

	<script>
		function sbmt()
		{
			document.getElementById("frm").submit;
		}
	</script>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="description" content=""/>
	<meta name="author" content=""/>
	<link href="css/style.css" rel="stylesheet"/>
	<link href="css/styles.css" rel="stylesheet"/>>
</head>

<body>
	<div>
		<div id="layoutSidenav_content" class="content-wrapper">
			<main>
				<div class="container-fluid">
                    
                    <?php include("dashboard_tabs.php"); ?>
                    <?php include("graphical_db_tabs.php"); ?>
                    
					<h1 class="mt-4">Graphical Dashboard(Daily)</h1>
					<form id="frm">
						<div class="col-sm-6">
					<input type="date" name="date" value="<?php echo $date; ?>" class="form-control col-sm-6" onChange="sbmt();">
						<input  type="submit" name="submit" value="Filter" class="col-sm-2 btn btn-primary">
					
						</div>
					</form>
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item active"><?php echo(date('D d M Y', strtotime($date))); ?>'s Insights</li>
					</ol>
			



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
                           

						<div class="col-xl-3">
							<div class="card mb-4 ">
								<div class="card-header">
									<i class="fa  fa-chart-bar me-1"></i> All Enrolled Employees
								</div>
								<div class="card-body">
                                    <?php include_once("pie_all_employees.php"); ?>
								</div>
							</div>
						</div>
                        
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Present Employees <strong><?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead WHERE employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND attendence.date BETWEEN '$date' AND '$date'"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_all_present.php"); ?>
								</div>
							</div>
						</div>   
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Absent Employees <strong><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation e LEFT JOIN attendence ON e.employee = attendence.emp_no AND e.date=attendence.date WHERE e.date between '$date' AND '$date' AND  gate is null AND status='Allocated'  AND e.employee IN(SELECT id FROM employee) ORDER BY (select branch from employee where employee.id = e.employee ) "); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_all_absent.php"); ?>
								</div>
							</div>
						</div>    
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Allocation <strong><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation e LEFT JOIN attendence ON e.employee = attendence.emp_no AND e.date=attendence.date  WHERE e.date between '$date' AND '$date' AND (inOrOut='IN' OR inOrOut is null)  AND e.employee IN(SELECT id FROM employee) ORDER BY (select branch from employee where employee.id = e.employee )"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_all_allocation.php"); ?>
								</div>
							</div>
						</div>
                        
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">   OUT 
										<strong><?php echo showQuery("SELECT count(*) FROM `employee_shift_allocation` WHERE date BETWEEN '$date' AND '$date' AND employee IN (select id from employee) AND status!='Allocated'  ORDER BY (select branch from employee where employee.id = employee_shift_allocation.employee )"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_all_out.php"); ?>
								</div>
							</div>
						</div>
                        
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Visitors IN <strong><?php echo showQuery("SELECT count(*) FROM `visitor` WHERE visit_date='$date' AND time_out='0000-00-00 00:00:00'"); ?></strong> 
								</div>
								<div class="card-body">
                                    <?php include("pie_visitors_in.php"); ?>
								</div>
							</div>
						</div>
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Visitors OUT <strong><?php echo showQuery("SELECT count(*) FROM `visitor` WHERE time_out!='0000-00-00 00:00:00' AND date(time_out)='$date'"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_visitors_out.php"); ?>
								</div>
							</div>
						</div>  
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Vehicle IN <strong><?php echo showQuery("SELECT count(*) FROM `vehicle` WHERE status='IN' AND date(created_at)='$date'"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_vehicles_in.php"); ?>
								</div>
							</div>
						</div>
                        
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Vehicle OUT <strong><?php echo showQuery("SELECT count(*) FROM `vehicle` WHERE status='OUT' AND date(time_out)='$date'"); ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_vehicles_out.php"); ?>
								</div>
							</div>
						</div>
                        
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">  Gates Status IN <strong><?php echo showQuery("SELECT COUNT(*) AS val,employee.gate AS label FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id  AND inorout='IN' AND attendence.date BETWEEN '$date' AND '$date' ") ?></strong>
								</div>
								<div class="card-body">
                                    <?php include("pie_gates_in.php"); ?>
								</div>
							</div>
						</div>
                        <div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fa  fa-chart-bar me-1"></i> Gates Status OUT <strong><?php echo showQuery("SELECT COUNT(*) AS val,employee.gate AS label FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id  AND inorout='out' AND attendence.date BETWEEN '$date' AND '$date' "); ?></strong>   
								</div>
								<div class="card-body">
                                    <?php include("pie_gates_out.php"); ?>
								</div>
							</div>
						</div>
                        
					</div>


				</div>
			</main>
		</div>
	</div>
	<br>
	<br>
	<br>
	
</body>
</html>