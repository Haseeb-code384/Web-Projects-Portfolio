<?php
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
$sql = "SELECT * FROM `expenses` WHERE expense_id='$id'";
$query = mysqli_query( $con, $sql );
$row = mysqli_fetch_array( $query );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $expense_id = $_REQUEST[ 'expense_id' ];
  $date = $_REQUEST[ 'date' ];
  $description = $_REQUEST[ 'description' ];
  $amount = $_REQUEST[ 'amount' ];
  $payment_type = $_REQUEST[ 'payment_type' ];
  $expense_category = strtoupper( $_REQUEST[ 'expense_category' ] );


  $sql_update = "UPDATE `expenses` SET `date` = '$date', `amount` = '$amount', `payment_type` = '$payment_type', `expense_category` = '$expense_category', `description` = '$description' WHERE `expenses`.`expense_id` = $expense_id";
  $query_update = mysqli_query( $con, $sql_update )or die( $con );

  if ( $query_update ) {
    alertredirect( "Expense Updated Successfully", "view_expenses.php" );
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
<script src="semester.js"></script>
</head>

<body>
<?php
include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="row" style="">
    <form method="get" action="">
      <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
        <div class="row">
          <div class="col-12 text-center h4" style="background-color: #7A382C;color: #F8C401;"> Expense Information </div>
        </div>
        <div class="row">
          <div class="col-6">
            <input type="hidden" name="expense_id" value="<?php echo $id; ?>">
            <label class="text-danger"><strong>Category: </strong></label>
            <input list="cat" value="<?php echo $row['expense_category']; ?>" class="form-control" type="text" name="expense_category" required placeholder="Enter Expense Category">
            <datalist id="cat">
              <?php populateDDdistinct("expense_category","expenses") ?>
            </datalist>
          </div>
          <div class="col-6">
            <label class=""><strong>Description: </strong></label>
            <input class="form-control" type="text" name="description" value="<?php echo $row['description']; ?>"  placeholder="Enter Expense Description">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label class="text-danger"><strong>Amount: </strong></label>
            <input name="amount"  class="form-control" type="number" value="<?php echo $row['amount']; ?>"  required placeholder="Enter Amount">
          </div>
          <div class="col-sm-6">
            <label class="text-danger"><strong>Date: </strong></label>
            <input  name="date"  class="form-control" type="date" value="<?php echo $row['date']; ?>"  required>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <label class=""><strong>Payment Type:</strong></label>
            <select name="payment_type" required  class="form-select">
              <?php $options_array=array('Cash','Cheque','Debit Card'); ?>
              <?php
              foreach ( $options_array as $opt ) {
                if ( $opt == $row[ 'payment_type' ] ) {
                  echo "<option selected>$opt</option>";
                } else {
                  echo "<option>$opt</option>";
                }

              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-12 text-center"> <br>
          <input type="submit" name="submit" class="btn-sm btn-primary">
          <input type="reset" class="btn-sm btn-secondary" value="Clear All">
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>