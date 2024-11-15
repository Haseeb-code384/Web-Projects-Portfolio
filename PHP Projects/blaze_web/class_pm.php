<?php
namespace Data;

/*============================= 
 Class Structure and Example
 ==============================*/
class User{
    

    // <<<<<<<  Properties >>>>>>>
    public $name;
    public $email;

    /* Public here is access modifier ( Access modifiers decide the property or methods restriction 
    and access criteria ) which are of three types:
    1. Public -- the property or method can be accessed from anywhere
    2. Protected -- the property or method can be accessed within the class and by classes derived from that class
    3. Private -- the property or method can only be accessed within the class
    */

    // Construct function will assign default values in case of not providing in the object
    // Constructor
    function __construct(){
        $this-> name = "Haseeb";
        $this -> email = "haseeb456@example.com";
    }

    

    // <<<<<<<<  Methods >>>>>>>>
    public function set_name($name){
        $this->name = $name;
    }
    public function get_name(){
        return $this -> name;
    }
    public function get_email(){
        return $this -> email;
    }

    //static Method
    public static function static_method(){
        return "This is static method";
    }


    // Destructor
    function __Destruct(){
        echo "Thank you for visitng {$this->name}";
    }
}
// Contructor -- A Constructor allow you to initialize an object's properties upon creation of the object

// Destructor -- A destructor is called when the object is destructed or the script is stopped or exited.

// Static Method -- If you want to access class properties and methods without creating object then you 
// has to use static method

// NameSpacing -- Namespacing can be used to handle classes with same name-- for that we have to declare namespace
// method adn then we can access specific classes data without any fear of a duplication error
?>