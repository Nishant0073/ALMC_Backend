<?php

include_once 'config.php';

class DbConnect{

    private $connect;
    public function __construct()
    {

        $this->connect = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if(!$this->connect)
        {
            //  echo "Unable to connect to MYSQL".mysqli_connect_error();
        }
        else
        {
            //  echo "Connected to DB";
        }
    }

    public function getDB()
    {
        return $this->connect;
    }

}
?>
