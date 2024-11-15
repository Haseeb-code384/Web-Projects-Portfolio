<?php
include("config.php");
include("allFunctions.php");
$date_start=$_REQUEST['date_start'];
$date_start=$_REQUEST['date_end'];

?>
<!doctype html>
<html>
	<style>
		table
		{
			width: 100%;
		}
		p
		{
			margin-bottom: 0px;
			font-weight: bold;
		}
	</style>
<head>
	<meta charset="utf-8">
	<title><?php echo $project_name; ?></title>
</head>

<body>
	<div>
		<h3 align="center"><u>DAILY PRADE STATE (CIV PERS) - DATE <?php echo(date('d M Y', strtotime($date_start))); ?>(TOTAL CRE STAFF - <?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND (head_name='EXEC SIDE' OR head_name='ADM SIDE') AND employee.employee_type='CRE'"); ?>)</u>
		</h3>
		<div>
			
				<?php
				$head_name="EXEC SIDE";
				$employee_type="CRE";
				?>
			<p align="center"><u><?php echo $head_name; ?> (<?php echo $employee_type; ?>-STAFF)</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>S/No</th>
					<th>Cat</th>
					<th>Auth</th>
					<th>Held</th>
					<th>Leave</th>
					<th>Absent</th>
					<th>Course</th>
					<th>D/O</th>
					<th>T/Duty</th>
					<th>CMH</th>
					<th>Att</th>
					<th>Out</th>
					<th>Present</th>
				</tr>
				<tr align="center">
					<td>1</td>
					<td>Civ (Staff)</td>
<!--					EXEC SIDE (CRE-STAFF) AUTH-->
					<td width="80">
						<input type="text" size="5" style="width: 85%; text-align: center;">
						<?php  showQuery("SELECT count(employee_rank.auth) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) HELD-->
					<td><?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) LEAVE-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='LEAVE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) ABSENT-->
						<td><?php 
						echo showQuery("SELECT (SELECT COUNT(*) FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND employee_type='$employee_type' AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')) - (SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)) ");
						?></td>
					
<!--					EXEC SIDE (CRE-STAFF) COURSE-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='COURSE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) D/O-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='D/O' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) TEMP DUTY-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='T/DUTY' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
<!--					EXEC SIDE (CRE-STAFF) CMH-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='CMH' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) ATT-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='ATT' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) OUT-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)"); ?></td>
					
<!--					EXEC SIDE (CRE-STAFF) PRESENT-->
					<td><?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND head_name='$head_name' AND employee.employee_type='$employee_type' AND attendence.date BETWEEN '$date_start' AND '$date_start'"); ?></td>
					
				</tr>
			</table>
		</div>
		<div>
			<?php
				$head_name="ADM SIDE";
				$employee_type="CRE";
				?>
			<p align="center"><u><?php echo $head_name; ?> (<?php echo $employee_type; ?>-STAFF)</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>S/No</th>
					<th>Cat</th>
					<th>Auth</th>
					<th>Held</th>
					<th>Leave</th>
					<th>Absent</th>
					<th>Course</th>
					<th>D/O</th>
					<th>T/Duty</th>
					<th>CMH</th>
					<th>Att</th>
					<th>Out</th>
					<th>Present</th>
				</tr>
				<tr align="center">
					<td>1</td>
					<td>Civ (Staff)</td>
<!--					ADM  SIDE (CRE-STAFF) AUTH-->
					<td width="80">
						<input type="text" size="5" style="width: 85%; text-align: center;">
						<?php  showQuery("SELECT count(employee_rank.auth) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
<!--					ADM  SIDE (CRE-STAFF) HELD-->
					<td><?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) LEAVE-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='LEAVE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					
<!--					ADM  SIDE (CRE-STAFF) ABSENT-->
				<td>
					<?php 
						echo showQuery("SELECT (SELECT COUNT(*) FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND employee_type='$employee_type' AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')) - (SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)) ");
						?>
					
					</td>
					
