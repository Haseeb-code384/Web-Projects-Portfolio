<?php
// Include database connection
include "db/db_con.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture the form data directly without using mysqli_real_escape_string
    $user_id = $_POST['user_id'];
    $student_name = $_POST['student_name'];
    $father_name = $_POST['father_name'];
    $class_id = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $enrolled_date = $_POST['enrolled_date'];
    $father_cnic = $_POST['father_cnic'];
    $f_ph_number = $_POST['f_ph_number'];
    $student_bform = $_POST['student_bform'];

    // SQL query to insert data
    $sql = "INSERT INTO students (user_id, student_name, father_name, class_id, section_id, date_of_birth, gender, address, phone, email, enrolled_date, father_cnic, f_ph_number, student_bform) 
            VALUES ('$user_id', '$student_name', '$father_name', '$class_id', '$section_id', '$date_of_birth', '$gender', '$address', '$phone', '$email', '$enrolled_date', '$father_cnic', '$f_ph_number', '$student_bform')";

    // Execute the query
    if ($con->query($sql) === true) {
        $insert = true;
    } else {
        echo "ERROR: $sql <br>" . $con->error;
    }

    // Close the connection
    $con->close();
}

include "db/db_con.php";
if (!$con) {
    die("Connection to this database failed due to " . mysqli_connect_error());
}

// Retrieve classes from database
$classes_query = "SELECT * FROM classes";
$classes_result = mysqli_query($con, $classes_query);
$classes = array();
while ($row = mysqli_fetch_assoc($classes_result)) {
    $classes[$row['class_id']] = $row['class_name'];
}

// Retrieve sections from database
$sections_query = "SELECT * FROM sections";
$sections_result = mysqli_query($con, $sections_query);
$sections = array();
while ($row = mysqli_fetch_assoc($sections_result)) {
    $sections[$row['section_id']] = $row['section_name'];
}
// Fetch the 3 most recent notifications
$sqlRecentNotifications = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 3";
$recentNotifications = $con->query($sqlRecentNotifications);
// Close the database connection
mysqli_close($con);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Dashboard</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
   
<style>



select {
  width: 100%; /* added width */
  height: 40px; /* adjust the height to your liking */
  padding: 10px;
  font-size: 16px;
  border-color: #ccc;
  border-radius: 4px;
  -webkit-appearance: none; /* remove default select arrow */
  -moz-appearance: none;
  appearance: none;
  background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%3E%3Cpath%20fill%3D%22%23007bff%22%20d%3D%22M7.293%2012.707%20l5-5%20.707.707-5%205%20.707.707%205-5%20.707-.707-5-5-.707.707z%22%2F%3E%3C%2Fsvg%3E'); /* add a custom arrow */
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 20px 20px;
  cursor: pointer; /* added cursor pointer */
}

