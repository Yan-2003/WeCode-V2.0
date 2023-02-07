<?php
session_start();
if($_SESSION['admin'] == NULL){
    header("Location: /login");
}
require 'class/post.class.php';




if(isset($_POST['announce'])){
    $sendAnnounce = new announcementAPI($_POST['title'], $_POST['content']);              
}
if(isset($_POST['event'])){
    $sendpost = new eventAPI($_POST['title'],$_POST['date'],$_POST['time'],$_POST['content'], $_POST['category'],$_POST['level'], $_POST['blueD'], $_POST['redD']);
}

if(isset($_POST['eventClose'])){
    $sendclose = new eventClose();
}

if(isset($_POST['eventEnd'])){
    $sendEnd = new eventEnd();
}

if(isset($_POST['announceClose'])){
    $annclose = new announceClose();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/admin.css">
    <link rel="icon" href="../assets/img/icon/logo.png">
    <title>Admin:Post</title>
</head>
<body>
    <header class="header--box">
        <div class="header--main">
                <div class="header--content">
                    <a class="header--logo" href="">
                        <img width="45" src="../assets/img/icon/logo.png" alt="">
                        <p>Admin:We<span style="color: #F68A26;">Code</span></p>
                    </a>
                <div class="header--info">
                    <a href="/admin/home"><img width = "25" src="../assets/img/icon/logo.png" alt=""></a>
                </div>
            </div>
        </div>
    </header>
    <main class="post--container">
   
        <div class="post--main">
            <form action="" method="post" autocomplete="off" class="post--form--content">
                <h1>Event</h1>
                <p><?php echo @$sendpost->message.@$sendclose->message.@$sendEnd->message?></p>
                <input type="text" class="input--style" placeholder="Title" name="title" value="<?php echo @$sendpost->title?>">
                <div class="time--date">
                    <label for="date">
                        <p>Set Date:</p>
                        <input type="date" name="date" class="date" value="<?php echo @$sendpost->date?>">
                    </label>
                    
                    <label for="time">
                        <p>Set Time:</p>
                        <input type="time" name="time" class="time" value="<?php echo @$sendpost->time?>">
                        <img width = "45" src="assets/img/icon/clock.png" alt="">
                    </label>
                </div>
                <textarea class="input--style" name="content" cols="30" rows="10" placeholder="Say something.." ><?php echo @$sendpost->content?></textarea>
                <p>Category</p>
                <div class="category--icon">
                    <label for="spades">
                        <input type="radio" name="category" value="spades" class="click">
                        <img  width = "45" src="../assets/img/icon/symbol-of-spades.png" alt="">
                    </label>
                    <label for="clover">
                        <input type="radio" name="category" value="clover" class="click">
                        <img width = "45" src="../assets/img/icon/clover.png" alt="">
                    </label>
                    <label for="diamond">
                        <input type="radio" name="category" value="diamond" class="click">
                        <img width = "45" src="../assets/img/icon/diamond.png" alt="">
                    </label>
                    <label for="heart">
                        <input type="radio" name="category" value="hearts" class="click">
                        <img width = "45" src="../assets/img/icon/heart.png" alt="">
                    </label>
                </div>
                <input type="text" name="level" placeholder="Set level" class="input--style" value="<?php echo @$sendpost->level?>">
                <p>Dice</p>
                <input type="number" class="input--style" placeholder="Blue Dice" name="blueD" value="<?php echo @$sendpost->BlueDice?>">
                <input type="number" class="input--style" placeholder="Red Dice" name="redD" value="<?php echo @$sendpost->RedDice?>">
                <div class="send--post">
                    <button class="button--style" name="event" type="submit">Post</button>
                    <button class="button--style" name="eventClose" type="submit">Close</button>
                    <button class="button--style" name="eventEnd" type="submit">End</button>
                </div>
            </form>
            <form action="" method="post" class="announcement--form" enctype="multipart/form-data">
                <h1>Announcement</h1>
                <p><?php echo @$sendAnnounce->message; echo @$annclose->message?></p>
                <input type="text" name="title" placeholder="Title" class="input--style">
                <label for="files" class="file--main">
                    <input type="file"  id="files" name="files" accept="image/PNG" class="file" >
                </label>
                <textarea class="input--style" name="content" cols="30" rows="10" placeholder="Say something..."></textarea>
                <div class="send--post">
                    <button class="button--style" name="announce" type="submit">Post</button>
                    <button class="button--style" name="announceClose" type="submit">Close</button>
                </div>
            </form>
            
        </div>
    </main>
</body>
</html>