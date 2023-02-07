<?php
 

class db{
    private $servername = "localhost:3306";
    private $username = "root";
    private $password = "Jul-092003";
    private $databasename = "wecode";
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

