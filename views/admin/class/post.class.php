<?php
require 'dice.class.php';


class announcementAPI{
    private $title;
    private $content;
    public $message;
    private $data;
    private $finaldata;
    private $newData;

    public function __construct($title, $content)
    {
        $this->title = trim($title);
        $this->content = trim($content);
        $this->newData = array(
            'public'=>1,
            'title'=>$this->title,
            'content'=>$this->content,
            'img'=>'img.png'
        );
        if($this->checkInput($title, $content) == true){
            if($this->postAnnounce() == true && $this->uploadIMG() == true){
                $this->message = "Successfully Posted.";
            }else{
                $this->message = "Failed to Post.";
            }
        }

    }

    private function checkInput($title,$content)
    {
        if(empty($title) || empty($content)){
            $this->message = "Please fill out all.";
            return false;
        }
        return true;
    } 
    private function postAnnounce(){
            $this->data = json_decode(file_get_contents("database/post/announcement.json"), true);
            $this->data = $this->newData;
            $this->finaldata = file_put_contents("database/post/announcement.json",json_encode($this->data, JSON_PRETTY_PRINT));
            return true;
        } 

    private function uploadIMG(){
        $serverPath = $_SERVER['DOCUMENT_ROOT']."/database/img/picture/";
        $file = $_FILES['files']['tmp_name'];
        $fileName = $_FILES['files']['name'];
        $fileSize = $_FILES['files']['size'];
        $fileNameinArray = explode('.', $fileName);
        $fileExtenion = strtolower(end($fileNameinArray));
        if($fileSize < 1000000){
            if($fileExtenion == 'png'){
                if(move_uploaded_file($file,$serverPath."img.png")){
                    return true;
                }
            }
        }
        return false;
    }
    
}

class eventAPI{
    public $title;
    public $date;
    public $time;
    public $content;
    public $category = "";
    public $level;
    public $BlueDice;
    public $RedDice;
    private $dataPath = "database/post/event.json";
    private $dataGet;
    private $finaldata;
    private $data;
    public $message;


    public function __construct($title, $date, $time, $content, $category, $level, $BlueDice, $RedDice)
    {
        $this->title = trim($title);
        $this->date = $this->getDate($date);
        $this->time = $this->getTime($time);
        $this->content = $content;
        $this->category = $category;
        $this->level = $level;
        $this->BlueDice = $BlueDice;
        $this->RedDice = $RedDice;

        $this->data = array(

            "public"=>1,
            "title"=>$this->title,
            "date"=>$this->date,
            "time"=>$this->time,
            "content"=>$this->content,
            "category"=>$this->category,
            "level"=>$this->level,
            "blueDice"=>$this->BlueDice,
            "RedDice"=>$this->RedDice
        );
    
        if($this->checkInput($title, $date, $time, $content, $category, $level, $BlueDice, $RedDice) == true){
            if($this->postEvent() == true){
                $this->message = "Posted Successfully";
            }else{
                $this->message = "Failed to Post.";
            }
        }



    }
    private function checkInput($title, $date, $time, $content, $category, $level, $BlueDice, $RedDice)
    {
        if(empty($title)){
            $this->message = "Please set a title.";
            return false;
        }
        if(empty($date)){
            $this->message = "Please set a date.";
            return false;

        }
        if(empty($time)){
            $this->message = "Please set a time.";
            return false;
        }
        if(empty($content)){
            $this->message = "Please set a content.";
            return false;
        }
        if($category == ""){
            $this->message = "Please set a category.";
            return false;
        }
        if(empty($level)){
            $this->message = "Please set a Difficulty.";
            return false;
        }
        if(empty($BlueDice)){
            $this->message ="Please set a Blue Dice";
            return false;
        }
        if(empty($RedDice)){
            $this->message = "Please set a Red Dice.";
        }
        return true;
    }

    private function postEvent(){
        $this->dataGet = json_decode(file_get_contents($this->dataPath, true));
        $this->dataGet = $this->data;
       if( $this->finaldata = file_put_contents($this->dataPath,json_encode($this->dataGet, JSON_PRETTY_PRINT))){
            return true;
       }
       return false;
    }
    private function getTime($time){
        $time = explode(":", $time);
        $standard = "";
        if($time[0] > 12){
            $time[0] = $time[0] - 12;
            $standard = " PM";
        }else{
            $standard = " AM";
        }
        $final_time = $time[0].":".$time[1].$standard;
        return $final_time;
    }

    private function getDate($date){
        $date = explode("-", $date);
        $month = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $finaldate = $month[$date[1]-1]." ".$date[2]." ".$date[0];
        return $finaldate;
    }


}

class eventEnd{
    private $event;
    private $people;
    public $message;
    public function __construct()
    {
        $this->event  = json_decode(file_get_contents("database/post/event.json"), true);
        $this->people  = json_decode(file_get_contents("database/userdata/user.json"), true);
        if($this->event['public'] == 0){
            $DB = new db();
            $sql = "SELECT * FROM user";
            $result = mysqli_query($DB->conn, $sql);
            if($this->event != null){
                while($userDB = mysqli_fetch_assoc($result)){
                    if( $this->checkAccept($userDB['username']) != true){
                        new RemoveDiceAPI($userDB['studentID'], $this->event['RedDice']);
                    }
                }
                $this->event = null;
                $this->people = null;
                if(file_put_contents("database/post/event.json",json_encode($this->event, JSON_PRETTY_PRINT)) && file_put_contents("database/userdata/user.json",json_encode($this->people, JSON_PRETTY_PRINT))){
                    $this->message = "Event Successfully End";
                }else{
                    $this->message = "Event Failed to End";
                }
            }else{
                $this->message = "Event Failed to End";
            }
        }else{
            $this->message = "Please close the event first.";
        }
    }

    private function checkAccept($userDB){
        $userAccpet = json_decode(file_get_contents("database/userdata/user.json"), true);
        if($userAccpet != null){
            foreach($userAccpet as $user){
                if($userDB == $user['username']){
                    return true;
                }
            }
        }
        return false;
    }
}



class eventClose{
    private $event;
    public $message;

    public function __construct()
    {
        $this->event  = json_decode(file_get_contents("database/post/event.json"), true);
        if($this->event != null){
            $this->event['public'] = 0;
            if(file_put_contents("database/post/event.json",json_encode($this->event, JSON_PRETTY_PRINT))){
                $this->message = "Event Successfully Close.";
            }
        }else{
            $this->message = "Event Failed to Close.";
        }
    }

}

class announceClose{
    private $announce;
    public $message;
    public function __construct()
    {
        $this->announce  = json_decode(file_get_contents("database/post/announcement.json"), true);
        $this->announce['public'] = 0;
        if(file_put_contents("database/post/announcement.json",json_encode($this->announce, JSON_PRETTY_PRINT))){
            $this->message = "Announcement Successfully Close";
        }else{
            $this->message = "Announcement Failed to Close";
        }
    }
}

