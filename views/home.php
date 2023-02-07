<?php
session_start();
if($_SESSION['username'] == NULL){
    header('Location: /login');
}

require 'class/accept.class.php';
$announce = json_decode(file_get_contents("database/post/announcement.json"), true);
$event = json_decode(file_get_contents("database/post/event.json"), true);
$user = json_decode(file_get_contents("database/userdata/user.json"), true);
$L = "";
$H = "active";
$P = "";
if(isset($_POST['accept'])){
    $acpt = new acceptAPI($_SESSION['username']);
    header("Location: /home");
}

$checkUser = false;
if($user != null){
    foreach($user as $users){
        if($users['username'] == $_SESSION['username']){
            $checkUser = true;
        }
    }    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/home.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>WeCode: Home</title>
</head>
<body>
    <?php require'parts/header.php'?>


<main>
    <section class="home">
        <div class="home--content">
<!-- This is the announcement section of the page -->
    <?php if($announce != null):?>
        <?php if($announce['public'] != 0):?>
            <div class="post--contents">
                <div class="post--header">
                    <div class="header--box">
                        <p>Announcement</p>
                    </div>
                </div>
                <div class="post--contents--main">
                    <div class="announce--upper">
                        <h1 class="title"><?php echo $announce['title']?></h1>
                        <p><?php echo $announce['content']?></p>
                    </div>
                    <div class="announce--lower"><img src="database/img/picture/img.png" alt=""></div>
                </div>
            </div>
        <?php endif?>
    <?php endif?>
<!--(end of) This is the annoument section of the page -->

<!-- this is the post event section that see the user but not accept -->
        <?php if($event != null):?>
            <?php if($checkUser == false && $event['public'] == 1):?>
               <div class="post--contents">
                    <div class="post--header">
                        <div class="header--box">
                            <p>Event</p>
                        </div>
                        <div class="event--date--time">
                            <p>Event Start: <?php echo $event['date']." ".$event['time']?></p>
                        </div>
                    </div>
                    <div class="post--contents--main">
                            <div class="event--upper">
                                <h1 class="title">New Event is Available!</h1>
                                <p class="emoji" >(> ^ 3 ^)></p>
                                
                            </div>
                            <div class="event--lower--contents">
                                <p>Once you enter there is no turning back.</p>
                            </div>
                            <form action="" method="post">
                                <button class="accept" type="submit" name="accept">Accept</button>
                            </form>
                        </div>
                        
                    </div>
               </div>
            <?php endif?>
        <?php endif?>
<!--(end of) this is the post event section that see the user but not accept -->


<!-- this is the post event section that see the user and accept the event-->
        <?php if($event != null):?>
            <?php if($checkUser == true):?>
               <div class="post--contents">
                    <div class="post--header">
                        <div class="header--box">
                            <p>Event: </p>
                        </div>
                        <div class="event--date--time">
                            <p>Event Start: <?php echo $event['date']." ".$event['time']?></p>
                        </div>
                    </div>
                    <div class="post--contents--main">
                        <div class="event--puper">
                            <h1 class="title"><?php echo $event['title']?></h1>
                        </div>
                        <div class="event--lower">
                            <div class="event--category">
                                <img width = "64" src="assets/img/icon/<?php echo $event['category'].".png"?>" alt="">
                                <h3>of <?php echo $event['level']?></h3>
                            </div>
                                <p class="event--text"><?php echo $event['content']?></p>
                            <div class="event--lower--contents">
                                <div class="dice--style">
                                    <img width="45" src="assets/img/icon/blue_dice.png" alt="">
                                    <h3><?php echo $event['blueDice']?></h3>
                                </div>
                                <div class="dice--style">
                                    <img width="45" src="assets/img/icon/red_dice.png" alt="">
                                    <h3><?php echo $event['RedDice']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            <?php endif?>
        <?php endif?>
<!--(end of) this is the post event section that see the user and accept the event-->

<!-- this is the post event section that see user in close and not accpet-->
<?php if($event != null):?>
            <?php if($event['public'] == 0 && $checkUser == false):?>
               <div class="post--contents">
                    <div class="post--header">
                        <div class="header--box">
                            <p>Event: </p>
                        </div>
                        <div class="event--date--time">
                            <p>Event Start: <?php echo $event['date']." ".$event['time']?></p>
                        </div>
                    </div>
                    <div class="post--contents--main">
                        <div class="event--upper">
                            <h1 class="title">Challange Close!</h1>
                            <p class="emoji">(> x _ x)></p>
                            <p>You just received a red dice in this event.</p>
                        </div>
                        <div class="event--lower">
                            <div class="event--lower--contents">
                                <div class="dice--style">
                                    <img width="45" src="assets/img/icon/red_dice.png" alt="">
                                    <h3><?php echo $event['RedDice']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            <?php endif?>
        <?php endif?>
<!--(end of) this is the post event section that see user in close and not accpet-->


<!-- this is the post event section that no event avialable-->
<?php if($event == null):?>
               <div class="post--contents">
                    <div class="post--header">
                        <div class="header--box">
                            <p>Event: </p>
                        </div>
                    </div>
                    <div class="post--contents--main">
                        <div class="event--puper">
                            <h1 class="title">No Event Available!</h1>
                        </div>
                        <div class="event--lower">
                            <p>please wait for further announcement.</p>
                            <img class="no--event--img" width="128" src="assets/img/icon/cancel-event.png" alt="">
                        </div>
                    </div>
               </div>
 <?php endif?>
<!--(end of) this is the post event section that no event available-->





        </div>
    </section>
</main>




</body>
</html>