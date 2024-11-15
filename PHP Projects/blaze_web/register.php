<?php 
require "templates/header.php";

require "data_base.php";

/*==============================
    Form Validation in PHP
================================*/

/*First of all you have to declare the variables when the 
form is submitted. If the Form is submitted then the code 
will run. To do this <<<< REQUEST Method >>>> will be used*/

// First declare the variables against all the form fields
$name = $email = $password = $country = $error = ""; 

// Now codition if the form is submitted by request method
if ( $_SERVER["REQUEST_METHOD"] == "POST"){

    // To clean the data for any harm we use these functions 
    function clean_input($field){
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }

    $name = clean_input($_POST['name']); // Required
    $email = clean_input($_POST['email']); // Required
    $password = clean_input($_POST['password']);
    $country = clean_input($_POST['country']); // Required


    

    if(isset($name) && $name != "" && isset($email) && $email != "" 
    && isset($password) && $password != "" && isset($country) && $country != "" ){

        // $sql = "INSERT INTO users(user_name, user_email, user_password, user_country)
        // VALUES('$name', '$email', '$password', '$country')";

        // Prepaired Queries -- IN this we pass the values into special function because of which the performance and security improve
        $stmt = $connection -> prepare("INSERT INTO users(user_name, user_email, user_password, user_country)
        VALUES(?, ?, ?, ?)");
        // ssss here is the data types of the values=> For string = s, boolean = b, integer = i, double = d
        $stmt -> bind_param("ssss", $name, $email, $password, $country);




?>
    <div class="wrap">

        <div class="alert">
        <?php
    if($stmt -> execute()=== TRUE){
            echo "Thank you for creating an account.";
        }
        else{
            echo "There was an error: ". $stmt->error;
        }
        $stmt->close();

    }else{
        echo "You must fill all the required fields having * sign.";
    }
}else{
    // echo "Please Submit the Form";

}
?>

        </div>
        <form action="register.php" method="post" class="signup-form">
            <div class="form-row">
                <input type="text" name="name" placeholder="Full Name *" >
            </div>
            <div class="form-row">
                <input type="email" name="email" placeholder="Email Address *" >
            </div>
            <div class="form-row">
                <input type="password"  name="password" placeholder="password*" >
            </div>
            <div class="form-row">
                <select name="country">
                    <option value="0">Select Country *</option>
                    <option value="pk">Pakistan</option>
                    <option value="in">India</option>
                    <option value="us">United States</option>
                </select>
            </div>
            
            <div class="form-row">
                <input type="submit" value="Signup Now" class="signup-btn">
                <input type="reset" value="Reset Form" class="reset-btn">
            </div>
            <div class="error-row">
                
            </div>
        </form>
    </div>
<?php 
require "templates/footer.php";

?>