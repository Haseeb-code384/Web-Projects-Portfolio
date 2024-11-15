<?php
include( 'config.php' );
$page = basename( parse_url( $_SERVER[ 'HTTP_REFERER' ], PHP_URL_PATH ) );

function alertredirect( $msg, $page ) {
  ?>
<script>alert('<?php echo $msg ?>');
window.location.href="<?php echo $page ?>";
</script>
<?php
}

if ( $_REQUEST[ 'del_suggestion_entry' ] ) {
    //for deleting medicine list entry
  $del_suggestion_entry = $_REQUEST[ 'del_suggestion_entry' ];
//  $page = "medicine_manage_medicine_list.php";
  
  $sql = "DELETE FROM `medicine_list` WHERE `abbreviation`='$del_suggestion_entry'";
  $query = mysqli_query( $con, $sql );
   // echo $sql;d
echo "<script>window.close();</script>";
  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'del_suggestion' ] ) {
  $del_suggestion = $_REQUEST[ 'del_suggestion' ];
  $table_name = $_REQUEST[ 'table_name' ];
  $column = $_REQUEST[ 'column' ];
  $page = "medicine_manage_suggestion.php?table_name=$table_name&column=$column";
  
  $sql = "DELETE FROM `$table_name` WHERE $column='$del_suggestion'  ";
  $query = mysqli_query( $con, $sql );
   // echo $sql;
echo "<script>window.close();</script>";
  alertredirect( "Deleted Successfully", $page );
}

if ( $_REQUEST[ 'delete_formula_variation' ] ) {
  $delete_formula_variation = $_REQUEST[ 'delete_formula_variation' ];
  $rubric_id = $_REQUEST[ 'rubric_id' ];
  $formula_number = $_REQUEST[ 'formula_number' ];
  
  $sql = "DELETE FROM `medicine_rubric_variation` WHERE `medicine_rubric_variation`.`rubrik_id` = '$rubric_id' AND `medicine_rubric_variation`.`formula_number` = '$formula_number' AND `medicine_rubric_variation`.`variation_potency` = '$delete_formula_variation'";
  $query = mysqli_query( $con, $sql );
    echo $sql;
echo "<script>window.close();</script>";
 // alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'delete_formula' ] ) {
  $delete_formula = $_REQUEST[ 'delete_formula' ];
  $page = $_REQUEST[ 'page' ];

  $sql = "DELETE FROM `medicine_formula` WHERE `medicine_formula`.`id` = '$delete_formula'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}

if ( $_REQUEST[ 'courier_account' ] ) {
  $courier_account = $_REQUEST[ 'courier_account' ];

  $sql = "DELETE FROM `courier_company` WHERE `courier_company`.`company_account_name` = '$courier_account'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
} 

if ( $_REQUEST[ 'delete_order_payment_cart' ] ) {
  $delete_order_payment_cart = $_REQUEST[ 'delete_order_payment_cart' ];

  $sql = "DELETE FROM `order_payment_cart` WHERE id='$delete_order_payment_cart'";
  $query = mysqli_query( $con, $sql );
header("Location: $page");
}if ( $_REQUEST[ 'delete_order_dispatch_cart' ] ) {
  $delete_order_dispatch_cart = $_REQUEST[ 'delete_order_dispatch_cart' ];

  $sql = "DELETE FROM `order_dispatch_cart` WHERE id='$delete_order_dispatch_cart'";
  $query = mysqli_query( $con, $sql );
header("Location: $page");
}

if ( $_REQUEST[ 'basic_disease_cat' ] ) {
  $basic_disease_cat = $_REQUEST[ 'basic_disease_cat' ];

  $sql = "DELETE FROM `disease_category` WHERE disease_category = '$basic_disease_cat'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
} if ( $_REQUEST[ 'basic_disease' ] ) {
  $basic_disease = $_REQUEST[ 'basic_disease' ];

  $sql = "DELETE FROM `disease` WHERE disease = '$basic_disease'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'expense_id_restore' ] ) {
  $expense_id_restore = $_REQUEST[ 'expense_id_restore' ];

  $sql = "UPDATE `expenses` SET `deleted` = '0' WHERE `expenses`.`expense_id` = '$expense_id_restore'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Restored Successfully", $page );
}
if ( $_REQUEST[ 'expense_id' ] ) {
  $expense_id = $_REQUEST[ 'expense_id' ];

  $sql = "UPDATE `expenses` SET `deleted` = '1' WHERE `expenses`.`expense_id` = '$expense_id'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'product_kit' ] ) {
  $product_kit = $_REQUEST[ 'product_kit' ];

  $sql = "DELETE FROM `product_kit` WHERE `product_kit`.`id` = '$product_kit'";
  $query = mysqli_query( $con, $sql );
  $sql = "DELETE FROM `products_in_kits` WHERE kit_id= '$product_kit'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}

if ( $_REQUEST[ 'delete_rubric' ] ) {
  $delete_rubric = $_REQUEST[ 'delete_rubric' ];

  $sql = "DELETE FROM `rubric` WHERE `id` = '$delete_rubric'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'del_inquiry' ] ) {
  $del_inquiry = $_REQUEST[ 'del_inquiry' ];

  $sql = "DELETE FROM `inquiry` WHERE `inquiry`.`id` = '$del_inquiry'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'change_log_id' ] ) {
  $change_log_id = $_REQUEST[ 'change_log_id' ];

  $sql = "DELETE FROM `change_log` WHERE `change_log`.`id` = '$change_log_id'";
  $query = mysqli_query( $con, $sql );

  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'DelItemInKit' ] ) {
  $DelItemInKit = $_REQUEST[ 'DelItemInKit' ];
  $id = $_REQUEST[ 'id' ];
  $sql = "DELETE FROM `products_in_kits` WHERE `products_in_kits`.`id` ='$DelItemInKit'";
  $query = mysqli_query( $con, $sql );
  $p = "add_product_in_kit.php?id=" . $id;
  alertredirect( "Deleted Successfully", $p );
}
if ( $_REQUEST[ 'delprescription' ] ) {
  $delprescription = $_REQUEST[ 'delprescription' ];
  $id = $_REQUEST[ 'id' ];
  $sql = "DELETE FROM `product_prescription` WHERE `product_prescription`.`id` = '$delprescription'";
  $query = mysqli_query( $con, $sql );
  $p = "prescribe.php?id=" . $id;
  alertredirect( "Deleted Successfully", $p );
}

