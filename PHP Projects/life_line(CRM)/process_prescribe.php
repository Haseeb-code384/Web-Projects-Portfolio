<?php
include("config.php");
include("allFunctions.php");
$id=$_REQUEST['id'];

    $product=$_REQUEST['product'];
    $quantity=$_REQUEST['quantity'];
    $comments=$_REQUEST['comments'];
$sql_pres="INSERT INTO `product_prescription` (`id`, `prescribed_product`, `prescribed_quantity`, `comments`, `inquiry_no`, `created_at`) VALUES (NULL, '$product', '$quantity', '$comments', '$id', '$currentDateTime')";
    executeQuery($sql_pres);
    $pg="prescribe.php?id=".$id;
    header("Location:".$pg);
    echo "<script>window.location.href='$pg'</script>";

?>