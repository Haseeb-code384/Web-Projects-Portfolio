<?php 
include("config.php");
include("allFunctions.php");
$formula=$_REQUEST['formula'];
$current_value=showQuery("SELECT recomended FROM `medicine_formula` WHERE id='$formula'");
if($current_value=="Yes")
{
    echo "Yes";
executeQuery("UPDATE `medicine_formula` SET `recomended` = NULL WHERE `medicine_formula`.`id` = '$formula';");
}
else
{
 echo "null";   
executeQuery("UPDATE `medicine_formula` SET `recomended` = 'Yes' WHERE `medicine_formula`.`id` = '$formula';");
}
?>
<script>
window.close();
</script>