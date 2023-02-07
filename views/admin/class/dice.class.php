
<?php
require 'class/db.class.php';


class addDiceAPI{
    private $path;
    private $id;
    private $dice;
    private $db;
    private $rank;
    private $sql;
    private $result;
    private $newDice;
    private $newlevel;
    public $message;

    public function __construct($id, $dice)
    {
        $this->id = trim($id);
        $this->dice = $dice;
        $this->db = new db();
        $this->sql = "SELECT * FROM user";
        $this->result = mysqli_query($this->db->conn, $this->sql);
        if($this->checkInput() == true){
            if($this->checkID() == true){
                if($this->setdice() == true){
                    $this->update($this->newDice,$this->newlevel);
                }
            }
        }
        
    }
    private function setdice(){
        $this->rank = array(100,200,400,500);
        $this->sql = "SELECT * FROM user";
        $this->result = mysqli_query($this->db->conn, $this->sql);
        while($user = mysqli_fetch_assoc($this->result)){

            $this->newlevel = $user['level'];
            $this->newDice = $user['dice'] + $this->dice;

            if($user['studentID'] == $this->id){
                $this->path = (int) $user['id'];
                if($this->newDice >= 500 && $this->newlevel >= 3){
                    $this->newlevel = 3;
                    $this->newDice = 500;
                    return true;
                }
                if($this->newDice > $this->rank[$user['level']]){
                    $this->newlevel = $user['level'] + 1;
                    $this->newDice = $this->newDice - $this->rank[$user['level']];
                    return true;
                }
                return true;
            }
        }
        return false;
    }

    private function checkInput(){
        if(empty($this->id)){
            $this->message = "Please Enter a Student ID NO.";
            return false;
        }
        if(empty($this->dice)){
            $this->message = "Please Enter a Dice value.";
            return false;
        }
        if($this->dice > 90){
            $this->message = "Max value is 90 Dice";
            return false;
        }
        return true;
    }

    private function checkID(){
        while($user = mysqli_fetch_assoc($this->result)){
            if($user['studentID'] == $this->id){
                return true;
            }
        }
        $this->message = "This id: ". $this->id." is not found.";
        return false;
    }

    private function update($dice, $level){
        $sql = "UPDATE user SET dice=".$dice.",level=".$level." WHERE id=".$this->path.";";
        if(mysqli_query($this->db->conn, $sql)){
            $this->message = "Successfully add Dice to id: ".$this->id;
        }else{
            $this->message = "Failed to add Dice to id: ".$this->id;
        }

    }

}

class RemoveDiceAPI{
    private $path;
    private $id;
    private $dice;
    private $db;
    private $rank;
    private $sql;
    private $result;
    private $newDice;
    private $newlevel;
    public $message;

    public function __construct($id, $dice)
    {
        $this->id = trim($id);
        $this->dice = $dice;
        $this->db = new db();
        $this->sql = "SELECT * FROM user";
        $this->result = mysqli_query($this->db->conn, $this->sql);
        if($this->checkInput() == true){
            if($this->checkID() == true){
                if($this->setdice() == true){
                    $this->update($this->newDice,$this->newlevel);
                }
            }
        }
        
    }
    private function setdice(){
        $this->rank = array(100,200,400,500);
        $this->sql = "SELECT * FROM user";
        $this->result = mysqli_query($this->db->conn, $this->sql);
        while($user = mysqli_fetch_assoc($this->result)){
            if($user['studentID'] == $this->id){
                $this->path = (int) $user['id'];

                $this->newlevel = $user['level'];
                $this->newDice =  $user['dice'] - $this->dice;

                if($this->newDice <= $this->rank[$user['level']]){
                    if($this->newlevel > 0 && $this->newDice <= 0){
                        $this->newDice = $this->newDice + $this->rank[$user['level']-1];
                        $this->newlevel = $user['level'] - 1;
                        return true;
                    }
                    if($this->newDice <= 0 && $user['level'] <= 0){
                        $this->newlevel = 0;
                        $this->newDice = 0;
                        return true;
                    }
                } 
                return true;
            }
        }
        return false;
    }


    private function checkInput(){
        if(empty($this->id)){
            $this->message = "Please Enter a Student ID NO.";
            return false;
        }
        if(empty($this->dice)){
            $this->message = "Please Enter a Dice value.";
            return false;
        }
        if($this->dice > 90){
            $this->message = "Max value is 90 Dice";
            return false;
        }
        return true;
    }

    private function checkID(){
        while($user = mysqli_fetch_assoc($this->result)){
            if($user['studentID'] == $this->id){
                return true;
            }
        }
        $this->message = "This id: ". $this->id." is not found.";
        return false;
    }

    private function update($dice, $level){
        $sql = "UPDATE user SET dice=".$dice.",level=".$level." WHERE id=".$this->path.";";
        if(mysqli_query($this->db->conn, $sql)){
            $this->message = "Successfully remove Dice to id: ".$this->id;
        }else{
            $this->message = "Failed to remove Dice to id: ".$this->id;
        }

    }
    
}