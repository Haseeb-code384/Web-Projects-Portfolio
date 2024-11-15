<?php
require_once "vendor/autoload.php";
use Twilio\Rest\Client;

// Twilio credentials
$sid = "ACbc82dda25e20deeb5e2965d98899547f";
$token = "e1e7cb47ca5b6528cbd2fa9e77bc14e5";

if (isset($_POST['send'])) {
    include "db/db_con.php";

    // Fetch the father's phone number based on student_id
    $student_id = $_POST['student_id'];
    $f_ph_number = $_POST['f_ph_number']; // phone is now directly taken from the form (which is prefilled)

    // Message details
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    $class_id = (int) $_POST['class_id'];
    $section_id = (int) $_POST['section_id'];

    // Send SMS via Twilio
    try {
        $client = new Client($sid, $token);
        $client->messages->create(
            $f_ph_number, array(
                "from" => "+15624441541",
                "body" => $msg
            )
        );

        // Insert message into the database
        $insert_query = "INSERT INTO messages (class_id, section_id, student_id, f_ph_number, message, date) 
                         VALUES ($class_id, $section_id, $student_id, '$f_ph_number', '$msg', NOW())";
        if (mysqli_query($con, $insert_query)) {
            // Redirect to the messages page with a success status
            header("Location: messages.php?status=SMS_SENT");
        } else {
            echo "Error inserting message: " . mysqli_error($con);
        }
    } catch (Exception $e) {
        echo "Error sending message: " . $e->getMessage();
    }

    // Close the database connection
    mysqli_close($con);
}

// Fetch classes, sections, and students
include "db/db_con.php";

// Fetch all classes
$classes_query = "SELECT * FROM classes";
$classes_result = mysqli_query($con, $classes_query);
$classes = [];
while ($row = mysqli_fetch_assoc($classes_result)) {
    $classes[$row['class_id']] = $row['class_name'];
}
mysqli_free_result($classes_result);

// Fetch all sections
$sections_query = "SELECT * FROM sections";
$sections_result = mysqli_query($con, $sections_query);
$sections = [];
while ($row = mysqli_fetch_assoc($sections_result)) {
    $sections[$row['section_id']] = $row['section_name'];
}
mysqli_free_result($sections_result);

// Fetch all students
$students_query = "SELECT * FROM students";
$students_result = mysqli_query($con, $students_query);
$students = [];
while ($row = mysqli_fetch_assoc($students_result)) {
    $students[$row['student_id']] = $row['student_name'];
}
mysqli_free_result($students_result);

// Fetch messages to display in the table
include "db/db_con.php";
$messages_query = "SELECT m.*, s.student_name 
                   FROM messages m 
                   JOIN students s ON m.student_id = s.student_id 
                   ORDER BY m.date DESC";
$messages_result = mysqli_query($con, $messages_query);

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
                        data-target="#messageFormModal">Add Message</button>
                                    
                            </div>
                        </div>
                        
                       <!-- Display Messages in the Table -->
<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Father's Phone Number</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($messages_result) > 0): ?>
                            <?php $count = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($messages_result)): ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['f_ph_number']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                    <td><?php echo date("d/m/Y H:i:s", strtotime($row['date'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No messages found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                        <!-- /.panel-body -->
                    </div>

                   <!-- Modal popup container -->
<div class="modal fade" id="messageFormModal" tabindex="-1" role="dialog" aria-labelledby="messageFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="messageFormModalLabel">Message Form</h4>
            </div>
            <div class="modal-body">
           <form role="form" action="messages.php" method="POST">
    <div class="form-group">
        <label for="class">Class:</label>
        <select id="class" name="class_id" required>
            <option value="">Select a class</option>
            <?php foreach ($classes as $class_id => $class_name): ?>
                <option value="<?php echo $class_id; ?>"><?php echo $class_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="section">Section:</label>
        <select id="section" name="section_id" required>
            <option value="">Select a Section</option>
            <?php foreach ($sections as $section_id => $section_name): ?>
                <option value="<?php echo $section_id; ?>"><?php echo $section_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="student">Student:</label>
        <select id="student" name="student_id" required onchange="fetchPhoneNumber(this.value)">
            <option value="">Select a student</option>
            <?php foreach ($students as $student_id => $student_name): ?>
                <option value="<?php echo $student_id; ?>"><?php echo $student_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="phone">Father's Phone Number:</label>
        <input type="text" id="f_ph_number" name="f_ph_number" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label for="message">Message:</label>
        <textarea class="form-control" id="msg" name="msg" required></textarea>
    </div>

    <button type="submit" name="send" class="btn btn-primary">Send</button>
</form>

<!-- JavaScript to fetch phone number via AJAX -->
<script>
function fetchPhoneNumber(studentId) {
    if (studentId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_phone_number.php?student_id=" + studentId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("f_ph_number").value = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById("f_ph_number").value = "";
    }
}
</script>

           

            </div>
        </div>
    </div>
</div>



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

</body>

</html>