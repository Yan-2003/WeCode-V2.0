<?php 
require 'dice.class.php';
$event = json_decode(file_get_contents("database/post/event.json"), true);

function removelist($id){
    $user = json_decode(file_get_contents("database/userdata/user.json"), true);
    foreach($user as $users){
        if($users['id'] == $id){
            $users['scored'] = true;
            $newData[] = $users;
        }else{
            $newData[] = $users;
        }
    }
    file_put_contents("database/userdata/user.json", json_encode($newData, JSON_PRETTY_PRINT));
}
if(isset($_POST['add'])){
    $user = json_decode(file_get_contents("database/userdata/user.json"), true);
    foreach ($user as $users) {
        if($_POST['add'] == $users['id'] && $_users['scored'] == false){
            removelist($_POST['add']);
            $add = new addDiceAPI($users['studentID'], $event['blueDice']);
            header("Location: /admin/people");
        }else{
            echo "This user is already Scored.";
            header("Location: /admin/people");
            echo "This user is successfully Scored.";
        }
    }
}

if(isset($_POST['half'])){
    $user = json_decode(file_get_contents("database/userdata/user.json"), true);
    foreach ($user as $users) {
        if($_POST['half'] == $users['id'] && $_users['scored'] == false){
            removelist($_POST['half']);
            $add = new addDiceAPI($users['studentID'], $event['blueDice'] / 2);
            header("Location: /admin/people");
            echo "This user is successfully Scored.";
        }else{
            echo "This user is already Scored.";
            header("Location: /admin/people");
        }
    }
}

if(isset($_POST['remove'])){
    $user = json_decode(file_get_contents("database/userdata/user.json"), true);
    foreach ($user as $users) {
        if($_POST['remove'] == $users['id'] && $_users['scored'] == false){
            removelist($_POST['half']);
            $add = new RemoveDiceAPI($users['studentID'], $event['RedDice']);
            header("Location: /admin/people");
            echo "This user is successfully Scored.";
        }else{
            echo "This user is already Scored.";
            header("Location: /admin/people");
        }
    }
}




