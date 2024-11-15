<?php
include( "config.php" );
include( "allFunctions.php" );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
    
</head>
<body>
<?php
include "start.php";

$login_user = $_SESSION[ 'email' ];
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="col-lg-12">
 <?php //include("products_tabs.php"); ?>
        
     <?php include("fix_header.php"); ?>
				
            <tr>
              <th>mother_medicine</th>
              <th>medicine_potency</th>
              <th>medicine_form</th>
              <th>quantity</th>
              <th>location</th>
              <th>Actions</th>
                    

            </tr>
          </thead>
          <tbody class="small">
            <?php
              
 
$sqlview="SELECT * FROM `medicine_stock`";
              
          
            $queryview = mysqli_query( $con, $sqlview );
            while ( $rowview = mysqli_fetch_array( $queryview ) ) {
              ?>
            <tr>
              <td><?php echo $rowview[0]; ?></td>
              <td><?php echo $rowview[1]; ?></td>
              <td><?php echo $rowview[2]; ?></td>
              <td><?php echo $rowview[3]; ?></td>
              <td><?php echo $rowview[4]; ?></td>
            
                
              <td>
                  
<!--
                <a href="edit_product.php?id=<?php echo $rowview[0]; ?>">
                <button class="btn-sm btn-success" title="Update Product"><i class="fa fa-pencil"></i></button>
                </a>
                  <button onClick="window.open('#.phpid=<?php echo $rowview[0]; ?>','height=100','width=100');" class="btn-sm btn-primary" title="Inventory History"><i class="fa fa-history"></i></button>
                  
                  <a href="#.php?id=<?php echo $rowview[0]; ?>">
                <button class="btn-sm btn-info" title="Add or Remove Inventory"><i class="fa fa-check-circle"></i></button>
                </a>
-->
                  
                </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<script src="vendor/jquery/jquery.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="vendor/datatables/jquery.dataTables.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</body>
</html>