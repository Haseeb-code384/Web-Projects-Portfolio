<?php 


?>
<footer class="sticky-footer" style="z-index: 33;  position: fixed;
  bottom: 0;
  width: 100%; height: 52px;">
    <div class="container">
        <div class="text-center">
            <small>Proudly Developed By WM Tech© +923006029757    <span  style="float: right; font-size: 7pt;"><?php $files1 = scandir("../");
  
echo "Updated ".  timeAgo(date("Y-m-d H:i:s", filemtime($files1[0])));?>
       
        </span></small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded"  style="z-index: 33;" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
  <?php 
//$permission=showQuery("SELECT * FROM `menu_user_permissions` WHERE user_id=(SELECT id FROM `user` WHERE email='$_SESSION[email]') AND menu_id = (SELECT menu_id FROM `menu` WHERE link='$currentPage')");
//if($permission=="")
//{
//    //alertredirect("You Dont Have Permission For This Page","logout.php");
//}
?>
