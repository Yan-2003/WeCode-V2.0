<?php
require 'db.class.php';

class loginAPI{
    private $username;
    private $password;
    public $message;
    public $sendUsername;
    public $sendPassword;

    public function __construct($username, $password)
    {
        $this->username = trim(strtolower("@".$username));
        $this->password = trim($password);

        if($this->checkInput($username, $password) == true){
            if($this->checkuser($username, $password) == true){
                $this->loguser($username, $password);
            }
        }

    }

    private function checkInput($username, $password){
        if(empty($username)){
            $this->sendUsername = $username;
            $this->sendPassword = $password;
            $this->message = "Please input a username";
            return false;
        }
        if(empty($password)){
            $this->sendUsername = $username;
            $this->sendPassword = $password;
            $this->message = "Please input a password";
            return false;
        }
        return true;
    }


    private function checkuser($username, $password){
        $db = new db();
        $sql = "SELECT * FROM user";
        $result = mysqli_query($db->conn, $sql);
        while($user = mysqli_fetch_assoc($result)){
            if($user['username'] == $this->username){
                return true;
            }
        }
        $this->sendUsername = $username;
        $this->sendPassword = $password;
        $this->message = "This username does not exist";
        return false;
    }


    private function loguser($username, $password){
        $db = new db();
        $sql = "SELECT * FROM user";
        $result = mysqli_query($db->conn, $sql);
        while($user = mysqli_fetch_assoc($result)){
            if($user['username'] == $this->username){
                if(password_verify($this->password, $user['password'])){
                    session_start();
                    $_SESSION['username'] = $this->username;
                    header('Location: /home');
                }else{
                    $this->sendUsername = $username;
                    $this->sendPassword = $password;
                    $this->message = "You enter a wrong password.";
                }
            }
        }
    }

}
