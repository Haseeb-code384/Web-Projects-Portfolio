<?php
include "db/db_con.php";
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$email_error = "";
$password_error = "";
$login_error = "";
$email = "";
$password = "";

if (isset($_SESSION['registration_success'])) {
    $registration_message = $_SESSION['registration_success'];
    unset($_SESSION['registration_success']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $con->real_escape_string(trim($_POST['email']));
    $password = $con->real_escape_string(trim($_POST['password']));
    $role = $con->real_escape_string(trim($_POST['role']));

    // Validate Email
    if (empty($email)) {
        $email_error = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format!";
    }

    // Validate Password
    if (empty($password)) {
        $password_error = "Password is required!";
    }

    // Proceed if no validation errors
    if (empty($email_error) && empty($password_error)) {
        // Check if the email exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $role;
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

                // Update the user's role based on the selected role during login
                $update_role_sql = "UPDATE users SET role = '$role' WHERE id = " . $user['id'];
                $con->query($update_role_sql);

                // Fetch the 3 most recent notifications
                $sqlRecentNotifications = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 3";
                $recentNotifications = $con->query($sqlRecentNotifications);

                // Store notifications in session
                $_SESSION['notifications'] = [];
                while ($row = $recentNotifications->fetch_assoc()) {
                    $_SESSION['notifications'][] = $row;
                }

                // Redirect to the index or dashboard page after successful login
                header('Location: index.php');
                exit();
            } else {
                $login_error = "Invalid email or password!";
            }
        } else {
            $login_error = "Invalid email or password!";
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
    <title>Login</title>
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

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
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
    </style>
</head>

<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">User Login</h3>
                    </div>
                    <div class="panel-body">
                    <form role="form" action="login.php" method="POST" id="loginForm" onsubmit="return validateForm()">
    <fieldset>
        <!-- Display registration success message -->
        <?php if (isset($registration_message)): ?>
            <p class="success-message"><?php echo $registration_message; ?></p>
        <?php endif; ?>

        <!-- Display error messages -->
        <?php if (!empty($login_error)): ?>
            <p class="error-message"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <?php if (!empty($email_error)): ?>
            <p class="error-message"><?php echo $email_error; ?></p>
        <?php endif; ?>
        <?php if (!empty($password_error)): ?>
            <p class="error-message"><?php echo $password_error; ?></p>
        <?php endif; ?>

        <div class="form-group">
            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" autofocus>
        </div>

        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="<?php echo htmlspecialchars($password); ?>">
        </div>

        <!-- Role selection -->
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-control" name="role">
                <option value="admin" <?php if (isset($role) && $role == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="teacher" <?php if (isset($role) && $role == 'teacher') echo 'selected'; ?>>Teacher</option>
                <option value="student" <?php if (isset($role) && $role == 'student') echo 'selected'; ?>>Student</option>
            </select>
        </div>

        <!-- Keep me logged in checkbox -->
        <div class="mb-3 text-start" style="display: flex; align-items: center; font-size: 16px; color: #555;">
            <input type="checkbox" class="form-check-input" id="keepmeloginuser" name="keepmeloginuser" style="margin-right: 10px; transform: scale(1.2);">
            <label class="form-check-label" for="keepmeloginuser" style="cursor: pointer;">
                Keep me logged in
            </label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>

        <p class="mb-2 text-center" style="font-size: 16px; color: #555;">
            Don't have an account?
            <a href="signup.php" style="color: #0056b3; font-weight: bold; text-decoration: underline;">
                Sign Up
            </a>
        </p>

        <p class="text-center">
            <a href="index.php" style="color: #0062E6; font-size: 14px; text-decoration: none; font-weight: bold;">
                Back to home page
            </a>
        </p>
    </fieldset>
</form>

<!-- Core Scripts - Include with every page -->
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

      </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
