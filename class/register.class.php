<?php 

require 'db.class.php';

class registerAPI{
    private $username;
    private $name;
    private $studentid;
    private $email;
    private $password;
    private $cpassword;
    public $message;
    public $sendUsername;
    public $sendName;
    public $sendStudentID;
    public $sendEmail;
    public $sendPassword;
    public $sendCPasword;


    public function __construct($username, $name, $studentid, $email, $password, $cpassword)
    {
        $this->username = trim(strtolower("@".$username));
        $this->email = $email;
        $this->name = trim($name);
        $this->studentid = trim($studentid);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->cpassword = $cpassword;
        if($this->checkinput($username, $name, $studentid, $email, $password, $cpassword) == true){
            if($this->checkUser($username, $name, $studentid, $email, $password, $cpassword) == true){
                $this->pushUser();
            }
        }
    }

    private function checkinput($username, $name, $studentid, $email, $password, $cpassword)
    {
        if(empty($username)){
            $this->sendName = $name;
            $this->sendStudentID = $studentid;
            $this->sendEmail = $email;
            $this->sendPassword = $password;
            $this->sendCPasword = $cpassword;
            $this->message = "Please input a username.";
            return false;
        }
        if(empty($name)){
            $this->sendUsername = $username;
            $this->sendStudentID = $studentid;
            $this->sendEmail = $email;
            $this->sendPassword = $password;
            $this->sendCPasword = $cpassword;
            $this->message = "Please input your name."; 
            return false;
        }
        if(empty($studentid)){
            $this->sendName = $name;
            $this->sendUsername = $username;
            $this->sendEmail = $email;
            $this->sendPassword = $password;
            $this->sendCPasword = $cpassword;
            $this->message = "Please input your student id."; 
            return false;
        }
        if(empty($email)){
            $this->sendName = $name;
            $this->sendStudentID = $studentid;
            $this->sendUsername = $username;
            $this->sendPassword = $password;
            $this->sendCPasword = $cpassword;
            $this->message = "Please input your email."; 
            return false;
        }
        if(empty($password)){
            $this->sendName = $this->name;
            $this->sendStudentID = $this->studentid;
            $this->sendEmail = $this->email;
            $this->sendUsername = $this->username;
            $this->sendCPasword = $this->cpassword;
            $this->message = "Please input a password."; 
            return false;
        }
        if(empty($cpassword)){
            $this->sendName = $this->name;
            $this->sendStudentID = $this->studentid;
            $this->sendEmail = $this->email;
            $this->sendPassword = $this->password;
            $this->sendUsername = $this->username;
            $this->message = "Please input a confirm password."; 
            return false;
        }

        if($password != $cpassword){
            $this->sendName = $this->name;
            $this->sendStudentID = $this->studentid;
            $this->sendEmail = $this->email;
            $this->sendPassword = $password;
            $this->sendCPasword = $this->cpassword;
            $this->sendUsername = $this->username;
            $this->message = "Password did not match."; 
            return false;
        }


        return true;
    }



    private function checkUser($username, $name, $studentid, $email, $password, $cpassword){
        $db = new db();
        $sql = "SELECT username FROM user";
        $result = mysqli_query($db->conn, $sql);
        while($user = mysqli_fetch_assoc($result)){
            if($user['username'] == $this->username){
                $this->sendName = $name;
                $this->sendStudentID = $studentid;
                $this->sendEmail = $email;
                $this->sendPassword = $password;
                $this->sendCPasword = $cpassword;
                $this->sendUsername = $username;
                $this->message = "This username is already taken.";
                return false;
            }
            if($user['studentID'] == $studentid){
                $this->sendName = $name;
                $this->sendStudentID = $studentid;
                $this->sendEmail = $email;
                $this->sendPassword = $password;
                $this->sendCPasword = $cpassword;
                $this->sendUsername = $username;
                $this->message = "This ID is already used.";
                return false;
            }
        }
        return true;
    }


    private function pushUser(){
        $db = new db();
        $sql = "INSERT INTO user(username,name,studentID,email,password,level,dice,img)
        VALUE('".$this->username."','".$this->name."','".$this->studentid."','".$this->email."','".$this->password."',0,0,'global.png');
        ";
        if(mysqli_query($db->conn, $sql)){
            $this->message = "You are now registered.";
        }else{
            $this->message = "Failed to register.";
        }



    }


}