<?php
include( "config.php" );
include( "allFunctions.php" );

include( "filter_php.php" );

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
include "start.php";
?>
</div>
<div class="content-wrapper">
<div class="container-fluid">
<div class="col-lg-12">
<?php breadcrumb(); ?>
<?php include("filter_employee_form.php"); ?>
<form action="process_inquiry_employee_allocation.php" method="post">
    <div class="form-group vAlign">
      <label>User:
        <select class="form-select-sm"  name="allocated_to">
          <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
        </select>
      </label>
      <input type="submit" name="submit" value="Allocate" class="btn-sm btn-primary">
    </div>
 
  <?php include("fix_header.php"); ?>
        <tr>
          <th align="center" colspan="200"><?php
          echo mysqli_num_rows( $queryview );
          ?>
            Records Found <br>
            Select
            <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50">
            Rows </th>
        </tr>
        <tr>
          <th><input type="checkbox" id="select-all" onClick="selall(this,'emp[]');">
            Inquiry No</th>
          <th>Source</th>
          <th>Name</th>
          <th>Phone 1</th>
          <th>Phone 2</th>
          <th>Whatsapp</th>
          <th>Call Status</th>
          <th>Entry Date</th>
          <th>Record Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ( $rowview = mysqli_fetch_array( $queryview ) ) {
          ?>
        <tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
          <td><input type="checkbox" value="<?php echo $rowview['id']; ?>" name="emp[]">
            <?php echo $rowview[0]; ?></td>
          <td><?php echo $rowview[1]; ?></td>
          <td><?php echo $rowview[2]; ?></td>
          <td><?php echo $rowview[3]; ?></td>
          <td><?php echo $rowview[4]; ?></td>
          <td><?php echo $rowview[5]; ?></td>
          <td><?php echo $rowview[6]; ?></td>
          <td><?php echo $rowview[7]; ?></td>
          <td><?php echo $rowview['record_date']; ?></td>
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