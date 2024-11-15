<?php 
include("config.php");
include("allFunctions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Linear Flowchart</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 95%;
        margin: 50px auto;
    }
    .flowchart {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .flowchart-box {
        width: 12%;
        text-align: center;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        font-weight: bolder;
    }
    .arrow {
        width: 20px;
        height: 20px;
        border: solid black;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
    }
    .arrow-right {
        transform: rotate(-45deg);
        margin-right: 20px;
    }
    .arrow-left {
        transform: rotate(135deg);
        margin-left: 20px;
    }
</style>
</head>
<body>
<div class="container">
    <h1 align="center">Order Id <?php echo $_REQUEST['order_id']; ?></h1>
    <h4 align="center"> <?php echo showQuery("SELECT courier_company FROM `order_dispatch_info` WHERE order_id='$_REQUEST[order_id]'");  ?></h4>
    <div class="flowchart">
        <?php 
        $sql="SELECT DISTINCT status FROM `m_account_detail` WHERE status!='' ORDER by status='Dispatched' DESC,status='Consultency Fee' DESC";
        $query=mysqli_query($con,$sql);
        $norows=mysqli_num_rows($query);
        $i=1;
        while($row=mysqli_fetch_array($query))
        {
            $amount=showQuery("SELECT amount FROM `m_account_detail` WHERE type='$_REQUEST[order_id]' AND STATUS='$row[0]'");
        ?>
        <div class="flowchart-box" style="background-color: <?php echo ($amount != '') ? 'rgb(102, 204, 0);' : ''; ?>"><?php echo $row[0]."<br><br>$amount  "; ?></div>
        <?php 
            if($i<$norows)
            {
            ?>
        <div class="arrow arrow-right"></div>
        <?php }  $i++; 
            
        } 
        if(exists_in_db("SELECT order_id FROM `order_dispatch_info` WHERE finished!='' AND order_id='$_REQUEST[order_id]';"))
        { ?>
        
        <div class="arrow arrow-right"></div>
        <div class="flowchart-box" style="background-color: black; color:white;">Finished</div>
        
        <?php
            
        }
        
        ?>
        
       
    </div>
    <br>
<!--
    <center>
    <button style="height: 150px; width: 300px; font-size: 42pt;background-color: yellowgreen;">Set Finished</button></center>
-->
    <br>
    <table border="1" width="100%" style="font-size: smaller;">
    <tr style="color: white;background-color: black;">
        <th>TR ID</th>
        <th>Ledger</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Voucher#</th>
        <th>Entered By</th>
        <th>Type</th>
        <th>Entered At</th>
        <th>User Verified</th>
        <th>Admin Verified</th>
        <th>Stage</th>
        <th>Order Date</th>
        </tr>
        <?php
        $sql_acc="SELECT * FROM `m_account_detail` WHERE type='$_REQUEST[order_id]'";
        $query_acc=mysqli_query($con,$sql_acc);
        while($row_acc=mysqli_fetch_array($query_acc))
              {
        ?>
        <tr align="center">
        <td><?php echo $row_acc['sno']; ?></td>
        <td><?php echo get_ledger_name_by_id($row_acc['m_accountid']); ?></td>
        <td><?php echo change_date_ddmmyyy( $row_acc['tr_date']); ?></td>
        <td><?php echo $row_acc['amount']; ?></td>
        <td><?php echo $row_acc['tr_description']; ?></td>
        <td><?php echo $row_acc['invno']; ?></td>
        <td><?php echo $row_acc['entered_by']; ?></td>
        <td><?php echo $row_acc['info']; ?></td>
        <td><?php echo change_datetime_ddmmyyyhis( $row_acc['timestamp']); ?></td>
        <td><?php echo $row_acc['user_verified']; ?></td>
        <td><?php echo $row_acc['admin_verified']; ?></td>
        <td><?php echo $row_acc['status']; ?></td>
        <td><?php echo change_date_ddmmyyy( $row_acc['order_date']); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
