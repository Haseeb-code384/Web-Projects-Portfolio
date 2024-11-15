<?php session_start();
include("../config.php");
include("../allFunctions.php");
$crdr = $_REQUEST['crdr'];
$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];
$ledgers="754,758,759,776,761,762,764,766,781,778,780";
$account_id = [754,758,759,776,761,762,764,766,781,778,780];
//$account_head = $_REQUEST['account_head'];
//$area_id = $_REQUEST['area_id'];
$grand_closing=0;
?>
<!DOCTYPE html>
<html>
<head>
    
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<title></title>


<style type="text/css">
	

	
.special_column th{
	 font-family: Jameel Noori Nastaleeq Regular;
	font-weight: bolder;
    font-size: 150%;

}

.vl {
	border-left: 3px solid red;
    height: 40px;
}


.special_border{

	height: 35px;

}

.class_bold td{
	text-align: right;
	width: 60%; margin-left: 34%;
}

tr td span{

	column-span: all;
}


</style><style>
.collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;
}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
</style>
</head>
<body>
    <table style="margin-left: 10%;">
	<tbody>
		<tr>
<td>
					<h3>
					Al Hafiz Villas Report
				</h3>
			</td>
		</td>
		
	</tr>
	<tr>
		<td><strong>FROM : </strong> <?php echo change_date_ddmmyyy($date_start); ?>  </td>
		<td></td>
		<td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;"> . </td>
		<td></td>
		<td><strong>To : </strong> <?php echo change_date_ddmmyyy($date_end); ?>  </td>
	</tr>
	</table>
    <?php for($x=0;$x<count($account_id);$x++) 
{
    ?>
    
<button type="button" class="collapsible"><h3>
<?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id[$x]"); ?></h3>
    
   </button>
    <div class="content">
 
<table  style="margin-left: 10%; width: 85%;" border="1">
	<thead>
        <tr>
        <th colspan="11"><?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id[$x]"); ?></th>
        </tr>
    
		<tr align="center">
            <th width="20">#</th>
		<th width="80">Date</th>
		<th  width="40"> VC# </th>
		<th  width="40"> Type </th>
		<th  width="400"> Description </th>
		<th  width="40"> Debit</th>
		<th  width="40"> Credit </th>
		<th  width="5%" colspan="2"> Balance</th>
		<th  width="5%" colspan="2"> Verify</th>
		
	</tr>
        </thead>
	<tr>
		
	<th colspan="5"></th>
		<th colspan="2">Previous Balance</th>
		
		<th><?php $accumulated_bal=accumulated_bal($account_id[$x],$date_start); 
			echo abs($accumulated_bal);
			?></th>
		<td>
			<?php
				if($accumulated_bal>0)
				{
					echo "Dr";
				}
				elseif($accumulated_bal==0)
				{
					echo "Nil";
				}
			else
			{
				echo "Cr";
			} ?>
		</td>
	</tr>
		<?php
		$sql="SELECT tr_date,amount,type,tr_description,invno,info,user_verified,admin_verified,entered_by,sno FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end'   order by tr_date ASC";
	
		$query=mysqli_query($con,$sql);
		$sum1=0;
    $i=1;
		while($row=mysqli_fetch_array($query))
		{
		?>
		<tr align="center" title="Entered By: <?php echo $row['entered_by']; ?> TID: <?php echo $row['sno']; ?>">
		<td><?php echo $i++; ?></td>
		<td><?php echo change_date_ddmmyyy($row[0]);?></td>
			
		<td><?php echo $row[4];?></td>
			<td><?php echo showQuery("SELECT type FROM `daily_voucher` WHERE id='$row[4]'");
                 echo ifelse( $row[ 'user_verified' ] != '', " <i class='fa fa-user'></i>", "" );
        echo ifelse( $row[ 'admin_verified' ] != '', " <i class='fa fa-check-circle-o'></i>", "" );
                ?></td>
		<td><?php echo ucwords($row[3]);?></td>
			<?php if($row[5]=='Dr')
		{
			?>
		<td><?php  $sum1=$sum1+$row[1]; echo $row[1]?></td>
		<td></td>
<?php }
			else
			{
			?>
		<td></td>	
		<td><?php $sum1=$sum1-$row[1]; echo $row[1]?></td>
		
			<?php } ?>
			<td align="center"><?php echo abs($sum1);?></td>
			<td width="5">
			<?php
				if($sum1>0)
				{
					echo "Dr";
				}
				elseif($sum1==0)
				{
					echo "Nil";
				}
			else
			{
				echo "Cr";
			}
				?></td>
			<td width="5%" style="border: none;"><button><a title="View Voucher" target="new" href="../view_dailyvoucher.php?id=<?php echo $row[4];?>">>></button></a></td>
                <td width="5%" style="border: none;">
     
            <?php
        
       if( $row[ 'admin_verified' ] == "")
      {
      ?>
          <i onClick="window.open('../accounts_process_admin_verification.php?<?php echo "t_id=$row[sno]&user=$_SESSION[email]" ?>', 'Update List', 'width=1,height=1'); this.classList.remove('fa-square-o');this.classList.add('fa-check-square-o'); document.getElementById('box<?php echo $i; ?>').innerHTML='<?php echo $currentDateTime; ?>'; this.style.visibility='hidden'" class="fa fa-2x fa-square-o text-primary"></i>
        <?php    
      }
        ?>
    
      </td>
			
		</tr>
		<?php  } ?>
	<tr>
	<th colspan="5">Totals</th>
	<th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Dr'") ?></th>
	<th><?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Cr'") ?></th>
	<th colspan="2"><?php $closing_bal= showQuery("SELECT (SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Dr')-(SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Cr') ");
    $grand_closing=$grand_closing+($closing_bal);
        echo $closing_bal;
        ?></th>
	</tr>
		
</table>
    </div>
    <table   class="collapsible">	<tr>
	<th width="25%">Totals</th>
	<th  width="25%"> Dr = <?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Dr'") ?></th>
	<th  width="25%">Cr = <?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid='$account_id[$x]' and tr_date between '$date_start' and '$date_end' and info='Cr'") ?></th>
	<th  width="25%">Closing Balance = <?php  echo $closing_bal; ?></th>
	</tr>
		</table>
      <br>
    <?php } ?>
    <h3 align="center">Grand Total</h3>
   <table   class="collapsible">	<tr>
	<th width="25%">Grand Total</th>
	<th  width="25%"> Dr = <?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid IN($ledgers)  and tr_date between '$date_start' and '$date_end' and info='Dr'") ?></th>
	<th  width="25%">Cr = <?php echo showQuery("SELECT sum(amount) FROM `m_account_detail` WHERE m_accountid IN($ledgers) and tr_date between '$date_start' and '$date_end' and info='Cr'") ?></th>
	<th  width="25%">Closing Balance = <?php  echo $grand_closing; ?></th>
	</tr>
		</table>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
</body>
</html>