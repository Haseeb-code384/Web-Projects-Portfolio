<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db/db_con.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated username and email from the form
    $newUsername = $con->real_escape_string($_POST['username']);
    $newEmail = $con->real_escape_string($_POST['email']);
    $currentUsername = $_SESSION['username'];

    // Check if the new email already exists in the database but ignore the current user's email
    $emailCheckSql = "SELECT username FROM users WHERE email='$newEmail' AND username != '$currentUsername'";
    $result = $con->query($emailCheckSql);

    if (!$result) {
        die("Query failed: " . $con->error); // Error handling for query failure
    }

    if ($result->num_rows > 0) {
        header("Location: myaccount.php?error=email_exists");
        exit();
    }

    // Check if the new username already exists, excluding the current user
    $usernameCheckSql = "SELECT username FROM users WHERE username='$newUsername' AND username != '$currentUsername'";
    $result = $con->query($usernameCheckSql);

    if (!$result) {
        die("Query failed: " . $con->error); // Error handling for query failure
    }

    if ($result->num_rows > 0) {
        header("Location: myaccount.php?error=username_exists");
        exit();
    }

    // Update the database with the new information
    $sql = "UPDATE users SET username='$newUsername', email='$newEmail' WHERE username='$currentUsername'";

    if ($con->query($sql) === TRUE) {
        // Update session variables
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $newEmail;
        
        // Redirect to the My Account page with a success message
        header("Location: myaccount.php?update=success");
        exit();
        
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>