if ( $_REQUEST[ 'symptom' ] ) {
  $symptom = $_REQUEST[ 'symptom' ];
  $sql = "DELETE FROM `symptoms` WHERE `symptoms`.`symptom_name` = '$symptom';";
  $query = mysqli_query( $con, $sql );
  alertredirect( "Deleted Successfully", $page );
}
if ( $_REQUEST[ 'vehicle_out' ] ) {
  $vehicle_out = $_REQUEST[ 'vehicle_out' ];
  $sql = "UPDATE `vehicle` SET `status` = 'OUT' WHERE `vehicle`.`vehicle_id` = '$vehicle_out';";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'visitor_out' ] ) {
  $visitor_out = $_REQUEST[ 'visitor_out' ];
  $sql = "UPDATE visitor SET name=name,created_by=1 WHERE id='$visitor_out'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'del_emp_rank' ] ) {
  $del_emp_rank = $_REQUEST[ 'del_emp_rank' ];
  $sql = "DELETE FROM `employee_rank` WHERE employee_rank='$del_emp_rank'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'shift' ] ) {
  $shift = $_REQUEST[ 'shift' ];
  $sql = "DELETE FROM `shift` WHERE shift_name='$shift'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'del_emp_profession' ] ) {
  $del_emp_profession = $_REQUEST[ 'del_emp_profession' ];
  $sql = "DELETE FROM `employee_profession` WHERE `employee_profession`.`employee_profession` = '$del_emp_profession'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'del_emp_type' ] ) {
  $del_emp_type = $_REQUEST[ 'del_emp_type' ];
  $sql = "DELETE FROM `employee_type` WHERE `employee_type`.`employee_type` = '$del_emp_type'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}

if ( $_REQUEST[ 'gate' ] ) {
  $gate = $_REQUEST[ 'gate' ];
  $sql = "DELETE FROM `gate` WHERE `gate`.`gate_name` = '$gate'";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'deldailyvoucher' ] ) {
  $deldailyvoucher = $_REQUEST[ 'deldailyvoucher' ];
  $sql = "DELETE FROM `daily_voucher` WHERE id='$deldailyvoucher';";
  $query = mysqli_query( $con, $sql );

  $sql = "DELETE FROM `m_account_detail` WHERE invno='$deldailyvoucher';";
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}
if ( $_REQUEST[ 'delbrd' ] ) {
  $brd = $_REQUEST[ 'delbrd' ];
  $sql = "DELETE FROM `account_head` WHERE `account_head`.`head_name` = '$brd'";
  echo $sql;
  $query = mysqli_query( $con, $sql );
  header( 'location: ' . $page );
}

