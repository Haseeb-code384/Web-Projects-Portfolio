<?php
include("config.php");
include("allFunctions.php");

include("limit_record.php");

include("refilter_php.php");

?>
<!DOCTYPE html>
<html>
<head>
	<script src="js/selectall.js"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<?php include("preloader.php"); ?>
	<?php 
include "start.php"; ?></div>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="col-lg-12">
				<div class="row" style="">
			
		
		<?php breadcrumb(); ?>
					<?php include("refilter_employee_form.php"); ?>
			<form action="process_inquiry_employee_allocation.php" method="post">
			<div class="col-lg-12">
				  <div class="form-group vAlign">
      <label>User:
        <select class="form-select-sm"  name="allocated_to">
          <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
        </select>
      </label>
      <input type="submit" name="submit" value="Allocate" class="btn-sm btn-primary">
    </div>
 
			</div>
		</div>
<strong>	<?php 
		echo mysqli_num_rows($queryview); ?> Records Found</strong> Select <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50"> Rows
				 <?php include("fix_header.php"); ?>
				
								<tr>
								<th> <input type="checkbox" id="select-all" onClick="selall(this,'emp[]');">Inquiry#</th>
								<th>Source</th>
								<th>Seller</th>
								<th>Name</th>
								<th>Phone1</th>
								<th>Phone2</th>
								<th>Whatsapp</th>
								<th>Call Status</th>
								<th>Order Status</th>
								<th>Entry Date</th>
								<th>Allocation Date</th>
								</tr>

						</thead>
						<tbody>
							<?php
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								
								<td><input type="checkbox" value="<?php echo $rowview['id']; ?>" name="emp[]"><?php echo $rowview[0]; ?></td>
								
              <td title="<?php echo $rowview[1] ?>"><?php echo substr($rowview[1],0,5); ?>...</td>
                                
              <td title="<?php echo $rowview['allocated_to'] ?>"><?php echo substr($rowview['allocated_to'],0,5); ?>...</td>
							
								
              <td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
								<td title="<?php echo $rowview[4]; ?>"><?php echo $rowview[3]; ?></td>
								<td title="<?php echo $rowview[6]; ?>"><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
								<td><?php echo $rowview[8]; ?></td>
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[10]; ?></td>
								
              <td title="<?php echo $rowview[12] ?>"><?php echo substr($rowview[12],0,10); ?>...</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
	</form>
<br>
<br>
<br>

</body>
</html>