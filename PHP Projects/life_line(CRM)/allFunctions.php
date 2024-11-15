<!doctype html>
<?php
function getDateWithOffset($daysOffset) {
  $today = new DateTime();
  $today->modify("{$daysOffset} day");
  return $today->format('Y-m-d');
}

function populate_parent_child_dd($sql_parent,$ddval,$ddtext,$table,$parent_col_name,$sel)
{
    include("config.php");
			$query2=mysqli_query($con,$sql_parent);
			while($row2=mysqli_fetch_array($query2))
			{
$parent=$row2[0];				
			  ?>
            <optgroup label="<?php echo $row2[0]; ?>">
			<?php
                
             
                   $sql3="SELECT $ddval,$ddtext FROM `$table` Where $parent_col_name IN ('$parent')";
                echo $sql3;
             $query3=mysqli_query($con,$sql3);
			while($row3=mysqli_fetch_array($query3))
			{
				?>	
              <option  <?php echo $sel == $row3[0] ? 'selected' : '';
 ?> value="<?php echo $row3[0]; ?>">&nbsp;&nbsp;<?php echo $row3[1] ?> </option>
				<?php } ?>
            </optgroup>
			<?php 
			}
}

function show_gender($gender)
{
    echo ($gender=="Male") ? "<i title='$gender' class='fa fa-male fa-2x text-primary'></i>" : "<i title='$gender' class='fa fa-2x fa-female' style='color: red;'></i>"; 
}
function show_network_img_title($network,$title)
{
    echo '<img title="'.$title.'" style="width: 32px;"  onerror=this.style.visibility="hidden" src="img/networks/'.$network.'.jpg">';
      echo "&ensp;";
}

function show_network_img($network)
{
    echo '<img style="width: 32px;"  onerror=this.style.visibility="hidden" src="img/networks/'.$network.'.jpg">';
      echo "&ensp;";
}

function getNonNegativeValue( $x ) {
  return abs( $x );
}
function getMonthName($monthNumber) {
  // Validate input (optional but recommended)

  $months = array(
    1 => "January",
    2 => "February",
    3 => "March",
    4 => "April",
    5 => "May",
    6 => "June",
    7 => "July",
    8 => "August",
    9 => "September",
    10 => "October",
    11 => "November",
    12 => "December",
  );

  return $months[$monthNumber];
}

function rand_color() {
  // return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
  $rgb = [
    random_int( 128, 255 ),
    random_int( 128, 255 ),
    random_int( 128, 255 ),
  ];

  $hex_code = '#' . str_pad( dechex( $rgb[ 0 ] ), 2, '0' )
    . str_pad( dechex( $rgb[ 1 ] ), 2, '0' )
    . str_pad( dechex( $rgb[ 2 ] ), 2, '0' );

  return $hex_code;
}

function order_status_payment_dd( $sel, $enable_parent ) {
  include( 'config.php' );
  $sql = "SELECT DISTINCT parent FROM `order_status` WHERE parent IN ('Final Stage') ORDER BY sort";

  $query = mysqli_query( $con, $sql );
  ?>
<option value="" selected><?php echo $sel ?></option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option  style="font-weight: 900; background-color: silver;"  <?php  if(!$enable_parent) echo'disabled'; ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
$sql1 = "SELECT order_status,description,color FROM `order_status` WHERE parent='$row[0]' ORDER BY sort";

$query1 = mysqli_query( $con, $sql1 );
while ( $row1 = mysqli_fetch_array( $query1 ) ) {
  ?>
<option title="<?php echo $row1[1] ?>"  <?php if($row1[0]==$sel) echo'selected'; ?> style="background-color: <?php echo $row1['color']; ?>" value="<?php echo $row1[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1[0]; ?></option>
<?php
}
}
}

function change_date_ddmmyyy( $x ) {
  if ( $x == "" || $x == "0000-00-00" ) {
    return null;
  }
  $timestamp = strtotime( $x );
  return date( 'd-m-Y', $timestamp );
}

function change_datetime_ddmmyyyhis( $x ) {
  if ( $x == "" || $x == "0000-00-00" ) {
    return null;
  }
  $timestamp = strtotime( $x );
  return date( 'd-m-Y h:i:s A', $timestamp );
}

