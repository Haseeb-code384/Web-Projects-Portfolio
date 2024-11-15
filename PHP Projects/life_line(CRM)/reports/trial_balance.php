<?php session_start();
if(!isset($_SESSION['email']))
{
    header("Location: ../logout.php");
}
include("../config.php");
include("../allFunctions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trial Balance</title>
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
            <h1>Trial Balance</h1>
            <p>As of <?php echo date('F,d Y') ?></p>
        </div>

        <table border="1">
            <thead>
                <tr>
                    <th>Account Title</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    $sumdr=0;
                    $sumcr=0;
                if(check_admin($_SESSION['email']))
                {
                    $sql="SELECT m_accountid,account FROM `master_account`  order BY accounttype ASC";
                }
                else
                {
                    $sql="SELECT m_accountid,account FROM `master_account` WHERE  m_accountid IN(SELECT account_id FROM `m_account_permission` WHERE username='$_SESSION[email]') order BY accounttype ASC";
                }
                $query=mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($query))
                {
                    $bal=0;
                ?>
                <tr>
                    <td><?php echo $row['account']; ?></td>
                    <td align='center'><?php $bal= accumulated_bal($row[0],$date);
                    if($bal<0)
                    {
                           echo "</td><td align='center'>".getNonNegativeValue($bal); 
                        $sumcr+=getNonNegativeValue($bal);
                     
                    }elseif($bal==0)
                    {
                        echo "</td><td align='center'>";
                    }
                    else
                    {
                           echo getNonNegativeValue($bal)."</td><td align='center'>"; 
                        $sumdr+=getNonNegativeValue($bal);
                     
                    }
                        ?></td>
                    
                </tr>
               <?php } ?>
                <tr class="total-row">
                    <td>Totals</td>
                    <td><?php echo getNonNegativeValue($sumdr); ?></td>
                    
                       <td><?php echo getNonNegativeValue($sumcr); ?></td>
                 
                    
                </tr> 
                <tr class="total-row">
                    <td>Assets/Liabilites</td>
                    <td><?php echo getNonNegativeValue($sumdr)-getNonNegativeValue($sumcr); ?></td>
                    
                 
                    
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
