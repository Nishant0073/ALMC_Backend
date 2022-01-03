<?php


$email = "";
if(isset($_GET['email']))
{
    $email= $_GET['email'];
}

require_once 'controller.php';
$controllerObject = new Controller(); 

$allAlumnus = $controllerObject->getYearReport($email);

if(!empty($allAlumnus))
{
   echo json_encode($allAlumnus);
    return json_encode($allAlumnus);
}

$response = array();
$response["success"] =  0;
$response["message"] = "Some Error occured while retriving data!";
echo json_encode($response);
return json_encode($response);

?>