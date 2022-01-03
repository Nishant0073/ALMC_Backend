<?php

//$email = "satya@email.com";
$email = "";
if(isset($_GET['email']))
{
    $email= $_GET['email'];
}

require_once 'controller.php';
$controllerObject = new Controller(); 

$allAlumnus = $controllerObject->getAllAlumnus($email);

if(!empty($allAlumnus))
{
    // $allAlumnus['success'] = 1;
    // $allAlumnus['message'] = " Alumnus Data found!"; 
    echo json_encode($allAlumnus);
    return json_encode($allAlumnus);
}

$response = array();
$response["success"] =  0;
$response["message"] = "Some Error occured while retriving data!";
echo json_encode($response);
return json_encode($response);

?>