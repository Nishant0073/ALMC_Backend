<?php

$email = "";
//$email = "";
$AlumniRegId = "";

if(isset($_GET['email']))
{
    $email= $_GET['email'];
}

if(isset($_GET['AlumniRegId']))
{
    $AlumniRegId= $_GET['AlumniRegId'];
}



require_once 'controller.php';
$controllerObject = new Controller(); 

$Alumni = $controllerObject->SearchByAlumniRegID($email,$AlumniRegId);

if(!empty($Alumni))
{
    // $allAlumnus['success'] = 1;
    // $allAlumnus['message'] = " Alumnus Data found!"; 
    echo json_encode($Alumni);
    return json_encode($Alumni);
}

$response = array();
$response["success"] =  0;
$response["message"] = "Some Error occured while retriving data!";
echo json_encode($response);
return json_encode($response);

?>