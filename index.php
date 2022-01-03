<?php
require_once 'controller.php';
$name = "";
$password = "";
$department = "";
$email = "";
$role = "";

if(isset($_POST['name']))
{
    $name = $_POST['name'];
}

if(isset($_POST['password']))
{
    $password= $_POST['password'];
}

if(isset($_POST['department']))
{
    $department= $_POST['department'];
}

if(isset($_POST['email']))
{
    $email= $_POST['email'];
}

if(isset($_POST['role']))
{
    $role = $_POST['role'];
}

 $controllerObject = new Controller(); 

if(!empty($name) && !empty($password) && !empty($department) && !empty($email) && !empty($role))
{
    $json_registration = $controllerObject->CreateController($name,$password,$department,$email,$role);

    if(!empty($json_registration)){
            return json_encode($json_registration);
    }
}
$response = array();
$response["message"] = "All Values are required!";
return json_encode($response);
?>
