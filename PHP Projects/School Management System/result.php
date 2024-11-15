<?php
$insert = false;
if (isset($_POST['exam_id'])) {
    include "db/db_con.php";
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    // Prepare and bind the SQL statement
    $stmt = $con->prepare("INSERT INTO exam_results (exam_id, student_id, subject_id, obtained_marks, total_marks, exam_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiss", $exam_id, $student_id, $subject_id, $obtained_marks, $total_marks, $exam_date);

    // Set parameters and execute
    $exam_id = $_POST['exam_id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $obtained_marks = $_POST['obtained_marks'];
    $total_marks = $_POST['total_marks'];
    $exam_date = $_POST['exam_date'];  // Should be a string as it's VARCHAR in the table

    if ($stmt->execute()) {
        $insert = true;
        echo "Record inserted successfully.";
    } else {
        echo "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $con->close();
}

// Fetch students and subjects for the dropdowns
include "db/db_con.php";  // Reopen connection for fetching
$students_query = "SELECT * FROM students";
$students_result = mysqli_query($con, $students_query);
$students = array();
while ($row = mysqli_fetch_assoc($students_result)) {
    $students[$row['student_id']] = $row['student_name'];
}
mysqli_free_result($students_result);

$subjects_query = "SELECT * FROM subjects";
$subjects_result = mysqli_query($con, $subjects_query);
$subjects = array();
while ($row = mysqli_fetch_assoc($subjects_result)) {
    $subjects[$row['subject_id']] = $row['subject_name'];
}
mysqli_free_result($subjects_result);
// Fetch the 3 most recent notifications
$sqlRecentNotifications = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 3";
$recentNotifications = $con->query($sqlRecentNotifications);
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
                        data-target="#resultFormModal">Add Exam Result</button>
                                    
                            </div>
                        </div>
                        
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                        <?php
include "db/db_con.php";

// Determine the current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

// Fetch total number of records
$total_query = "SELECT COUNT(*) FROM exam_results"; // Corrected table name from 'enrollments' to 'enrollment'
$total_result = mysqli_query($con, $total_query);
if (!$total_result) {
    die("Error fetching total number of records: " . mysqli_error($con));
}
$total_records = mysqli_fetch_array($total_result)[0];
$total_pages = ceil($total_records / $limit);

// Fetch the required records for the current page

$slc = "SELECT er.result_id, s.student_name, sub.subject_name, er.obtained_marks, er.total_marks, er.exam_date
        FROM exam_results er
        JOIN students s ON er.student_id = s.student_id
        JOIN subjects sub ON er.subject_id = sub.subject_id
        LIMIT $limit OFFSET $offset";
        
$result = mysqli_query($con, $slc);

if (!$result) {
    die("Error executing query: " . mysqli_error($con));
}
?>

<div class="panel-body">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <?php
    echo '<tr>';
    echo '<th>Result ID</th>';
    echo '<th>Student Name</th>';
    echo '<th>Subject Name</th>';
    echo '<th>Obtained Marks</th>';
    echo '<th>Total Marks</th>';
    echo '<th>Exam Date</th>';
    echo  '<th colspan=2>Change</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        $result_id = $row['result_id'];
        echo '<tr>';
        echo '<td>' . $row['result_id'] . '</td>';
        echo '<td>' . $row['student_name'] . '</td>';
        echo '<td>' . $row['subject_name'] . '</td>';
        echo '<td>' . $row['obtained_marks'] . '</td>';
        echo '<td>' . $row['total_marks'] . '</td>';
        echo '<td>' . $row['exam_date'] . '</td>';
        echo "<td class='table-actions'><a href='exam_result/editform.php?result_id=" . $result_id . "' class='edit btn btn-primary'>Edit</a></td>";
        echo "<td class='table-actions'><a href='exam_result/delete.php?result_id=" . $result_id . "' class='edit btn btn-danger'>Delete</a></td>";
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';


?>

 <!-- Pagination controls -->
 <div class="pagination">
                    <?php
                    if ($total_pages > 1) {
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination justify-content-center">';

                        // Previous button
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="result.php?page=' . ($page - 1) . '">Previous</a></li>';
                        }

                        // Page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo '<li class="page-item active"><a class="page-link" href="result.php?page=' . $i . '">' . $i . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="result.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                        }

                        // Next button
                        if ($page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="result.php?page=' . ($page + 1) . '">Next</a></li>';
                        }

                        echo '</ul>';
                        echo '</nav>';
                    }
                    ?>
                </div>


            </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <!-- Modal popup container -->
                    <div class="modal fade" id="resultFormModal" tabindex="-1" role="dialog"
                        aria-labelledby="resultFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="resultFormModalLabel">Exam Result Form</h4>
                                </div>
                                <div class="modal-body">
                                <form role="form" action="result.php" method="POST">
                                <div class="form-group">
        <label for="exam_id">Exam id:</label>
        <input type="text" class="form-control" name="exam_id" required />
    </div>
    <div class="form-group">
        <label for="student">Student:</label>
        <select id="student" name="student_id" required class="form-control">
            <option value="">Select a student</option>
            <?php foreach ($students as $student_id => $student_name): ?>
                <option value="<?php echo $student_id; ?>"><?php echo $student_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="subject">Subject:</label>
        <select id="subject" name="subject_id" required class="form-control">
            <option value="">Select a subject</option>
            <?php foreach ($subjects as $subject_id => $subject_name): ?>
                <option value="<?php echo $subject_id; ?>"><?php echo $subject_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="obtained_marks">Obtained Marks:</label>
        <input type="text" class="form-control" name="obtained_marks" required />
    </div>
    
    <div class="form-group">
        <label for="total_marks">Total Marks:</label>
        <input type="text" class="form-control" name="total_marks" required />
    </div>
    
    <div class="form-group">
        <label for="exam_date">Exam Date:</label>
        <input type="date" class="form-control" name="exam_date" required />
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-success">Reset</button>
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
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>