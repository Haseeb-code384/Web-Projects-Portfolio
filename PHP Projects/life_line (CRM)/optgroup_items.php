<?php
include ("config.php");
?>


		   <option value="">Click Here to search</option>
          <?php
               $sql = "SELECT 1";
                $result = mysqli_query($con, $sql);
                  while($row = mysqli_fetch_array($result)) { ?>
               
          <optgroup label="">
<?php 
		$sql2="SELECT DISTINCT category FROM `ospos_items` ORDER BY category";
			$query2=mysqli_query($con,$sql2);
			while($row2=mysqli_fetch_array($query2))
			{
				
			  ?>
            <optgroup label="&nbsp;&nbsp;&nbsp; <?php echo $row2[0]; ?>">
			<?php
				 $sql3="SELECT item_id,name,unit_price FROM `ospos_items` WHERE category='$row2[0]' and deleted=0";
			
			$query3=mysqli_query($con,$sql3);
			while($row3=mysqli_fetch_array($query3))
			{
				?>	
              <option value="<?php echo $row3[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row3[1] ?> | <?php echo $row3[2] ?> </option>
				<?php } ?>
            </optgroup>
			<?php 
			}
															 ?>
          </optgroup>
             <?php
                    }
                ?>