function check_admin( $email ) {
  $x = $email;
  if ( $x == "Doctor Saima Chughtai" || $x == "Malik Nadeem Ghazanfar" || $x == "admin" || $x == "Doctor Omar Chughtai" || $x == "Admin Orders"|| $x == "Admin Inquiries"|| $x == "Admin Operations" ) {
    return true;
  } else {
    return false;
  }

}

function setSelectOptionIfNotNull( $value ) {
  if ( $value != "" ) {
    ?>
<option><?php echo $value; ?></option>
<?php
}
}

function showbool( $a ) {
  if ( $a == 1 ) {
    return "Yes";
  } else {
    return "No";
  }
}

function breadcrumb() {
  include( "config.php" );
  $link = basename( $_SERVER[ 'PHP_SELF' ] );
  $sql = "SELECT menu_name,fa_icon FROM `menu` WHERE link='$link'";
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  echo "<a title='Reload' class='text-decoration-none' href='$link' ><div class='breadcrumb h5 bg-danger' style='margin-top: -17px; color:white; padding:4px;
    margin-bottom: 0px;
'><i class='fa fa-fw $row[1]'></i> $row[0]<div style='position: absolute;right: 10px; margin-top:13px; margin-right: 10px; transform: translateY(-50%); float: right;'> <i class='fa fa-spin fa-refresh'></i></div></div></a>";
}

function exists_in_db( $sql ) {
  include( "config.php" );
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  if ( $row[ 0 ] ) {
    return true;
  } else {
    return false;
  }
}

function return_resultarray( $sql ) {
  include( "config.php" );
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  return ( $row );
}

function getDatesFromRange( $start, $end, $format = 'Y-m-d' ) {

  // Declare an empty array
  $array = array();

  // Variable that store the date interval
  // of period 1 day
  $interval = new DateInterval( 'P1D' );

  $realEnd = new DateTime( $end );
  $realEnd->add( $interval );

  $period = new DatePeriod( new DateTime( $start ), $interval, $realEnd );

  // Use loop to store date into array
  foreach ( $period as $date ) {
    $array[] = $date->format( $format );
  }

  // Return the array elements
  return $array;
}


function delrec( $table, $field, $keyvalue, $return_page ) {

  include( 'config.php' );

  $sql = "delete from $table where $field=$keyvalue";

  $query = mysqli_query( $con, $sql );
  if ( $query ) {
    echo "<script>alert('Row Deleted Successfully');
		</script>";
  } else {

    echo "<script>alert('Unable to Deleted');
		</script>";
  }
}


