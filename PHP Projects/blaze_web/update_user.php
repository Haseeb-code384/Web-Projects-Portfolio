<?php

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
if ( $_SERVER["REQUEST_METHOD"] === "POST"){

    // To clean the data for any harm we use these functions 
    function clean_input($field){
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }
// Assign form field values to variables and also apply clean function
    $id = clean_input($_POST['user_id']); // Required
    $name = clean_input($_POST['name']); // Required
    $email = clean_input($_POST['email']); // Required
    // $password = clean_input($_POST['password']);
    $country = clean_input($_POST['country']); // Required



    

    if(isset($name) && $name != "" && isset($email) && $email != "" 
    && /* isset($password) && $password != "" && */ isset($country) && $country != "" ){

        // For updating the form
        $sql = "UPDATE users SET user_name = '$name', user_email ='$email' , /* user_password ='$password', */
         user_country ='$country' WHERE user_id = $id";


        if($connection -> query($sql)=== TRUE){
            echo "Record has been updated successfully";
        }
        else{
            echo "There was an error: ". $connection->error;
        }
        $connection->close();

    }else{
        echo "You must fill all the required fields having * sign.";
    }
}else{
    echo "Please Submit the Form";

}

?>