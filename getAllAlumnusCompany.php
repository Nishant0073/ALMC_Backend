<?php

//$email = "nishant@email.com";
$email = "";
$company = "";
if(isset($_GET['email']))
{
    $email= $_GET['email'];
}

if(isset($_GET['company']))
{
    $company= $_GET['company'];
}



require_once 'controller.php';
$controllerObject = new Controller(); 

$allAlumnus = $controllerObject->getAllAlumnusByCompany($email,$company);

if($allAlumnus['success']==1)
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