select:focus {
  border-color: #007bff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
 /* Notification label with random color and animation */
 .notification-header .label {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;  /* Limits the text to two lines */
    overflow: hidden;
    text-overflow: ellipsis; /* Add ellipsis (...) after truncated text */
    white-space: normal;     /* Allows multi-line display */
    word-wrap: break-word;   /* Prevents text overflow */
    font-size: 13px;         /* Adjusted font size for a more refined look */
    padding: 6px 10px;       /* Slightly reduced padding for a cleaner design */
    border-radius: 4px;      /* Softer corners for a modern look */
    display: inline-block;
    text-transform: capitalize;  /* Capitalized for a less aggressive look */
    font-weight: 500;        /* Medium weight for a more subtle, balanced text */
    letter-spacing: 0.5px;   /* Add some spacing between letters for readability */
    color: #fff;
    max-width: 180px;        /* Adjust the width for a better layout in the dropdown */
    background-color: rgba(0, 0, 0, 0.7);  /* Default background */
    animation: colorChange 4s infinite;  /* Animation for smooth color transitions */
}

/* Hover effect to darken the label */
.notification-header .label:hover {
    background-color: rgba(0, 0, 0, 0.85); /* Darkens on hover */
    transition: background-color 0.3s ease; /* Smooth transition effect */
}

/* Date alignment */
.notification-header .text-muted {
    font-size: 12px;
    color: #888;
    margin-left: 10px;
}

/* Animation for smooth color transitions */
@keyframes colorChange {
    0% {
        background-color: #3498db; /* Blue */
    }
    25% {
        background-color: #e74c3c; /* Red */
    }
    50% {
        background-color: #f39c12; /* Orange */
    }
    75% {
        background-color: #2ecc71; /* Green */
    }
    100% {
        background-color: #9b59b6; /* Purple */
    }
}
</style>


</head>

<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <span class="top-label label label-danger">3</span><i class="fa fa-bell fa-3x"></i>
    </a>
    <!-- dropdown-messages -->
    <ul class="dropdown-menu dropdown-messages modern-dropdown">
        <?php if ($recentNotifications->num_rows > 0): ?>
            <?php while ($row = $recentNotifications->fetch_assoc()): 
                $labelColors = ['label-info', 'label-success', 'label-warning', 'label-danger'];
                $randomColor = $labelColors[array_rand($labelColors)];
            ?>
                <li>
                    <a href="#">
                        <div class="notification-header">
                            <strong><span class="label <?php echo $randomColor; ?>"><?php echo $row['message']; ?></span></strong>
                            <span class="pull-right text-muted">
                                <em><?php echo $row['start_date']; ?></em>
                            </span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>
                <a href="#">
                    <div class="no-notification">No notifications found.</div>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a class="text-center" href="notifications.php">
                <strong>Read All Notifications</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- end dropdown-messages -->
</li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-success">4</span>  <i class="fa fa-tasks fa-3x"></i>
                    </a>
                    <!-- dropdown tasks -->
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-tasks -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="messages.php">
                        <span class="top-label label label-warning">5</span>  <i class="fa fa-envelope fa-3x"></i>
                    </a>
                    <!-- dropdown alerts-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i>New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i>Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i>New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i>Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="messages.php">
                                <strong>See All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- end dropdown-alerts -->
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                    <li><a href="myaccount.php"><i class="fa fa-user fa-fw"></i>My Account</a></li>
                    

                        
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i>Settings</a>
                        </li>
                        
    <li><a href="userProfile.php"><i class="fa fa-info-circle fa-fw"></i>About Us</a></li>
    
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>

                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>

        </nav>
        <!-- end navbar top -->
        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="assets/img/user.jpg" alt="" class="img-circle">
                            </div>
                            <div class="user-info">
                                <div>Admin</div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    
                    <li >
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Students<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="student.php">Add Student</a>
                            </li>
                           
                        </ul> 
                        <!-- second-level-items -->
                    </li>
                     <li>
                        <a href="subject.php"><i class="fa fa-flask fa-fw"></i>Subject</a>
                    </li>
                    <li>
                        <a href="attendance.php"><i class="fa fa-table fa-fw"></i>Attendance</a>
                    </li>
                    <li>
                        <a href="enrollement.php"><i class="fa fa-edit fa-fw"></i>Enrollment</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Exam<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="result.php">Exam Result</a>
                            </li>
                        </ul> 
                    </li>
                    <li>
                        <a href="fees.php"><i class="fa fa-sitemap fa-fw"></i>Fees</a>
                                
                    </li>
                    <li class="active">
                        <a href="teacher.php"><i class="fa fa-files-o fa-fw"></i>Teacher</a>
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <!-- Button to open the popup -->
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i>Data Table
                            <div class="pull-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#studentFormModal">Add Student</button>
                                    
                            </div>
                        </div>
                       
                        <?php
include "db/db_con.php";

// Define the number of results per page
$results_per_page = 10;

// Find out the number of results stored in the database
$slc = "SELECT COUNT(*) AS total FROM students";
$result = mysqli_query($con, $slc);
$row = mysqli_fetch_assoc($result);
$total_students = $row['total'];

// Determine the number of total pages available
$total_pages = ceil($total_students / $results_per_page);

// Determine which page number visitor is currently on
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1;
}

// Determine the SQL LIMIT starting number for the results on the displaying page
$starting_limit = ($current_page - 1) * $results_per_page;

// Retrieve the selected results from the database with joins
$slc = "
    SELECT students.*, classes.class_name, sections.section_name 
    FROM students
    LEFT JOIN classes ON students.class_id = classes.class_id
    LEFT JOIN sections ON students.section_id = sections.section_id
    LIMIT $starting_limit, $results_per_page";

$result = mysqli_query($con, $slc);

// Check for query errors
if (!$result) {
    // Output error message and SQL query for debugging
    echo "Error in query: " . mysqli_error($con);
    echo "<br>Query: " . $slc;
    exit(); // Stop further execution if query fails
}

