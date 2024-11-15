 <?php 
// session_start();
// if(session_status() == PHP_SESSION_NONE){
//     // Then start the session
//     session_start();
// }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_page ?></title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheet-css/style.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
    <header class="full-header">
        <div class="logo-container">
            <div class="logo-img">
                <a href="http://localhost/blaze_web/">
                    <img src="images/logo-blaze.png" alt="Website Logo">
                </a>
            </div>
            <h3 class="logo-phrase">We Build - You Thrive</h3>
            <div class="small-header-col social-icons">
                    <!-- <span><img src="images/facebook.png" alt="Facebook"></span>
                    <span><img src="images/twitter.png" alt="Twitter"></span>
                    <span><img src="images/path.png" alt="Path"></span>
                    <span><img src="images/flickr.png" alt="Flickr"></span> -->
                    <?php 
                    $user_id = "8765";
                    $user_name = "Haseeb";
                    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])){
                        echo " Welcome Back ".$_SESSION["user_name"]. " ";
                        echo '<a href="logout.php"> Logout</a>';
                    }
                    // else {
                    //     echo "Welcome Back, Guest ";
                    //     echo '<a href="login.php">Login</a>';
                    // }
                    
                    ?>
                    
            </div>
        </div>
        <nav class="main-navigation">
            <div class="nav-container">
                <ul class="menu">
                    <li><a href="http://localhost/blaze_web/">Home</a></li>
                    <li>
                        <a href="#">Projects</a>
                        <ul class="sub-menu">
                            <li><a href="http://localhost/blaze_web/upload.php">Upload Files</a></li>
                            <li><a href="http://localhost/blaze_web/register.php">Registration Form</a></li>
                            <li><a href="http://localhost/blaze_web/user.php">User Table</a></li>
                            <li><a href="http://localhost/blaze_web/ajax-example.php">Ajax User Table</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Services</a>
                        <ul class="sub-menu">
                            <li><a href="#">HTML</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>

                </ul>
            </div>
        </nav>
    </header>