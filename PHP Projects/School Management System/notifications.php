<?php
session_start();
$insert = false;
include "db/db_con.php";

if (!$con) {
    die("Connection to this database failed due to " . mysqli_connect_error());
}

// Insert notification
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $sql = "INSERT INTO `notifications` (`user_id`, `message`, `start_date`, `end_date`) VALUES ('$user_id', '$message', '$start_date', '$end_date')";

    if ($con->query($sql) === true) {
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $con->error";
    }
}
// Fetch the 3 most recent notifications
$sqlRecentNotifications = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 3";
$recentNotifications = $con->query($sqlRecentNotifications);

$sql = "SELECT * FROM notifications";
$notifications = $con->query($sql);

$con->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
<style>
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

                    <li>
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
                <div class="col-lg-12">
                    <h1 class="page-header">Notifications</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Alert Styles
                            <div class="pull-right">
                                <button class="btn btn-primary btn-xl" data-toggle="modal" data-target="#notificationModal">
                                    Add Notifications
                                </button>
                                <!-- Notification Modal -->
                                <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="notificationModalLabel">Notification Form</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" action="notifications.php" method="POST">
                                                <div class="form-group">
                                                        <label>User Id</label>
                                                        <input type="id" class="form-control" name="user_id" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Notification</label>
                                                        <textarea class="form-control" name="message" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Start Date</label>
                                                        <input type="date" class="form-control" name="start_date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>End Date</label>
                                                        <input type="date" class="form-control" name="end_date" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="reset" class="btn btn-success">Reset</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Notification Modal -->
                            </div>
                        </div>
                        <div class="panel-body">
    <?php if ($notifications && $notifications->num_rows > 0): ?>
        <?php while($row = $notifications->fetch_assoc()): ?>
            <div class="alert alert-info">
                <strong>Message:</strong> <?php echo $row['message']; ?> <br>
                <strong>Start Date:</strong> <?php echo $row['start_date']; ?> <br>
                <strong>End Date:</strong> <?php echo $row['end_date']; ?> <br>
                
                <!-- Update Button -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#updateModal-<?php echo $row['notification_id']; ?>">Update</button>
                
                <!-- Delete Button -->
                <form method="POST" action="notifications/delete.php" style="display:inline;">
                    <input type="hidden" name="notification_id" value="<?php echo $row['notification_id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal-<?php echo $row['notification_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel-<?php echo $row['notification_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="updateModalLabel-<?php echo $row['notification_id']; ?>">Update Notification</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="notifications/update.php">
                                    <input type="hidden" name="notification_id" value="<?php echo $row['notification_id']; ?>">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" name="message"><?php echo $row['message']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Update Modal -->
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-warning">
            No notifications found.
        </div>
    <?php endif; ?>
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