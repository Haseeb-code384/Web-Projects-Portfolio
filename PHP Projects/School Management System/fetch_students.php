<?php
include "db/db_con.php";

if (isset($_GET['section_id'])) {
    $section_id = (int) $_GET['section_id'];

    // Fetch students based on the selected section
    $query = "SELECT student_id, student_name FROM students WHERE section_id = $section_id";
    $result = mysqli_query($con, $query);

    echo '<option value="">Select a student</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['student_id'] . '">' . $row['student_name'] . '</option>';
    }

    // Close the connection
    mysqli_close($con);
}
?>