if ( $_REQUEST[ 'deltest' ] ) {
  $brd = $_REQUEST[ 'deltest' ];
  $sql = "DELETE FROM `test` WHERE `test`.`test_name` = '$brd'";
  $query = mysqli_query( $con, $sql );
  header( 'location: manage_test_type.php' );
}

if ( $_REQUEST[ 'delincome' ] ) {
  $brd = $_REQUEST[ 'delincome' ];
  $sql = "DELETE FROM `transactions` WHERE `id` = '$brd'";
  $query = mysqli_query( $con, $sql );
  header( 'location: manage_income.php' );
}
if ( $_REQUEST[ 'delexpense' ] ) {
  $brd = $_REQUEST[ 'delexpense' ];
  $sql = "DELETE FROM `transactions` WHERE `id` = '$brd'";
  $query = mysqli_query( $con, $sql );
  header( 'location: manage_expenses.php' );
}

if ( $_REQUEST[ 'delstd' ] ) {
  $brd = $_REQUEST[ 'delstd' ];
  $sql1 = "INSERT INTO alumni SELECT * FROM student WHERE student.admission_no='$brd';";
  $sql2 = "DELETE FROM student WHERE student.admission_no='$brd';";
  $query = mysqli_query( $con, $sql1 )or die( mysqli_error( $con ) );
  $query = mysqli_query( $con, $sql2 )or die( mysqli_error( $con ) );
  //	echo($sql);
  header( 'location: alumni.php' );
}

if ( $_REQUEST[ 'delemp' ] ) {
  $brd = $_REQUEST[ 'delemp' ];

  $sql = "Update `employee` set active='0' where id = '$brd'";
  $query = mysqli_query( $con, $sql );
  header( 'location: manage_employee.php' );

}


if ( $_REQUEST[ 'delsession' ] ) {
  $brd = $_REQUEST[ 'delsession' ];
  $sql = "DELETE FROM `session` WHERE `session`.`session_name` = '$brd'";
  $query = mysqli_query( $con, $sql );
  header( 'location: manage_session.php' );
}

if ( $_REQUEST[ 'delsubclass' ] ) {
  $class = $_REQUEST[ 'delsubclass' ];
  $delboard = $_REQUEST[ 'delboard' ];
  $subject = $_REQUEST[ 'delsubject' ];

  $sql = "delete from `class_subject` where board='$class'  and c_name='$delboard' and subject_name='$subject'";
  echo( $sql );
  $query = mysqli_query( $con, $sql );
  header( 'location: class_subject.php' );
}
if ( $_REQUEST[ 'delsub' ] ) {
  $subject = $_REQUEST[ 'delsub' ];

  $sql = "DELETE FROM `subject` where s_name='$subject';";
  echo( $sql );
  $query = mysqli_query( $con, $sql );
  header( 'location: add_subject.php' );
}
if ( $_REQUEST[ 'delsubhead' ] ) {
  $delfarm = $_REQUEST[ 'delsubhead' ];

  $sql = "delete from `account_subhead` where id='$delfarm'";

  $query = mysqli_query( $con, $sql );
  header( 'location: manage_account_subhead.php' );
}
if ( $_REQUEST[ 'delstdsubject' ] ) {
  $delstdsubject = $_REQUEST[ 'delstdsubject' ];
  $roll = $_REQUEST[ 'roll' ];
  $subject = $_REQUEST[ 'subject' ];

  $sql = "delete from `student_subject` where c_name='$class' and class_type='$deltype' and board='$delboard' ";
  $sql = "DELETE FROM `student_subject` WHERE `student_subject`.`admission_no` = '$delstdsubject' AND `student_subject`.`roll_no` = '$roll' AND `student_subject`.`subject_name` = '$subject'";
  echo( $sql );
  $query = mysqli_query( $con, $sql );
  header( "location: upd_std_subjects.php?admission_no=" . $delstdsubject . "" );
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
</head>

<body>
</body>
</html>
