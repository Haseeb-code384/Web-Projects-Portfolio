<tr>
  <th style="width: 100px;">Actions</th>
  <th>ID</th>
  <th>Mobile</th>
  <th>Whatsapp</th>
  <th>Call Status</th>
  <th>Order Status</th>
  <th>Disease</th>
<!--  <th>Recall Date</th>-->
  <th>Called At</th>
  <th>Name</th>
  <th>Record Type</th>
  <th>Drive Link</th>
  <th>Total Orders</th>
  <th>Feedback Consultant</th>
</tr>
</thead>
<tbody>
  <?php
//   echo $sqlview;
  $queryview = mysqli_query( $con, $sqlview );
  while ( $rowview = mysqli_fetch_array( $queryview ) ) {
    $row_color = showQuery( "SELECT color FROM `status_list` WHERE status_name='$rowview[call_status]'" );
    ?>
  <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'<?php echo $row_color;?>')"  style="background-color: <?php echo $row_color; ?>;" >
    <td><input type="checkbox" name="emp[]" value="<?php echo $rowview[0]; ?>">
      <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <i title="Status History" onClick="window.open('inquiry_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i> <a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-volume-control-phone text-warning"></i></a> <a target="new" href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a>
      <?php

      if ( check_admin( $_SESSION[ 'email' ] ) ) {
        ?>
      <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
      <?php } ?></td>
    <td><?php echo $rowview[0]; ?>
      <?php
      $createdDate = new DateTime( $rowview[ 'created_at' ] );
      $dateToCompare = new DateTime( $date );
      $sixMonthsAgo = clone $dateToCompare;
      $sixMonthsAgo->modify( '-6 months' );
      if ( $createdDate >= $sixMonthsAgo && $createdDate <= $dateToCompare ) {
        ?>
      <img src="img/diamond.gif" style="width: 22px;">
      <?php
      } else {
        ?>
      <img src="img/gold.png" style="width: 22px;">
      <?php
      }
      ?></td>
    <td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; show_network_img($rowview[11]); ?><br><?php echo $rowview[12];  show_network_img($rowview[13]); ?></td>
    <td><?php echo $rowview[14];
    if ( $rowview[ 14 ] != "" ) {
      ?> <a title="Open WhatsApp" href="whatsapp_handler.php?number=<?php echo "$rowview[14]&inqury_id=$rowview[0]"; ?>" target="new" class="fa fa-whatsapp fa-2x text-success"></a>
      <?php
      }
      ?></td>
    <td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
    <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
    <td><?php echo showQuery("SELECT GROUP_CONCAT(disease) FROM `inquiry_disease` WHERE inquiry_id='$rowview[0]' GROUP BY inquiry_id") ?></td>
    
<!--
      <td title="<?php echo change_date_ddmmyyy($rowview['recall_date']) ?>"><?php echo substr(change_date_ddmmyyy($rowview['recall_date']),0,10); ?>...</td>
    
-->
      <td title="<?php echo change_datetime_ddmmyyyhis($rowview['called_at']) ?>"><?php echo substr(change_datetime_ddmmyyyhis($rowview['called_at']),0,10); ?>...</td>
    <td title="<?php echo $rowview['name'] ?>"><?php show_gender($rowview['gender']); ?><?php  echo substr($rowview['name'],0,5); ?>...</td>
    <td title="<?php echo $rowview['record_type'] ?>"><?php echo substr($rowview['record_type'],0,5); ?>...</td>
    <td title="<?php echo $rowview['google_drive_link'] ?>"><a href="<?php echo $rowview['google_drive_link'] ?>" target="new"><?php echo substr($rowview['google_drive_link'],0,5); ?>..</a></td>
    <td><?php no_of_orders_inquiry($rowview[0]) ?>
      <?php customer_feedback($rowview[0]); ?></td>
      
    <td title="<?php echo $rowview['feedback_consultant']; ?>"><?php echo $rowview['feedback_consultant']; ?></td>
  </tr>
  <?php } ?>
</tbody>
</table>
