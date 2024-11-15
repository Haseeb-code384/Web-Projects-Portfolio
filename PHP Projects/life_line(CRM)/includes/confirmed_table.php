 <tr>
              <th>ID</th>
              <th>Seller</th>
              <th>Actions</th>
              <th>Source</th>
              <th>Name</th>
              <th>Mobile1</th>
              <th>Mobile2</th>
              <th>Whatsapp</th>
              <th>Call Status</th>
              <th>Called At</th>
              <th>Recall Date</th>
              <th>Order Status</th>
              <th>Allocation Date</th>
              <th>Agree Date</th>
              <th>Diseases</th>
            </tr>
          </thead>
          <tbody>
            <?php
           
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
              <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  style="background-color: <?php echo showQuery("SELECT color FROM `status_list` WHERE status_name='$rowview[call_status]'") ?>; " >
              <td><input type="checkbox"><?php echo $rowview[0]; ?></td>
              <td title="<?php echo $rowview[23] ?>"><?php echo substr($rowview[23],0,5); ?>...</td>
              <td align="center"><i title="More Info" onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=100','width=100');" class="fa fa-info-circle text-primary"></i>
                <i title="Prescribe" onClick="window.open('prescribe.php?id=<?php echo $rowview[0]; ?>','height=100','width=100');" class="fa fa-user-md text-success"></i>  
<!--                  <i title="Order Form" onClick="window.open('add_order_form.php?p_id=<?php echo $rowview[0]; ?>','height=100','width=100');" class="fa fa-id-card-o text-danger"></i>-->
                </td>
              <td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
              <td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
              <td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
              <td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
              <td ><?php echo $rowview[14]; ?></td>
              <td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
              <td title="<?php echo change_datetime_ddmmyyyhis($rowview[17]); ?>"><?php echo substr(change_date_ddmmyyy($rowview[17]),0,10); ?>...</td>
              <td  title="<?php echo change_datetime_ddmmyyyhis($rowview[18]); ?>"><?php echo change_date_ddmmyyy($rowview[18]); ?></td>
              <td style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$rowview[order_status]'") ?>;" title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
              <td title="<?php echo change_datetime_ddmmyyyhis($rowview['allocated_at']); ?>"><?php echo substr(change_date_ddmmyyy($rowview['allocated_at']),0,10); ?>...</td>
              <td title="<?php echo change_datetime_ddmmyyyhis($rowview['order_time']); ?>"><?php echo substr( change_date_ddmmyyy( $rowview['order_time']),0,10); ?></td>
              <td style="background-color: <?php echo $rowview['diseases_color']; ?>" title="<?php echo $rowview['diseases']; ?>"><?php echo substr($rowview['diseases'],0,10); ?>..</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>