<!--					ADM  SIDE (CRE-STAFF) COURSE-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='COURSE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) D/O-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='D/O' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) TEMP DUTY-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='T/DUTY' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
<!--					ADM  SIDE (CRE-STAFF) CMH-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='CMH' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) ATT-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='ATT' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) OUT-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)"); ?></td>
					
<!--					ADM  SIDE (CRE-STAFF) PRESENT-->
					
					<td><?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND head_name='$head_name' AND employee.employee_type='$employee_type' AND attendence.date BETWEEN '$date_start' AND '$date_start'"); ?></td>
				</tr>
			</table>
		</div><div>
		
			<?php
				$head_name="EXEC SIDE";
				$employee_type="C/STAFF";
				?>
			<p align="center"><u><?php echo $head_name; ?> (<?php echo $employee_type; ?>)(TOTAL STAFF - <?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND (head_name='EXEC SIDE' OR head_name='ADM SIDE') AND employee.employee_type='$employee_type'"); ?>) </u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>S/No</th>
					<th>Cat</th>
					<th>Auth</th>
					<th>Held</th>
					<th>Leave</th>
					<th>Absent</th>
					<th>Course</th>
					<th>D/O</th>
					<th>T/Duty</th>
					<th>CMH</th>
					<th>Att</th>
					<th>Out</th>
					<th>Present</th>
				</tr>
				
				<tr align="center">
					<td>1</td>
					<td>Civ (Staff)</td>
					
		<!--					EXEC SIDE (C/STAFF) AUTH-->
					<td width="80">
						<input type="text" size="5" style="width: 85%; text-align: center;">
						<?php  showQuery("SELECT count(employee_rank.auth) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) HELD-->
					<td><?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) LEAVE-->
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='LEAVE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) ABSENT-->
						<td><?php 
						echo showQuery("SELECT (SELECT COUNT(*) FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND employee_type='$employee_type' AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')) - (SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)) ");
						?></td>
					
		<!--					EXEC SIDE (C/STAFF) COURSE-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='COURSE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) D/O-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='D/O' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) TDUTY-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='T/DUTY' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) CMH-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='CMH' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) ATT-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='ATT' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
		<!--					EXEC SIDE (C/STAFF) OUT-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)"); ?></td>
					
		<!--					EXEC SIDE (C/STAFF) PRESENT-->
					<td><?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND head_name='$head_name' AND employee.employee_type='$employee_type' AND attendence.date BETWEEN '$date_start' AND '$date_start'"); ?></td>
					
				</tr>
			</table>
		</div>
		<div>
			
			<?php
				$head_name="ADM SIDE";
				$employee_type="C/STAFF";
				?>
			<p align="center"><u><?php echo $head_name; ?> (<?php echo $employee_type; ?>)</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>S/No</th>
					<th>Cat</th>
					<th>Auth</th>
					<th>Held</th>
					<th>Leave</th>
					<th>Absent</th>
					<th>Course</th>
					<th>D/O</th>
					<th>T/Duty</th>
					<th>CMH</th>
					<th>Att</th>
					<th>Out</th>
					<th>Present</th>
				</tr>
				
					
				<tr align="center">
					<td>1</td>
					<td>Civ (Staff)</td>
					<!--					ADM SIDE (C/STAFF) AUTH-->
		
			<td width="80">
						<input type="text" size="5" style="width: 85%; text-align: center;">
						<?php  showQuery("SELECT count(employee_rank.auth) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					<!--					ADM SIDE (C/STAFF) HELD-->
					<td><?php echo showQuery("SELECT COUNT(*) FROM account_subhead,employee,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND head_name='$head_name' AND employee.employee_type='$employee_type'"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) LEAVE-->
											
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='LEAVE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					</td>
					
					<!--					ADM SIDE (C/STAFF) ABSENT-->
							<td><?php 
						echo showQuery("SELECT (SELECT COUNT(*) FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND employee_type='$employee_type' AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')) - (SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)) ");
						?></td>
					
					<!--					ADM SIDE (C/STAFF) COURSE-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='COURSE' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) D/O-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='D/O' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) T/DUTY-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='T/DUTY' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) CMH-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='CMH' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) ATT-->
				
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE (date BETWEEN '$date_start' AND '$date_start') AND status='ATT' AND employee.employee_type='$employee_type' AND employee_shift_allocation.employee=employee.id AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name')"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) OUT-->
					
					<td><?php echo showQuery("SELECT count(*) FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.date='$date_start' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='$head_name') AND (employee.employee_type='$employee_type') AND status IN (SELECT status_name FROM `status_list`)"); ?></td>
					
					<!--					ADM SIDE (C/STAFF) PRESENT-->
					<td><?php echo showQuery("SELECT COUNT(attendence.emp_no) FROM employee,attendence,account_subhead,employee_rank WHERE employee.branch=account_subhead.id AND employee_rank.employee_rank=employee.rank AND employee.id=attendence.emp_no AND employee.branch=account_subhead.id AND inOrOut='IN' AND head_name='$head_name' AND employee.employee_type='$employee_type' AND attendence.date BETWEEN '$date_start' AND '$date_start'"); ?></td>
					
				</tr>
			</table>
		</div>
		<div>
			<p align="center"><u>COURSE</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>Ser</th>
					<th width="200">No Of Employees</th>
					<th width="200">Rank</th>
					<th>Remarks</th>
				</tr>
				<?php
				$i=1;
				$sqlview="SELECT COUNT(employee.army_no),employee.rank FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.status='COURSE' AND employee_shift_allocation.date='$date_start' GROUP BY employee.rank";
				$queryview=mysqli_query($con,$sqlview);
				while($rowview=mysqli_fetch_array($queryview))
				{
				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td><?php echo $rowview[0]; ?></td>
					<td><?php echo $rowview[1]; ?></td>
					<td></td>
					
				</tr>
				<?php $i++; } ?>
			</table>
		</div>
		<div>
			<p align="center"><u>LONG LEAVE</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>Ser</th>
					<th>No</th>
					<th>Rank</th>
					<th>Name</th>
					<th>Gp</th>
					<th>Date</th>
					<th width="300">Remarks</th>
					
				</tr>
				<?php
					$i=1;
				$sqlview="SELECT employee.army_no,employee.rank,employee.name,employee.branch,COUNT(status),MIN(date),MAX(date) FROM employee_shift_allocation,employee    WHERE employee_shift_allocation.employee=employee.id AND date BETWEEN DATE_ADD('$date_start', INTERVAL -15 DAY) AND DATE_ADD('$date_start', INTERVAL 15 DAY) AND status='LEAVE'   GROUP BY employee HAVING COUNT(status)>=10";
				$queryview=mysqli_query($con,$sqlview);
				while($rowview=mysqli_fetch_array($queryview))
				{
				?>
				<tr align="center">
				
					<td><?php echo $i; ?></td>
					<td align="left"><?php echo $rowview[0]; ?></td>
					<td><?php echo $rowview[1]; ?></td>
					<td align="left"><?php echo $rowview[2]; ?></td>
					<td><?php echo  showQuery("SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[3]'") ?></td>
					<td align="left"><?php echo "Wef ".$rowview[5]." to ".$rowview[6]." ($rowview[4] Leaves)";  ?></td>
					<td></td>
				</tr>
				<?php $i++; } ?>
			</table>
		</div>
		<div>
			<p align="center"><u>TEMP DUTY</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>Ser</th>
					<th width="200">No Of Employees</th>
					<th width="200">Rank</th>
					<th>Remarks</th>
				</tr>
				<?php
				$i=1;
				$sqlview="SELECT COUNT(employee.army_no),employee.rank FROM employee_shift_allocation,employee WHERE employee_shift_allocation.employee=employee.id AND employee_shift_allocation.status='T/DUTY' AND employee_shift_allocation.date='$date_start' GROUP BY employee.rank";
				$queryview=mysqli_query($con,$sqlview);
				while($rowview=mysqli_fetch_array($queryview))
				{
				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td><?php echo $rowview[0]; ?></td>
					<td><?php echo $rowview[1]; ?></td>
					<td></td>
					
				</tr>
				<?php $i++; } ?>
			</table>
		</div>
		<div>
			<p align="center"><u>ISI EMP</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>Ser</th>
					<th>No</th>
					<th>Rank</th>
					<th>Name</th>
					<th>Gp</th>
					<th>Date</th>
					<th>Remarks</th>
					
				</tr>
				<tr align="center">
					<td>1</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div>
			<p align="center"><u>DETAIL OF ABSENT (CIV PERS)</u>
			</p>
			<table align="center" border="1">
				<tr>
					<th>Ser</th>
					<th>No</th>
					<th>Rank</th>
					<th>Name</th>
					<th>Gp</th>
					<th>Date</th>
					<th width="300">Remarks</th>
					
				</tr>
				
				<tr>
					<th colspan="7">Exec Side</th>
				</tr>
				<?php
				$i=1;
				
			//	$sqlview="SELECT employee.army_no,employee.rank,employee.name,employee.branch,e.date  FROM employee,employee_shift_allocation e LEFT JOIN attendence ON e.employee = attendence.emp_no AND e.status='Allocated' WHERE employee.id=e.employee AND attendence.emp_no IS NULL AND status='Allocated' AND e.date between '$date_start' AND '$date_start' AND employee.employee_type='C/STAFF' AND employee.branch IN (SELECT id FROM account_subhead WHERE head_name='EXEC SIDE' )";
				$head_name="EXEC SIDE";
			$sqlview=" SELECT * FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND (employee_type='CRE' OR employee_type='C/STAFF') AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')  AND e.id NOT IN (SELECT employee FROM `employee_shift_allocation` WHERE date='$date_start' AND status!='Allocated') ORDER BY e.branch,employee_type";
				//echo $sqlview;
				$queryview=mysqli_query($con,$sqlview);
				while($rowview=mysqli_fetch_array($queryview))
				{
				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td align="left"><?php echo $rowview[0]; ?></td>
					<td><?php echo $rowview[2]; ?></td>
					<td align="left"><?php echo $rowview[1]; ?></td><td><?php echo  showQuery("SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[4]'") ?></td>
					<td><?php echo $date_start; ?></td>
					<td></td>
					
				</tr>
				<?php $i++; } ?>
				<tr>
					<th colspan="7">Adm Side</th>
				</tr>
				
				<?php
				$i=1;
				
				$head_name="ADM SIDE";
			$sqlview=" SELECT * FROM employee e