function populateDDcondition( $table, $ddname, $ddvalue, $condition ) {
  include( 'config.php' );
  $sql = "select $ddvalue,$ddname from $table $condition";

  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Select</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option value="<?php echo $row[$ddvalue]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}

function populateDD( $table, $ddname, $ddvalue ) {
  include( 'config.php' );
  $sql = "select $ddvalue,$ddname from $table ORDER BY $ddname";

  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Select</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option value="<?php echo $row[$ddvalue]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}

function populateDDselarray( $table, $ddname, $ddvalue, $sel ) {
  include( 'config.php' );
  $sql = "select $ddvalue,$ddname from $table";

  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Select</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option <?php if(array_search($row[$ddvalue],$sel)) echo'selected'; ?> value="<?php echo $row[$ddvalue]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}

function populateDDsel( $table, $ddname, $ddvalue, $sel ) {
  include( 'config.php' );
  $sql = "select $ddvalue,$ddname from $table";

  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Select</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option  <?php if($row[$ddvalue]==$sel) echo'selected'; ?> value="<?php echo $row[$ddvalue]; ?>"><?php echo $row[1]; ?></option>
<?php
}
}


function populateDDdistinct( $select, $table ) {
  include( 'config.php' );
  $sql = "select distinct $select from $table order by $select";

  $query = mysqli_query( $con, $sql );
  echo "<option value=''>Select</option>";
  while ( $row = mysqli_fetch_array( $query ) ) {
    ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
}

function populateDDdistinctSel( $select, $table, $sel ) {
  include( 'config.php' );
  $sql = "select distinct $select from $table order by $select";

  $query = mysqli_query( $con, $sql );
  echo "<option value=''>Select</option>";
  while ( $row = mysqli_fetch_array( $query ) ) {
    ?>
<option <?php if($row[0]==$sel) echo'selected'; ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
}

function executeQuery( $sql ) {
  include( 'config.php' );
  $query = mysqli_query( $con, $sql );
  return mysqli_insert_id( $con );

}

function showQuery( $sql ) {
  include( 'config.php' );
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  return ( $row[ 0 ] );
}
function countQuery( $sql ) {
  include( 'config.php' );
  $query = mysqli_query( $con, $sql );
  $row = mysqli_num_rows( $query );
  return ($row);
}


function getNextId( $col, $table ) {
  include( 'config.php' );
  $sql = "SELECT max($col)+1 FROM `$table`";
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  $roll = $row[ 0 ];
  if ( $roll == "" ) {
    $roll = 1;
    return ( $roll );
  } else {

    return ( $roll );
  }

}

function convertNumberToWord( $num = false ) {
  $num = str_replace( array( ',', ' ' ), '', trim( $num ) );
  if ( !$num ) {
    return false;
  }
  $num = ( int )$num;
  $words = array();
  $list1 = array( '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
    'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
  );
  $list2 = array( '', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety', 'Hundred' );
  $list3 = array( '', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion', 'Sextillion', 'Septillion',
    'Octillion', 'Nonillion', 'Decillion', 'Undecillion', 'Duodecillion', 'Tredecillion', 'Quattuordecillion',
    'Quindecillion', 'Sexdecillion', 'Septendecillion', 'Octodecillion', 'Novemdecillion', 'Vigintillion'
  );
  $num_length = strlen( $num );
  $levels = ( int )( ( $num_length + 2 ) / 3 );
  $max_length = $levels * 3;
  $num = substr( '00' . $num, -$max_length );
  $num_levels = str_split( $num, 3 );
  for ( $i = 0; $i < count( $num_levels ); $i++ ) {
    $levels--;
    $hundreds = ( int )( $num_levels[ $i ] / 100 );
    $hundreds = ( $hundreds ? ' ' . $list1[ $hundreds ] . ' Hundred' . ' ' : '' );
    $tens = ( int )( $num_levels[ $i ] % 100 );
    $singles = '';
    if ( $tens < 20 ) {
      $tens = ( $tens ? ' ' . $list1[ $tens ] . ' ' : '' );
    } else {
      $tens = ( int )( $tens / 10 );
      $tens = ' ' . $list2[ $tens ] . ' ';
      $singles = ( int )( $num_levels[ $i ] % 10 );
      $singles = ' ' . $list1[ $singles ] . ' ';
    }
    $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int )( $num_levels[ $i ] ) ) ? ' ' . $list3[ $levels ] . ' ' : '' );
  } //end for loop
  $commas = count( $words );
  if ( $commas > 1 ) {
    $commas = $commas - 1;
  }
  return implode( ' ', $words );
}

function getPosition( $adm, $exam ) {
  include( 'config.php' );

  $sql = "select class from student where admission_no='$adm'";

  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  $class = $row[ 0 ];

  $sql = "select section from student where admission_no='$adm'";
  $query = mysqli_query( $con, $sql );
  $row = mysqli_fetch_array( $query );
  $section = $row[ 0 ];

  $sql = "select roll_no,sum(obtained_marks) as total from result where class='$class' and section='$section' and type='$exam'  GROUP BY roll_no order by total desc; ";
  //echo($sql);
  $query = mysqli_query( $con, $sql );

  $i = 1;
  while ( $row = mysqli_fetch_array( $query ) ) {
    if ( $row[ 0 ] == $adm ) {
      if ( $i == 1 ) {
        echo( "1st" );
      } elseif ( $i == 2 ) {
        echo( "2nd" );
      }

      elseif ( $i == 3 ) {
        echo( "3rd" );
      }
      else {

        echo( $i . "th" );
      }
    }
    $i++;
  }

}


function getStartAndEndDate( $week, $year ) {
  $dto = new DateTime();
  $dto->setISODate( $year, $week );
  $ret[ 'week_start' ] = $dto->format( 'Y-m-d' );
  $dto->modify( '+6 days' );
  $ret[ 'week_end' ] = $dto->format( 'Y-m-d' );
  return $ret;
}

function deleteRecord( $table, $col_name, $value, $redirect ) {
  include( 'config.php' );

  $sql = "DELETE FROM `$table` WHERE `$col_name` = '$value'";
  $query = mysqli_query( $con, $sql );
  if ( $query ) {
    $redirect = "Location:" . $redirect;
    header( $redirect );
  }
}

function accumulated_bal( $id, $end_date ) {
  $aid = $id;
  $d = $end_date;
  include( 'config.php' );
  $dr = showQuery( "SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$aid' AND info='Dr' AND tr_date<'$end_date'  AND user_verified!=''" );
  $cr = showQuery( "SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$aid' AND info='Cr' AND tr_date<'$end_date'  AND user_verified!=''" );
  $bal = $dr - $cr;
  return $bal;
}
function accumulated_bal_tr( $id, $tr ) {
  $aid = $id;
  include( 'config.php' );
  $dr = showQuery( "SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$aid' AND info='Dr' AND sno<'$tr'" );
  $cr = showQuery( "SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$aid' AND info='Cr' AND sno<'$tr'" );
  $bal = $dr - $cr;
  return $bal;
}


function get_arrear( $admission_no, $fine_per_month, $e_month ) {
  include( 'config.php' );
  $fine_per_month = 0;
  $pending_fee;
  $sql_first_fee = "SELECT month FROM fee WHERE admission_no='$admission_no' ORDER BY id ASC LIMIT 1";
  $query_first_fee = mysqli_query( $con, $sql_first_fee );
  $row_first_fee = mysqli_fetch_array( $query_first_fee );
  $first_month = $row_first_fee[ 0 ];
  $pending_fee = 0;
  if ( $first_month == "" ) {
    $pending_fee = 0;
  } else {

    $sql_pendnig = "select fee from student where admission_no='$admission_no'";
    $query_pendnig = mysqli_query( $con, $sql_pendnig );
    $row_pendnig = mysqli_fetch_array( $query_pendnig );

    //$start_date=$row_pendnig['date'];
    $start_date = $first_month . "-05";
    $student_fee = $row_pendnig[ 'fee' ];
    $end_date = $e_month;
    $start = ( new DateTime( $start_date ) )->modify( 'first day of this month' );
    $end = ( new DateTime( $end_date ) )->modify( 'first day of next month' );
    $interval = DateInterval::createFromDateString( '1 month' );
    $period = new DatePeriod( $start, $interval, $end );
    $i = 0;
    $dateArray = array();
    $noDone = array();
    $countfee = 0;
    foreach ( $period as $dt ) {
      $dt->format( "Y-m" ) . "<br>\n";
      $result[ $i ] = $dt->format( "Y-m" );

      $sql = "SELECT COUNT(*) from fee WHERE month='$result[$i]' AND admission_no='$admission_no'";
      //echo($sql);
      //	echo $sql."<br>";
      $query = mysqli_query( $con, $sql );
      $row = mysqli_fetch_array( $query );
      //	echo $row[0]."<br>";

      if ( $row[ 0 ] == "0" ) {
        $noDone[ $i ] = $result[ $i ];
        $countfee++;

      } else if ( $row[ 0 ] == "1" ) {
        $noDone[ $i ] = 0;
      } else {}
      $i++;
    }
    $length = count( $noDone ) - 1;
    //	echo $countfee;
    if ( $pending_fee != 0 ) {
      $pending_fee = $student_fee * $countfee;
    } else {
      $pending_fee = 0;
    }
    $fee_fine = $countfee * $fine_per_month;
    $pending_fee = $pending_fee + $fee_fine;
    //	echo $student_fee;
    //	print_r($noDone);

    /*	$countfee=0;
    for($c=0;$c<$length;$c++)
    	{ if($noDone[$c]!=100)
    		{
    			$countfee++;
    		}
    	}
    $pendingFee=$student_fee*$countfee;
    */
    //	echo($countfee."<br>");

  }
  return ( $pending_fee );
}

function alertredirect( $msg, $page ) {
  ?>
<script>alert('<?php echo $msg ?>');
  
window.location.href="<?php echo $page ?>";
    
</script>
<?php
}

function no_of_orders_inquiry( $inquiry_id ) {
  include( "config.php" );

  echo showQuery( "SELECT COUNT(*) FROM `order_dispatch_info` WHERE order_patient_id='$inquiry_id'" );
  ?>
<i title="Show All Orders"  onClick="window.open('view_orders.php?order_patient_id=<?php echo $inquiry_id ?>&limit=0&start_date=1980-01-01&end_date=<?php echo $date; ?>','height=200','width=200');" class="fa fa-dropbox text-info"></i>
<?php
}

function customer_feedback( $inquiry_id ) {
  include( "config.php" );
  echo showQuery( "SELECT COUNT(*) FROM `inquiry_status_history` WHERE type='Feedback' AND inquiry_id='$inquiry_id'" );
  ?>
<i title="Get Feedback"  onClick="window.open('view_feedback.php?order_patient_id=<?php echo $inquiry_id ?>','height=400','width=400');" class="fa fa-wechat text-info"></i>
<?php
}

function ifelse( $criteria, $true, $false ) {
  if ( $criteria ) {
    return ( $true );
  } else {

    return ( $false );
  }
}

function get_ledger_name_by_id( $ledger_id ) {
  include( "config.php" );
  return showQuery( "SELECT concat($ledger_id,' - ',account)  FROM `master_account` WHERE m_accountid='$ledger_id'" );

}
function get_next_patient_id()
{
    return showQuery("SELECT
 concat('P-', SUBSTRING_INDEX(MAX(SUBSTRING_INDEX(patient_id, '-', -1) + 1), '[^0-9]', 1))
FROM inquiry;");
}

function get_order_total_courier_charges($order_id)
{
    return showQuery("SELECT (courier_cost+fuel_adjustment+fuel_surcharge+fuel_factor+gst_amount+hnd_oth_charges+price_adjustment+cmi_charges+insurance_charges+other_charges)-discount AS 'total_service_charges' FROM `order_dispatch_info` WHERE order_id='$order_id'");
}
function check_accounts_access( $email ) {
  $x = $email;
  if(exists_in_db("SELECT * FROM `menu_user_permissions` WHERE user_id IN(SELECT id FROM `user` WHERE email='$x') AND menu_id='96'")) {
    return true;
  } else {
    return false;
  }

}
function order_status_dd( $sel, $enable_parent ) {
  include( 'config.php' );
  $sql = "SELECT DISTINCT parent FROM `order_status` WHERE parent NOT IN ('Preorder','Final Stage') ORDER BY sort";
  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Any Status</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option  style="font-weight: 900; background-color: silver;"  <?php if($row[0]==$sel) echo'selected'; if(!$enable_parent) echo'disabled'; ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
$sql1 = "SELECT order_status,description,color FROM `order_status` WHERE parent='$row[0]' ORDER BY sort";

$query1 = mysqli_query( $con, $sql1 );
while ( $row1 = mysqli_fetch_array( $query1 ) ) {
  ?>
<option title="<?php echo $row1[1] ?>"  <?php if($row1[0]==$sel) echo'selected'; ?> style="background-color: <?php echo $row1['color']; ?>" value="<?php echo $row1[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1[0]; ?></option>
<?php
}
}
}function order_status_dd_processing( $sel, $enable_parent ) {
  include( 'config.php' );
  $sql = "SELECT DISTINCT parent FROM `order_status` WHERE parent  IN ('Processing') ORDER BY sort";
  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Any Status</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option  style="font-weight: 900; background-color: silver;"  <?php if($row[0]==$sel) echo'selected'; if(!$enable_parent) echo'disabled'; ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
$sql1 = "SELECT order_status,description,color FROM `order_status` WHERE parent='$row[0]' ORDER BY sort";

$query1 = mysqli_query( $con, $sql1 );
while ( $row1 = mysqli_fetch_array( $query1 ) ) {
  ?>
<option title="<?php echo $row1[1] ?>"  <?php if($row1[0]==$sel) echo'selected'; ?> style="background-color: <?php echo $row1['color']; ?>" value="<?php echo $row1[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1[0]; ?></option>
<?php
}
}
}
function order_status_dd_accounts( $sel, $enable_parent ) {
  include( 'config.php' );
  $sql = "SELECT DISTINCT parent FROM `order_status` WHERE parent NOT IN ('Preorder') ORDER BY sort";
  $query = mysqli_query( $con, $sql );
  ?>
<option value="">Any Status</option>
<?php
while ( $row = mysqli_fetch_array( $query ) ) {
  ?>
<option  style="font-weight: 900; background-color: silver;"  <?php if($row[0]==$sel) echo'selected'; if(!$enable_parent) echo'disabled'; ?> value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
$sql1 = "SELECT order_status,description,color FROM `order_status` WHERE parent='$row[0]' ORDER BY sort";

$query1 = mysqli_query( $con, $sql1 );
while ( $row1 = mysqli_fetch_array( $query1 ) ) {
  ?>
<option title="<?php echo $row1[1] ?>"  <?php if($row1[0]==$sel) echo'selected'; ?> style="background-color: <?php echo $row1['color']; ?>" value="<?php echo $row1[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row1[0]; ?></option>
<?php
}
}
}
?>
