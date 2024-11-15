<?php
include( "../config.php" );
include( "../allFunctions.php" );
$crdr = $_REQUEST[ 'crdr' ];
$date_start = $_REQUEST[ 'date_start' ];
$date_end = $_REQUEST[ 'date_end' ];
$account_id = $_REQUEST[ 'account_id' ];
if($_REQUEST['account_id']=="")
{
    alertredirect("Please Select Account","../report-panel.php");
}
if($_REQUEST['date_start']=="")
{
    alertredirect("Please Select date_start","../report-panel.php");
}
if($_REQUEST['date_end']=="")
{
    alertredirect("Please Select date_end","../report-panel.php");
}
//$account_head = $_REQUEST['account_head'];
//$area_id = $_REQUEST['area_id'];

?>
<!DOCTYPE html>
<html>
<head>
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<title></title>
<style>
thead {
    position: sticky;
    top: 0;
}
</style>
<style type="text/css">
.special_column th 
    {
    font-family: Jameel Noori Nastaleeq Regular;
    font-weight: bolder;
    font-size: 150%;
}
.vl {
    border-left: 3px solid red;
    height: 40px;
}
.special_border {
    height: 35px;
}
.class_bold td {
    text-align: right;
    width: 60%;
    margin-left: 34%;
}
tr td span {
    column-span: all;
}
</style>
</head>
<body>
<table style="margin-left: 10%;">
<tbody>
  <tr>
    <td><h3> <b>Ledger Report </b><br>
        <b> (<?php echo $account_id.") "; echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id"); ?></b><br>
      </h3></td>
    </td>
    <td></td>
    <td><?php include ('logo.php');?>
<br>
</td>
<td></td>
</tr>
<tr>
  <td><strong>FROM :</strong><?php echo change_date_ddmmyyy($date_start); ?></td>
  <td></td>
  <td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;">.</td>
  <td></td>
  <td><strong>To :</strong><?php echo change_date_ddmmyyy($date_end); ?></td>
</tr>
<tr>
  <td><hr style="width: 450%; border: 1px solid black"></td>
</tr>
<tr>
  <td></td>
</tr>
</table>
<table  style="margin-left: 10%; width: 85%;" border="1">
  <thead style="background-color: black; color: white;">
    <tr align="center">
      <th width="20">#</th>
      <th width="100">Date</th>
      <th  width="40">VC#</th>
      <th  width="40">Type</th>
      <th  width="40">TR#</th>
      <th width="40">#</th>
      <th  width="500">Description</th>
      <th  width="40">Debit</th>
      <th  width="40">Credit</th>
      <th  width="5%" colspan="2">Balance</th>
    </tr>
    <tr>
      <th colspan="7"></th>
      <th colspan="2">Previous Balance</th>
      <th><?php
      $accumulated_bal = accumulated_bal( $account_id, $date_start );
      echo abs( $accumulated_bal );
      ?></th>
      <td><?php
      if ( $accumulated_bal > 0 ) {
        echo "Dr";
      } elseif ( $accumulated_bal == 0 ) {
        echo "Nil";
      }
      else {
        echo "Cr";
      }
      ?></td>
    </tr>
  </thead>
    
  <?php
    
  $pre_color = rand_color();
  $sql = "SELECT tr_date,amount,type,tr_description,invno,info,user_verified,admin_verified,entered_by,sno,status FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end'  AND user_verified!=''  order by type,tr_date ASC";
    if($account_id=="798"||$account_id=="799")
    {
        $sql = "SELECT tr_date,amount,type,tr_description,invno,info,user_verified,admin_verified,entered_by,sno,status FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end'  AND user_verified!='' AND admin_verified!=''  order by type,tr_date ASC";
    }

  $query = mysqli_query( $con, $sql );
  $sum1 = $accumulated_bal;
  $i = 1;
    $previous_order="";
    $count=0;
  while ( $row = mysqli_fetch_array( $query ) ) {
         if ( $previous_order != $row[ 2 ] ) {
      $previous_order = $row[ 2 ];
      $pre_color = rand_color();
             
             $count=0;
    }
      else
      {
          $count++;
      }
    
    ?>
  <tr  <?php echo ($count >= 3 && $row[2] != "") ? "bgcolor='red'" : ""; ?> align="center" title="Entered By: <?php echo $row['entered_by']; ?> TID: <?php echo $row['sno']; ?>">
    <td><?php echo $i++; ?></td>
    <td><?php echo change_date_ddmmyyy($row[0]);?></td>
    
    <td><?php echo $row[4];?></td>
    <td><?php echo showQuery ( "SELECT type FROM `daily_voucher` WHERE id='$row[4]'" );
    echo ifelse( $row[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
    echo ifelse( $row[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
    ?></td>
      <td><?php echo $row['sno'];?></td>
    <td style="background-color: <?php echo $pre_color; ?>"><?php echo $row[2]."<br>".$row['status'];?></td>
    <td><?php echo ucwords($row[3]);?></td>
    <?php
    if ( $row[ 5 ] == 'Dr' ) {
      ?>
    <td><?php  $sum1=$sum1+$row[1]; echo $row[1]?></td>
    <td></td>
    <?php
    } else {
      ?>
    <td></td>
    <td><?php $sum1=$sum1-$row[1]; echo round($row[1],2); ?></td>
    <?php } ?>
    <td align="center"><?php echo abs(round($sum1,2));?></td>
    <td width="5"><?php
    if ( $sum1 > 0 ) {
      echo "Dr";
    } elseif ( $sum1 == 0 ) {
      echo "Nil";
    }
    else {
      echo "Cr";
    }
    ?></td>
    <td width="5%" style="border: none;"><button>
      <a title="View Voucher" target="new" href="../view_dailyvoucher.php?id=<?php echo $row[4];?>">>>
      </button>
      </a></td>
  </tr>
  <?php  } ?>
  <tr>
    <th colspan="7">Totals</th>
    <th><?php echo showQuery("SELECT round(sum(amount),2) FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' and info='Dr'  AND user_verified!=''") ?></th>
    <th><?php echo showQuery("SELECT round(sum(amount),2) FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' and info='Cr'  AND user_verified!=''") ?></th>
    <th colspan="2"></th>
  </tr>
</table>
    <?php
 $sql_summary="SELECT status,count(type),sum(amount),month(order_date) FROM `m_account_detail` WHERE m_accountid='$account_id' and tr_date between '$date_start' and '$date_end'  AND user_verified!='' group by month(order_date),status ASC order by status='Dispatched' desc,status='Delivered' desc,status='Return Stock Received' desc,status='Paid Service Charges' desc,month(order_date) desc";
//       echo $sql_summary;
        $query_summary=mysqli_query($con,$sql_summary);
        
        $row_sum=mysqli_fetch_array($query_summary);
    if($row_sum[0]!='')
{
    ?>
    <center>
    <table width="40%" border="1">
    <tr>
        <th colspan="10">Summary</th>    
    </tr>
        <tr>
            <th>Status</th>
            <th>Count</th>
            <th>Amount</th>
        </tr>
        <?php
        $service_charges_count=0;
        $delivered_returned_count=0;
        $delivered_returned_amount=0;
        $service_charges=0;
        $delivered_amount=0;
        
         $query_summary=mysqli_query($con,$sql_summary);
        while($row_summary=mysqli_fetch_array($query_summary))
        {
        
        ?>
        <tr>
        <td><?php echo $row_summary[0]; ?>, <?php echo getMonthName($row_summary[3]);  ?></td>
        <td><?php echo $row_summary[1]; ?></td>
        <td><?php echo round($row_summary[2],2); ?></td>
   
        </tr>
        <?php
        if($row_summary[0]=="Delivered"||$row_summary[0]=="Return Stock Received")
        {
            if($row_summary[0]=="Delivered")
            {
                $delivered_amount=$delivered_amount+$row_summary[2];
            }
        $delivered_returned_count=$delivered_returned_count+$row_summary[1];
            $delivered_returned_amount=$delivered_returned_amount+$row_summary[2];
        }
              if($row_summary[0]=="Paid Service Charges"||$row_summary[0]=="Paid Return Service Charges")
        {
            $service_charges_count=$service_charges_count+$row_summary[1];
            $service_charges=$service_charges+$row_summary[2];
        }
        } ?>
        <tr bgcolor="black" style="color: white;">
        <td>(Delivered+Returned) - Paid Service Charges</td>
        <td>(<?php echo  $delivered_returned_count; ?>) - <?php echo  $service_charges_count; ?></td>
            <td><?php echo $delivered_returned_amount-$service_charges; ?></td>
        </tr>  
      
        <tr bgcolor="black" style="color: white;">
        <td align="center" colspan="2"><h3>Received Amount</h3></td>
              <?php
        if($account_id=="657")
        {
            ?>
            
            <td align="center"><h3><?php echo $delivered_amount; ?></h3></td>
            <?php
        }
        else
        {
        ?>
            <td align="center"><h3><?php echo $delivered_amount-$service_charges; ?></h3></td>
            <?php } ?>
        </tr>
        
    </table>
        </center>
    <?php
}
    ?>
    
</body>
</html>