<?php 

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
    die("NO valid User Found!  " . '<a href="http://localhost/blaze_web/user.php">Go Back</a>');
}

?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax User Detail</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet-css/style.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body> -->
<div class="user-detail">
    
    <div class="form-row">
        <input type="text" id="name" name="name" placeholder="Full Name *" value="<?php echo $user_name ?>">
    </div>
    <div class="form-row">
        <input type="text" id="email" name="email" placeholder="Email Address *" value="<?php echo $user_email ?>">
    </div>
    <div class="form-row">
        <select name="country" id="country">
            <option value="<?php echo $user_country ?>"><?php echo $user_country ?></option>
            <option value="pk">Pakistan</option>
            <option value="in">India</option>
            <option value="us">United States</option>
        </select>
    </div>
    <div id="updateResponse" class="response-row">

    </div>
    <div class="form-row">
        <button class="signup-btn" onclick="updateUser(<?php echo $user_id ?>)">Update User</button>
    </div>
</div>
