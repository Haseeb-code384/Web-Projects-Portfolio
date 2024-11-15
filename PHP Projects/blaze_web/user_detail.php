<?php 
require "templates/header.php";
require "data_base.php";

if(isset($_GET["user_id"]) && $_GET["user_id"] != ""){
    $user_id = intval($_GET["user_id"]);
    $sql= "SELECT * FROM users WHERE user_id= $user_id";
    $result = $connection->query($sql);
    if($result -> num_rows > 0){
        while($row= $result -> fetch_assoc()){
            $user_name = $row["user_name"];
            $user_email = $row["user_email"];
            $user_password = $row["user_password"];
            $user_country = $row["user_country"];
        }

    }else{
        echo "No record found" . $connection -> error;
    }



}else{
    die("NO valid User Found!  ". '<a href="http://localhost/blaze_web/user.php">Go Back</a>');
}

?>
    <div class="wrap">

        <form action="update_user.php" method="post" class="signup-form">
            <input type="hidden" name="id" value="<?php echo $user_?>">
            <div class="form-row">
                <input type="text" name="name" placeholder="Full Name *" value="<?php echo $user_name?>">
            </div>
            <div class="form-row">
                <input type="email" name="email" placeholder="Email Address *" value="<?php echo $user_email?>">
            </div>
            <div class="form-row ">
                <input type="password" name="password" placeholder="password*" value="<?php echo $user_password?>">
            </div>
            <div class="form-row">
                <select name="country">
                    <option value="<?php echo $user_country?>"><?php echo $user_country?></option>
                    <option value="pk">Pakistan</option>
                    <option value="in">India</option>
                    <option value="us">United States</option>
                </select>
            </div>
            
            <div class="form-row">
                <input type="submit" value="Update User" class="signup-btn">
                <input type="reset" value="Reset Form" class="reset-btn">
            </div>
            <div class="error-row">
                
            </div>
        </form>
    </div>
<?php 
require "templates/footer.php";

?>