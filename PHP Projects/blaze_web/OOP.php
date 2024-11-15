<?php
require "class_pm.php";
require "class_2.php";
/*
Object oriented Programming with PHP
 */

// Syntax 
// variable_for_object = new class_name();


$object = new Data\User();
// $object_2 = new User();

// Can use these objects with constructor or noraml methods
echo $object -> name. "<br>";
echo $object -> email. "<br>";
$set_name = $object -> set_name("Haseeb Tariq");

// For constuctor, the object can be written as
$get_name = $object -> get_name();
$get_email = $object -> get_email();

// $set_name_2 = $object_2 -> set_name("Tariq");
// $get_name_2 = $object_2 -> get_name();
// Can use these objects with constructor or noraml methods
echo $get_name. "<br>";
echo $get_email . "<br>";

// Static Mehod
$static = Data\User :: static_method();
echo $static . "<br>";



 
?>