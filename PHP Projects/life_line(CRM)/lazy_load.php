<?php
//include( "config.php" );
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
<?php include("preloader.php"); ?>
<?php
include "start.php";

$login_user = $_SESSION[ 'email' ];


?>
</div>
<head>
    <title>Lazy Loading Example - Table</title>
  
</head>
<body>
    <div class="content-wrapper" >
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="col-lg-12">
          <?php
      include( "view_inquiry_all_tabs.php" );
      include( "fix_header.php" );

      ?>
        <tr>
            <th style="width: 100px;">Actions</th>
            <th>ID</th>
            <th>Seller</th>
            <th>Source</th>
            <th>Name</th>
            <th>Mobile1</th>
            <th>Mobile2</th>
            <th>Whatsapp</th>
            <th style="width: 80px;">Call Status</th>
            <th style="width: 80px;">Called At</th>
            <th style="width: 100px;">Recall Date</th>
            <th style="width: 100px;">Order Status</th>
        </tr>
    </table>
  </div>
  </div>
</div>
</div>
    <script>
        let page = 1; // Current page number
        let isLoading = false; // To prevent multiple simultaneous AJAX requests

        function loadRecords() {
            if (isLoading) return;

            isLoading = true;

            // Make an AJAX request to fetch the next page of records
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const recordsTable = document.getElementById("employee_data");
                    recordsTable.innerHTML += xhr.responseText;
                    isLoading = false;
                }
            };

            xhr.open("GET", `load_records.php?page=${page}`, true);
            xhr.send();

            page++; // Increment the page number for the next request
        }

        // Load initial records on page load
        loadRecords();

        // Add event listener to detect when the user scrolls to the bottom of the page
        window.addEventListener("scroll", function () {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                loadRecords();
            }
        });
    </script>
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
