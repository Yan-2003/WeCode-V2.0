<?php
 

class db{
    private $servername = "***";
    private $username = "***";
    private $password = "****";
    private $databasename = "****";
    public $conn;
    public $test;

    public function __construct()
    {
        $this->conn = mysqli_Connect($this->servername,$this->username,$this->password,$this->databasename);
       
       if(!$this->conn){
           echo "[Error]:failed to connect to database" . $this->databasename;
       }
    }
}

