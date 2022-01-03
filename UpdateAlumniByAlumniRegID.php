<?php

$email = "";

$AlumniRegId = "";
$AlumniName = "";
$EmailID = "";
$Password = "";
$ContactNo = "";
$CompnyNameAdd = "";
$Designation = "";
$Package = "";
$CoPassword = "";
$PassoutYear = "";
$Department = "";
$ProfilePic = "";
$LnkdInLink = "";

if(isset($_POST['email']))
{
    $email= $_POST['email'];
}

if(isset($_POST['AlumniRegId']))
{
    $AlumniRegId= $_POST['AlumniRegId'];
}
if(isset($_POST['AlumniName']))
{
    $AlumniName= $_POST['AlumniName'];
}
if(isset($_POST['EmailID']))
{
    $EmailID= $_POST['EmailID'];
}
if(isset($_POST['Password']))
{
    $Password= $_POST['Password'];
}
if(isset($_POST['ContactNo']))
{
    $ContactNo= $_POST['ContactNo'];
}
if(isset($_POST['CompnyNameAdd']))
{
    $CompnyNameAdd= $_POST['CompnyNameAdd'];
}
if(isset($_POST['Designation']))
{
    $Designation= $_POST['Designation'];
}
if(isset($_POST['Package']))
{
    $Package= $_POST['Package'];
}
if(isset($_POST['CoPassword']))
{
    $CoPassword= $_POST['CoPassword'];
}
if(isset($_POST['PassoutYear']))
{
    $PassoutYear= $_POST['PassoutYear'];
}
if(isset($_POST['Department']))
{
    $Department= $_POST['Department'];
}
if(isset($_POST['ProfilePic']))
{
    $ProfilePic= $_POST['ProfilePic'];
}
if(isset($_POST['LnkdInLink']))
{
    $LnkdInLink= $_POST['LnkdInLink'];
}

require_once 'controller.php';
$controllerObject = new Controller(); 

$Alumni = $controllerObject->UpdateProfileByAlumniRegId($email,$AlumniRegId,$AlumniName,$EmailID,$Password,$ContactNo,$CompnyNameAdd,$Designation,$Package,$CoPassword,$PassoutYear,$Department,$ProfilePic,$LnkdInLink);
if(!empty($Alumni))
{
    echo json_encode($Alumni);
    return json_encode($Alumni);
}

$response = array();
$response["success"] =  0;
$response["message"] = "Some Error occured while updateing data!";
echo json_encode($Alumni);
return json_encode($response);

?>