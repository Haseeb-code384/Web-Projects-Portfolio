 <?php include ("includes/footer.php")?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded bg-danger" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
<?php
  $currentPage = basename($_SERVER['PHP_SELF']);

  if ($currentPage === 'manage_rubric.php') {
   // echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
  } 
else if($currentPage === 'edit_rubric.php')
{
    
}else if($currentPage === 'manage_product_inventory.php')
{
    
}
else {
    echo '<script src="vendor/jquery/jquery.min.js"></script>';
  }
?>

<!--    <script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

</div>
   <script>
        // Click event to toggle the dropdown menu
        $("#notification-trigger").click(function () {
            $(".dropdown-menu").toggleClass("show");
        });
    </script>
</body>
</html>
