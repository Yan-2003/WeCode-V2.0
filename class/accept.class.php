<?php
require 'class/db.class.php';

class acceptAPI{
    private $event;
    private $username;
    private $studentID;
    private $name;
    private $userpoll;
    private $id;
    private $dataPath;
    private $finalData;

    public function __construct($username)
    {
        $this->username = $username;
        if($this->checkuser() == true){
            $this->pushAccept();
        }
    }

    public function checkuser(){
        $db = new db();
        $sql = "SELECT * FROM user";
        $result = mysqli_query($db->conn, $sql);
        while($user = mysqli_fetch_assoc($result)){
            if($user['username'] == $this->username){
                $this->id = $user['id'];
                $this->name = $user['name'];
                $this->studentID = $user['studentID'];
                return true;
            }
        }
        return false;
    }

    public function pushAccept(){
        $this->userpoll = array(
            'id'=> $this->id,
            'username'=>$this->username,
            'name'=>$this->name,
            'studentID'=>$this->studentID,
            'scored'=>false
        );
        $this->event = json_decode(file_get_contents("database/post/event.json"), true);

        if($this->event['public'] != 0){
            $this->dataPath = json_decode(file_get_contents("database/userdata/user.json"), true);
            $this->dataPath[] = $this->userpoll;
            if(file_put_contents("database/userdata/user.json", json_encode($this->dataPath, JSON_PRETTY_PRINT))){
                return true;
            }
        }
        return false;
    }
}


?>