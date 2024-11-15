<?php
include( "../config.php" );
include( "../allFunctions.php" );
?>
<!DOCTYPE html>
<html>
<head>
<title>Accounts Balance Sheet</title>
<style>
body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}
.container {
    width: 80%;
    margin: 0 auto;
    padding: 30px;
    background-color: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.header {
    text-align: center;
    margin-bottom: 30px;
}
.header h1 {
    font-size: 24px;
    font-weight: bold;
}
.header p {
    font-size: 16px;
    margin-top: 10px;
}
table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #ddd;
}
th, td {
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
    font-weight: bold;
}
.total-row {
    font-weight: bold;
    background-color: #eee;
}
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>Statement of Financial Position</h1>
    <p>As of <?php echo date("M d,Y",strtotime($date)); ?></p>
  </div>
  <?php
  $sum_head = 0;
  $sql_head = "SELECT * FROM `account_head` order by sort desc";
  $query_head = mysqli_query( $con, $sql_head );
  while ( $row_head = mysqli_fetch_array( $query_head ) ) {

    ?>
  <table border="1">
    <caption>
    <h2>Head - <?php echo $row_head['head_name'] ?></h2>
    </caption>
    <?php
    $sql_sub_head = "SELECT id,head_name,subhead_name FROM `account_subhead` WHERE head_name='$row_head[head_name]'";
    $query_sub_head = mysqli_query( $con, $sql_sub_head );
    while ( $row_sub_head = mysqli_fetch_array( $query_sub_head ) ) {

      ?>
    <tr>
      <td colspan="2" align="center"><center>
          Subhead - <?php echo $row_sub_head['subhead_name'] ?>
        </center></td>
    </tr>
    <tr>
      <th>Ledgers Under Subhead - <?php echo $row_sub_head['subhead_name'] ?></th>
      <th>Amount</th>
    </tr>
    <?php
    $sum_subhead = 0;
    $sql_sub_head_leadger = "SELECT m_accountid,account,accounttype FROM `master_account` WHERE accounttype='$row_sub_head[id]'";
    $querysub_head_leadger = mysqli_query( $con, $sql_sub_head_leadger );
    while ( $rowsub_head_leadger = mysqli_fetch_array( $querysub_head_leadger ) ) {

      ?>
    <tr>
      <td>(<?php echo  $rowsub_head_leadger['m_accountid'] ?>) <?php echo $rowsub_head_leadger['account'] ?></td>
      <td><?php
      $sum_subhead = $sum_subhead + accumulated_bal( $rowsub_head_leadger[ 'm_accountid' ], $date );
      echo accumulated_bal( $rowsub_head_leadger[ 'm_accountid' ], $date );

      ?></td>
    </tr>
    <?php } ?>
    <tr class="total-row">
      <td>Total <?php echo $row_sub_head['subhead_name'] ?></td>
      <td><?php echo $sum_subhead;
      $sum_head = $sum_head + $sum_subhead;
      ?></td>
    </tr>
    <?php } ?>
    <tr class="total-row" style="background-color: hotpink;">
      <td>Grand Total <?php echo $row_head['head_name'] ?></td>
      <td><?php echo $sum_head;
      //  $sum_head=$sum_head+$sum_subhead;
      ?></td>
    </tr>
  </table>
  <br>
  <br>
  <br>
  <?php } ?>
</div>
</body>
</html>
