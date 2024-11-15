<?php
include "db/db_con.php";

if (isset($_GET['student_id'])) {
    $student_id = (int) $_GET['student_id'];

    // Fetch the father's phone number from the students table
    $query = "SELECT f_ph_number FROM students WHERE student_id = $student_id";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['f_ph_number'];
    } else {
        echo ""; // Return an empty string if no phone number found
    }

    // Close the connection
    mysqli_close($con);
}
?>
