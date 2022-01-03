<?php
include_once 'db-connect.php';

class Controller{

    private $db;
    private $controller_table = "Controller";

    public function __construct()
    {
        $this->db= new DbConnect();
    }

    public function CreateController($name, $password,$department,$email,$role)
    {
    
        $query = "insert into ".$this->controller_table."(Name, Password, Department, Email, Role) VALUES('$name','$password','$department','$email','$role')";
        $conn = $this->db->getDb();
        if($conn->query($query)==TRUE){
            $json['success'] = 1;
            $json['message'] = "Successfully registered the user";
            return $json;
            //echo json_encode($json);

        }else{

            $json['success'] = 0;
            $json['message'] = $conn->error;
            return $json;
           // echo json_encode($json);
            //$json['message'] = "Error in registering. Probably the Controller already exists";
        }

        mysqli_close($this->db->getDb());
    } 

    public function validateUser($email,$password)
    {

        $query = "SELECT * FROM `Controller` WHERE `Email` = '$email'";
        $conn = $this->db->getDb();
        $result = $conn->query($query);
        
        if($result->num_rows>0)
        {
            $row = mysqli_fetch_assoc($result);
            $hash = $row["Password"];
            if(password_verify($password,$hash))
            {
                $json['success'] = 1;
                $json['message'] = "User is Authenticated.";
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "Incorrect Password.";
            }
        }
        else
        {
            $json['success'] = -1;
            $json['message'] = "Incorrect Email."; 
        }
        return $json;
    }


    public function getAlumniYear($year)
    {
        $query = "";
    

    }