?>
<div class="panel-body">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
           <div style="overflow-x:auto;">
  <table class="table table-bordered table-hover table-striped">
    <?php

    echo "<tr>";
    echo   "<th>Student Id</th>";
   
    echo "<th>Student Name</th>";
    echo "<th>Father Name</th>";
    echo "<th>Class</th>";
    echo "<th>Section</th>";
    echo"<th>Date of Birth</th>";
    echo "<th>Gender</th>";
    echo "<th>Address</th>";
    echo"<th>Phone</th>";
    echo"<th>Email</th>";
    echo"<th>Enrolled Date</th>";
    echo"<th>Father Cnic</th>";
    echo"<th>Father Phone Number</th>";
    echo"<th>Student B_form</th>";
    echo"<th colspan='2'>Actions</th>";
    echo"</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['student_id']}</td>
                <td>{$row['student_name']}</td>
                <td>{$row['father_name']}</td>
                <td>{$row['class_name']}</td>
                <td>{$row['section_name']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['address']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['email']}</td>
                <td>{$row['enrolled_date']}</td>
                <td>{$row['father_cnic']}</td>
                <td>{$row['f_ph_number']}</td>
                <td>{$row['student_bform']}</td>
                <td class='table-actions'><a href='students/editing.php?student_id={$row['student_id']}' class='edit btn btn-primary'>Edit</a></td>
                <td class='table-actions'><a href='students/delete.php?student_id={$row['student_id']}' class='delete btn btn-danger'>Delete</a></td>
              </tr>";
    }
    ?>
  </table>
</div>
    <?php
// Pagination controls
if ($total_pages > 1) {
    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-center">';

    // Previous button
    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
    }

    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo '<li class="page-item active"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Next button
    if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
    }

    echo '</ul>';
    echo '</nav>';
}

mysqli_close($con);
?>
            </div>
        </div>
    </div>
</div>
                    </div>

               <!-- Modal popup container -->
<div class="modal fade" id="studentFormModal" tabindex="-1" role="dialog" aria-labelledby="studentFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title" id="studentFormModalLabel">Student Form</h4>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#classFormModal">Add Class</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sectionFormModal">Add Section</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Message to ensure class or section is added -->
                <div id="alertMessage" class="alert alert-warning" role="alert" style="display: none;">
                    Make sure to add the class or section first if it hasn’t been added yet.
                </div>
                <form role="form" action="student.php" method="POST">
                    <div class="form-group">
                        <label>User ID</label>
                        <input class="form-control" name="user_id" />
                    </div>
                    <div class="form-group">
                        <label>Student Name</label>
                        <input class="form-control" name="student_name" />
                    </div>
                    <div class="form-group">
                        <label>Father Name</label>
                        <input class="form-control" name="father_name"/>
                    </div>
                    <div class="form-group">
        <label for="class">Class:</label>
        <select id="class" name="class_id" required> <!-- Changed name to class_id -->
            <option value="">Select a class</option>
            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $class_id => $class_name): ?>
                    <option value="<?php echo $class_id; ?>"><?php echo $class_name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="section">Section:</label>
        <select id="section" name="section_id" required> <!-- Changed name to section_id -->
            <option value="">Select a Section</option>
            <?php if (!empty($sections)): ?>
                <?php foreach ($sections as $section_id => $section_name): ?>
                    <option value="<?php echo $section_id; ?>"><?php echo $section_name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
                    <!-- Rest of the form fields -->
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio">
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="optionsRadios1" value="male">
                        </div>
                        <div class="radio">
                            <label for="female">Female</label>
                            <input type="radio" name="gender" id="optionsRadios2" value="female">
                        </div>
                        <div class="radio">
                            <label for="other">Other</label>
                            <input type="radio" name="gender" id="optionsRadios3" value="other">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label>Phone No.</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Enrolled Date</label>
                        <input type="date" class="form-control" name="enrolled_date">
                    </div>
                    <div class="form-group">
                        <label>Father CNIC</label>
                        <input type="text" class="form-control" name="father_cnic">
                    </div>
                    <div class="form-group">
                        <label>Father Mobile Number</label>
                        <input type="tel" class="form-control" name="f_ph_number">
                    </div>
                    <div class="form-group">
                        <label>Student B-Form</label>
                        <input type="text" class="form-control" name="student_bform">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-success">Reset</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to show the message for 10 seconds -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertMessage = document.getElementById('alertMessage');
        alertMessage.style.display = 'block'; // Show the message
        setTimeout(function() {
            alertMessage.style.display = 'none'; // Hide the message after 10 seconds
        }, 15000);
    });
</script>


<!-- Include the Classes Form Modal -->
<div class="modal fade" id="classFormModal" tabindex="-1" role="dialog" aria-labelledby="classFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="classFormModalLabel">Add Class</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="student.php" method="POST">
                    <div class="form-group">
                        <label for="class_name">Class Name:</label>
                        <input type="text" id="class_name" name="class_name" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Add Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Include the Classes Form Modal -->
<div class="modal fade" id="sectionFormModal" tabindex="-1" role="dialog" aria-labelledby="sectionFormModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sectionFormModalLabel">Add Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="section/section.php" method="POST">
                    <div class="form-group">
                        <label for="section_name">Section Name:</label>
                        <input type="text" id="section_name" name="section_name" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Add Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                    <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>