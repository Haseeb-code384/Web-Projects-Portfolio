<?php
session_start();
include( 'config.php' );
include( 'allFunctions.php' );
$login_user = $_SESSION[ 'email' ];
$t_id = $_REQUEST[ 't_id' ];
// Get the previous URL by removing the current URL from the $_SERVER['HTTP_REFERER'] variable.
$previous_url = $_SERVER[ 'HTTP_REFERER' ];
include( "preloader.php" );


if ( $login_user == '' ) {
  $login_user = $_REQUEST[ 'user' ];
}
executeQuery( "UPDATE `m_account_detail` SET `admin_verified` = '$login_user' WHERE `m_account_detail`.`sno` = '$t_id'" );

//        header("Location: ".$previous_url);
?>
<script>
    window.close();
//window.location.href="<?php echo $previous_url; ?>";
</script>