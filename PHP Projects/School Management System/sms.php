<?php
require_once "vendor/autoload.php";
use Twilio\Rest\Client;

$sid = "ACbc82dda25e20deeb5e2965d98899547f";
$token = "e1e7cb47ca5b6528cbd2fa9e77bc14e5";

if(isset($_POST['send']))
{
    $phone = $_POST['phone'];
    $msg = $_POST['msg'];
    $client = new Client($sid ,$token );
    $client->messages->create(
        $phone , array(
            "from" => "+15624441541",
            "body" => $msg
            
        )
        );
        header("Location:messages.php?status=SMS");
}
?>