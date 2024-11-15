<?php
// Ensure that the database connection is already established ($con)
include("config.php");
// If not, include your database connection code here.


// Sanitize the page number to prevent SQL injection
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Number of records to display per page
$recordsPerPage = 30;

// Calculate the starting record index for the current page
$startFrom = ($page - 1) * $recordsPerPage;

// Query to fetch records for the current page
$sql = "SELECT * FROM `inquiry` LIMIT $startFrom, $recordsPerPage";
$result = mysqli_query($con, $sql);

// Generate HTML table rows for the fetched records
while ($rowview = mysqli_fetch_array($result)) {
    ?>
 <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td style="display: inline;">
                                    <input type="checkbox">
                                    <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i>
                                    <i title="Status History" onClick="window.open('inquiry_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i>
                                    
                                    
                                    	<a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-volume-control-phone text-warning"></i></a>
                                    
                                    <a target="new" href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a>
                                    <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
                                </td>
								<td>
									
									<?php echo $rowview[0]; ?> </td>
								<td title="<?php echo $rowview[23] ?>"><?php echo substr($rowview[23],0,5); ?>...</td>
								<td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
								<td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
								<td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
								<td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
													<td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
                                <td title="<?php echo $rowview[17]; ?>"><?php echo substr($rowview[17],0,10); ?>...</td>
		   <td title="<?php echo $rowview[18]; ?>"><?php echo $rowview[18]; ?></td>
		   <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
		
								
								
								

							</tr>
<?php
}

// Close the database connection and exit the script
mysqli_close($con);
exit();
?>

							