LEFT JOIN attendence ON e.id = attendence.emp_no
AND attendence.date = '$date_start'
WHERE attendence.time IS NULL AND (employee_type='CRE' OR employee_type='C/STAFF') AND e.branch IN (SELECT id FROM account_subhead WHERE account_subhead.head_name='$head_name')  AND e.id NOT IN (SELECT employee FROM `employee_shift_allocation` WHERE date='$date_start' AND status!='Allocated') ORDER BY e.branch,employee_type";
				//echo $sqlview;
				$queryview=mysqli_query($con,$sqlview);
				while($rowview=mysqli_fetch_array($queryview))
				{
				?>
				<tr align="center">
					
					<td><?php echo $i; ?></td>
					<td align="left"><?php echo $rowview[0]; ?></td>
					<td><?php echo $rowview[2]; ?></td>
					<td align="left"><?php echo $rowview[1]; ?></td><td><?php echo  showQuery("SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[4]'") ?></td>
					<td><?php echo $date_start; ?></td>
					<td></td>
					
				</tr>
				<?php $i++; } ?>
				
			</table>
		</div>
		<table style="margin-top: 50px;">
		<tr>
		<th>DTK:</th>	
		<th style="border-bottom: 1px solid black;" width="150px"></th>
		<th>E&FO:</th>	
		<th style="border-bottom: 1px solid black;" width="150px"></th>
		<th>AC:</th>	
		<th style="border-bottom: 1px solid black;" width="150px"></th>
		<th>Comdt:</th>	
		<th style="border-bottom: 1px solid black;" width="150px"></th>
			
		</tr>
		</table>
		
	</div>
</body>
</html>