    public function getAllAlumnus($email)
    {

        $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
        $conn = $this->db->getDb();
        $result = $conn->query($query);
        
        if($result->num_rows>0)
        {
            $row = mysqli_fetch_assoc($result);
            $department = $row["Department"];
            //echo $department;

            $query = "SELECT * FROM `Alumni` where Department = '$department' order by `RegID`";
            $conn = $this->db->getDb();
            $result = $conn->query($query);

                if($result->num_rows>0)
                {
                    //$row = mysqli_fetch_assoc($result);
                    $json = array();
                    while($r = mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        //$row_array['result'] = $r;
                        array_push($json,$r); // here we push every iteration to an array otherwise you will get only last iteration value
                    }
                    $json['success'] = 1;
                    $json['message'] = "Alumnus found!"; 
                    return $json;
                }
                else
                {
                    $json['success'] = 0;
                    $json['message'] = "No Alumnus found!"; 
                }
        }
        else
        {
            $json['success'] = 0;
            $json['message'] = "No able to access coordinator account!"; 
        }
    
        return $json;
    }


function getAllAlumnusByCompany($email,$company)
{
    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
        //echo $department;

        $query = "SELECT * FROM `Alumni` where Department = '$department' AND CompyNameAdd='$company'";
        $conn = $this->db->getDb();
        $result = $conn->query($query);

            if($result->num_rows>0)
            {
                //$row = mysqli_fetch_assoc($result);
                $json = array();
                while($r = mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    //$row_array['result'] = $r;
                    array_push($json,$r); // here we push every iteration to an array otherwise you will get only last iteration value
                }
                $json['success'] = 1;
                $json['message'] = "Alumnus found!"; 
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumnus found!"; 
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!"; 
    }

    return $json;
}

function getAllAlumnusByYear($email,$year)
{
    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
        //echo $department;
        //echo $year;

        $query = "SELECT * FROM `Alumni` where Department = '$department' AND PassoutYear='$year'";
        $conn = $this->db->getDb();
        $result = $conn->query($query);

            if($result->num_rows>0)
            {
                $row = mysqli_fetch_assoc($result);
                $json = array();
                while($r = mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    //$row_array['result'] = $r;
                    array_push($json,$r); // here we push every iteration to an array otherwise you will get only last iteration value
                }
                $json['success'] = 1;
                $json['message'] = "Alumnus found!"; 
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumnus found!"; 
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!"; 
    }

    return $json;
}


function SearchByAlumniRegID($email,$AlumniRegId)
{
    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
       

        $query = "select * FROM `Alumni` where Department = '$department' AND `AlmniRegID` = '$AlumniRegId'";
        $conn = $this->db->getDb();
        $result = $conn->query($query);

            if($result->num_rows>0)
            {
                $row = mysqli_fetch_assoc($result);
                $json = array();
         
                $json['alumni'] = $row;
                $json['success'] = 1;
                $json['message'] = "Alumnus found!"; 
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumni with id $AlumniRegId found!"; 
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!!"; 
    }

    return $json;
}


function UpdateProfileByAlumniRegId($email,$AlumniRegId,$AlumniName,$EmailID,$Password,$ContactNo,$CompnyNameAdd,$Designation,$Package,$CoPassword,$PassoutYear,$Department,$ProfilePic,$LnkdInLink)
{
    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
        
        $query = "UPDATE `Alumni` SET `AlmniRegId`='$AlumniRegId' , `AlmniName`='$AlumniName' ,`EmailID` = '$EmailID',`Password`='$Password', `ContactNo`='$ContactNo',`CompyNameAdd`='$CompnyNameAdd',`Designation`='$Designation',`Package`='$Package',`CoPassword`='$CoPassword',`PassoutYear`='$PassoutYear',`Department`='$Department',`ProfilePic`='$ProfilePic',`LnkdInLink`='$LnkdInLink' WHERE `Alumni`.`Department` = '$department' AND `Alumni`.`AlmniRegID` = '$AlumniRegId'";
        //echo "UPDATE `Alumni` SET `AlmniRegId`='$AlumniRegId' , `AlmniName`='$AlumniName' ,`EmailID` = '$EmailID',`Password`='$Password', `ContactNo`='$ContactNo',`CompyNameAdd`='$CompnyNameAdd',`Designation`='$Designation',`Package`='$Package',`CoPassword`='$CoPassword',`PassoutYear`='$PassoutYear',`Department`='$Department',`ProfilePic`='$ProfilePic',`LnkdInLink`='$LnkdInLink' WHERE `Alumni`.`Department` = '$department' AND `Alumni`.`AlmniRegID` = '$AlumniRegId'";
       
    //echo "The id is:"+$AlumniRegId;

        $conn = $this->db->getDb();

        if($conn->query($query)==TRUE)
            {
             
               $json = array();
                $json['success'] = 1;
                $json['message'] = "Alumni Profile Updated!"; 
                $json['error'] = $conn->error;
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumni with id $AlumniRegId found!"; 
                $json['error'] = $conn->error;
                return $json;
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!"; 

    return $json;

    }
}

function getYearReport($email)
{

    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
        //echo $department;

        $query ="SELECT `PassoutYear` FROM `Alumni` WHERE `Department` = '$department' order by `PassoutYear`";
        $conn = $this->db->getDb();
        $result = $conn->query($query);

            if($result->num_rows>0)
            {
                //$row = mysqli_fetch_assoc($result);
                $json = array();
                while($row = $result->fetch_assoc())
                {
                    $json[] = $row['PassoutYear'];
                }
                //echo json_encode($json);
               // $json = array_count_values($json);
                $json['success'] = 1;
                $json['message'] = "Alumnus found!"; 
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumnus found!"; 
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!"; 
    }

    return $json;

}
    
function getCompanyWiseReport($email)
{

    $query = "SELECT * FROM `Controller` WHERE Email = '$email'";
    $conn = $this->db->getDb();
    $result = $conn->query($query);
    
    if($result->num_rows>0)
    {
        $row = mysqli_fetch_assoc($result);
        $department = $row["Department"];
        //echo $department;

        $query ="SELECT `CompyNameAdd`  FROM `Alumni` WHERE `Department` = '$department' order by `CompyNameAdd` ";
        $conn = $this->db->getDb();
        $result = $conn->query($query);

            if($result->num_rows>0)
            {
                //$row = mysqli_fetch_assoc($result);
                $json = array();
                while($row = $result->fetch_assoc())
                {
                    $json[] = $row['CompyNameAdd'];
                }
                //echo json_encode($json);
               // $json = array_count_values($json);
                $json['success'] = 1;
                $json['message'] = "Alumnus found!"; 
                return $json;
            }
            else
            {
                $json['success'] = 0;
                $json['message'] = "No Alumnus found!"; 
            }
    }
    else
    {
        $json['success'] = 0;
        $json['message'] = "No able to access coordinator account!"; 
    }

    return $json;

}
    
}

?>

