<?php
include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit']))
{
    
     $disease = $_REQUEST['disease'];
    
	   $sqlview="SELECT * FROM `inquiry` WHERE  id IN (SELECT inquiry_id FROM `inquiry_disease` WHERE disease='$disease')";
    
	
include("limit_record.php");
	
}
?>
<!DOCTYPE html>
<html>
<head>
 
	<script src="js/selectall.js"></script>
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
			
		
			<?php breadcrumb(); ?>
			<form>
                
			<div class="col-lg-12">
	
                <div class="row">
                   
                    <div class="col-sm-3">
                    <label><strong>Select Disease:</strong></label> 
                        <select class="form-control" name="disease">
                            <?php $sqlcol="SELECT disease,count(*) FROM `inquiry_disease` GROUP BY disease ORDER BY count(*) DESC";
                            $querycol=mysqli_query($con,$sqlcol);
                            while($rowcol=mysqli_fetch_array($querycol))
                            {
                                ?>
                            <option <?php if(isset($_REQUEST['disease'])) { if($_REQUEST['disease']==$rowcol[0]) { echo "selected"; }  } ?> value="<?php echo $rowcol[0]; ?>"><?php echo $rowcol[0]; ?> (<?php echo $rowcol[1]; ?>)</option>
                            <?php
                            }
                            
                            ?>
                        </select>
                        
                
                        
                    </div>   
             
                 
                    <div class="col-sm-3">
                    <br>
                    <input type="submit" name="submit" value="Search" class="btn-sm btn-primary">
                    </div>
                    
                </div>
				    
                  <br>
					
				</div>
		</div>
			</form>
    <?php 
    if(isset($_REQUEST['disease']))
{
     ?>
    <form method="post" action="process_inquiry_employee_allocation.php">
        
			
    
 			    <div class="col-lg-12">
                        <?php 
        $queryview = mysqli_query( $con, $sqlview );
		echo mysqli_num_rows($queryview); ?> Records Found</strong> Select <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50"> Rows
        <span style="float: right;">
          <label>User:
        <select class="form-select-sm"  name="allocated_to">
          <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
        </select>
      </label>
      <input type="submit"  name="submit" value="Allocate" class="btn-sm btn-primary">
</span>
      <?php
       include( "fix_header.php" );

      ?>
      <tr>
        <th style="width: 100px;">Actions</th>
        <th>ID</th>
        <th>Seller</th>
        <th>Source</th>
        <th>Name</th>
        <th>Mobile1</th>
        <th>Mobile2</th>
        <th>Whatsapp</th>
        <th style="width: 80px;">Call Status</th>
        <th style="width: 80px;">Called At</th>
        <th style="width: 100px;">Recall Date</th>
        <th style="width: 100px;">Order Status</th>
      </tr>
      </thead>
      <tbody>
        <?php
        while ( $rowview = mysqli_fetch_array( $queryview ) ) {
          ?>
        <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
         <td style="display: inline;">
            <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <i title="Status History" onClick="window.open('inquiry_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i> <a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-volume-control-phone text-warning"></i></a> <a target="new" href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a> <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i></td>
          <td><input type="checkbox" value="<?php echo $rowview['id']; ?>" name="emp[]"><?php echo $rowview[0]; ?></td>
          <td title="<?php echo $rowview[23] ?>"><?php echo substr($rowview[23],0,5); ?>...</td>
          <td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
          <td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
          <td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
          <td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
          <td><?php echo $rowview[14]; ?></td>
          <td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
          <td title="<?php echo $rowview[17]; ?>"><?php echo substr($rowview[17],0,10); ?>...</td>
          <td title="<?php echo $rowview[18]; ?>"><?php echo $rowview[18]; ?></td>
          <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
        </tr>
        <?php } ?>
      </tbody>
      </table>
    </div>
    
							<?php } ?>
    </form>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>