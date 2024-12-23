<?php 
$titlepage = "ZoneTex- 404 Error";
$scriptpage = "";
include "header.php";
include "includes/navbar.php";
?>

<style>
  .Error-404{
  margin: 30px auto;
  text-align: center;
}
.Error-404 h3{
  margin: 10px auto;
  font-size: 1.9rem;
  
}
.Error-404 p{
  
  font-size: 1.2rem;
  
}
.Error-404 h1{

font-size: 20vw;
text-align: center;
font-weight: 900;
background: -webkit-gradient(linear, left top, right top, 
      from(rgb(25, 76, 192)), color-stop(20%, rgb(196, 26, 3)), 
      color-stop(40%, rgb(236, 190, 6)), 
      color-stop(60%, rgb(25, 76, 192)), 
      color-stop(80%, rgb(3, 116, 8)), 
      to(rgb(196, 26, 3)));
background-clip: text;
-webkit-text-fill-color: transparent;
}
.Error-404 .btns{
margin: 20px auto;
display: flex;
gap: 10px;
justify-content: center;

}
.Error-404 .btns .btn{
text-decoration: none;
padding: 10px 20px;
background-color: red;
font-size: 150%;
border-radius: 5px;

}
.Error-404 .btns .btn-home{
  background-color: #007aff;
  color: rgb(248, 248, 248);
 }
 .Error-404 .btns .btn-home:hover{
  background-color: #015ec2;
  color: rgb(238, 238, 238);
 }
 .Error-404 .btns .btn-contact{
  background-color: #17a2b7;
  color: rgb(255, 255, 255);

 }
 .Error-404 .btns .btn-contact:hover{
  background-color: #077d8f;
  color: rgb(228, 228, 228);

 }
@media only screen and (max-width: 600px){
.Error-404 .btns .btn{
font-size: 120%;
}
}
</style>

<section class="Error-404">
  <h1>Oops!</h1>
  <h3>404 - Page Not Found</h3>
  <p>The page you are looking for might have been removed, had its name changed or does not exist.</p>
  <div class="btns">
    <a href="index.php" class="btn btn-home">Go Back Home</a>
    <a href="contact.php" class="btn btn-contact">Contact Us</a>
  </div>
</section>


<?php
include("footer.php");
?>