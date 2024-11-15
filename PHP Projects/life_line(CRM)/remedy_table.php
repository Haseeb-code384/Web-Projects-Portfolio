          <?php include("fix_header.php"); ?>
                <tr align="center" class="h6">
                <th>Remedy#</th>
                <th>Potency Variations</th>
                <th>Formula</th>
                <th>Description</th>
                <th>Type</th>
                <th>Recomended</th>
                <th>Potency</th>
                <th>Unit</th>
                <th>Formula Type</th>
                <th>Formula Form</th>
                <th>Author</th>
                </tr>
                </thead>
            <tbody>
                <?php
                $sql_formula="SELECT * FROM `medicine_formula` WHERE rubric_id='$id' order by remedy_no asc";
                $query_formula=mysqli_query($con,$sql_formula);
                $previous_id="";
                while($row_formula=mysqli_fetch_array($query_formula))
                {
                 ?> 
            
  <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white')"  style="background-color: <?php echo $row_color; ?>;" >
                 <?php   if($previous_id!=$row_formula['remedy_no'])
                    {
                $previous_id=$row_formula['remedy_no'];   
                        ?>
                
                <td align="center" valign="middle" rowspan="<?php echo showQuery("SELECT count(*) FROM `medicine_formula` WHERE rubric_id='$id' AND remedy_no='$previous_id'"); ?>">Remedy <?php echo $row_formula['remedy_no']; ?></td>
                 <td rowspan="<?php echo showQuery("SELECT count(*) FROM `medicine_formula` WHERE rubric_id='$id' AND remedy_no='$previous_id'"); ?>">
                    <?php 
                     $var_query= mysqli_query($con,"SELECT variation_potency FROM medicine_rubric_variation WHERE rubrik_id='$id' AND formula_number='$previous_id'");
                     while($row_variation=mysqli_fetch_array($var_query))
                        { ?>
                      <a onClick="return this.style.display='none'; confirm('Do You Really Want To Delete <?php echo $row_variation[0]; ?> ? ')" target="new" href="<?php echo "del.php?delete_formula_variation=$row_variation[0]&rubric_id=$id&formula_number=$previous_id";  ?>" title="Delete <?php echo $row_variation[0]; ?>"><i class="fa text-danger fa-times-circle-o">
                          <span style="color: black;">
                       <?php  echo $row_variation[0] ?> </span>   </i></a>
                     
                 
                     <?php } ?>
                </td>
                <?php
                    }
                ?>
                <td><a  onClick="return confirm('Do You Really Want To Delete This Remedy?');" href="<?php echo "del.php?delete_formula=$row_formula[0]&page=$currentPage?id=$id";  ?>" title="Delete"><i class="fa text-danger fa-trash"></i></a>
                    <?php echo $row_formula[1]; ?></td>
                <td><?php echo $row_formula[2]; ?></td>
                <td><?php echo $row_formula[5]; ?></td>
                <td>
                    <input type="checkbox" onClick="window.open('formula_set_recomended.php?formula=<?php echo $row_formula[0]; ?>', 'Update List', 'width=1,height=1')" <?php echo ($row_formula[4] === 'Yes') ? 'checked' : '';  ?>>
                </td>
                
                <td><?php echo $row_formula[6]; ?></td>
                <td><?php echo $row_formula[7]; ?></td>
                <td><?php echo $row_formula[8]; ?></td>
                <td><?php echo $row_formula[9]; ?></td>
                <td><?php echo $row_formula[10]; ?></td>
               
            </tr>
                <?php } ?>
            </tbody>
                </table>
    </div>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>