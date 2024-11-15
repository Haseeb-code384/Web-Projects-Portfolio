<?php
include "db/db_con.php";
session_start();

$userName_error = "";
$email_error = "";
$password_error = "";

$userName = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $userName = $con->real_escape_string(trim($_POST['username']));
    $email = $con->real_escape_string(trim($_POST['email']));
    $password = $con->real_escape_string(trim($_POST['password']));

    // Validate Name (only alphabetic characters allowed)
    if (empty($userName)) {
        $userName_error = "Name is required!";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $userName)) {
        $userName_error = "Only letters and white space allowed in Name!";
    }

    // Validate Email (must be a valid email format)
    if (empty($email)) {
        $email_error = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format!";
    }

    // Validate Password (must not be empty)
    if (empty($password)) {
        $password_error = "Password is required!";
    }

    // Proceed if no validation errors
    if (empty($userName_error) && empty($email_error) && empty($password_error)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists
        $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
        $email_result = $con->query($check_email_sql);

        if ($email_result->num_rows > 0) {
            $email_error = "Error: Email ID already exists!";
        } else {
            // Insert the data into the database with a default role
            $default_role = 'pending';  // Default role until they choose at login
            $sql = "INSERT INTO users (username, email, password, role, created_at) 
                    VALUES ('$userName', '$email', '$hashed_password', '$default_role', NOW())";

if ($con->query($sql) === TRUE) {
    // Set session variable for success message
    $_SESSION['registration_success'] = "Registration successful! Please log in.";
    header('Location: login.php');
    exit();
}
 else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
    }
}

// Close the connection
$con->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <style>
        body {
            background-image: url('assets/img/login4.jpg');
            background-size: 33.33% 33.33%;
            background-repeat: repeat;
            background-position: center center;
            background-attachment: fixed;
        }

        .logo-margin img {
            margin-bottom: 20px;
            width: 20%; /* Smaller logo size */
            filter: brightness(0%); /* Darken the logo */
        }

        .login-panel {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
        }

        .panel-heading {
            text-align: center;
            background-color: #f8f9fa; /* Light background color for the panel heading */
            padding: 15px; /* Padding around the heading */
            border-bottom: 2px solid #dee2e6; /* Subtle border at the bottom */
            border-radius: 5px; /* Rounded corners */
        }

        .panel-title {
            font-size: 24px; /* Larger font size for better visibility */
            font-weight: bold; /* Make the text bold */
            color: #343a40; /* Dark color for the text */
            margin: 0; /* Remove default margin */
        }

        .panel-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 20px;
            padding: 20px;
            font-size: 16px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 20px;
            font-size: 18px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-start {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-check-label {
            font-weight: normal;
            margin-left: 5px;
            color: #555;
        }

        .btn-block {
            width: 100%;
            margin-bottom: 20px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        a {
            color: #0062E6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Enhanced styling for the Role dropdown */
        .form-label {
            font-weight: bold;
            font-size: 16px;
            color: #0056b3;
            margin-bottom: 10px;
        }

        select.form-control {
            width: 100%; /* Adjusts the width of the input field */
            height: 50px; /* Adjusts the height of the input field */
            border-radius: 20px;
            padding: 10px;
            font-size: 16px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        select.form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(0, 86, 179, 0.3);
        }

        option {
            font-size: 16px;
            color: #333;
            padding: 10px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign Up</h3>
                    </div>
                    <div class="panel-body">
                    <form role="form" action="signup.php" method="POST">
    <fieldset>
        <!-- Display error messages -->
        <?php if (!empty($userName_error)): ?>
            <p class="error-message"><?php echo $userName_error; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <input class="form-control" placeholder="Name" name="username" type="text" value="<?php echo htmlspecialchars($userName); ?>" autofocus>
        </div>

        <?php if (!empty($email_error)): ?>
            <p class="error-message"><?php echo $email_error; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <?php if (!empty($password_error)): ?>
            <p class="error-message"><?php echo $password_error; ?></p>
        <?php endif; ?>
        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="<?php echo htmlspecialchars($password); ?>">
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
        <p class="mb-2 text-center" style="font-size: 16px; color: #555;">
            Already have an account?
            <a href="login.php" style="color: #0056b3; font-weight: bold; text-decoration: underline; transition: color 0.3s ease;">
                Login
            </a>
        </p>
    </fieldset>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
