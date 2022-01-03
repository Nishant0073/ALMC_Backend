<?php
require_once 'controller.php';
$email = "";
$password = "";


if(isset($_GET['email']))
{
    $email= $_GET['email'];
}

if(isset($_GET['password']))
{
    $password= $_GET['password'];
}


 $controllerObject = new Controller(); 

if( !empty($password) && !empty($email))
{
    $json_validate_user = $controllerObject->validateUser($email,$password);

    if(!empty($json_validate_user)){
            echo json_encode($json_validate_user);
            return json_encode($json_validate_user);
    }
}
$response = array();
$response["success"] =  -1;
$response["message"] = "All Values are required!";
 echo json_encode($response);
return json_encode($response);
?>
