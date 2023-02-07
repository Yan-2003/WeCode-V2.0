<?php
session_start();
if($_SESSION['admin'] == NULL){
    header("Location: /login");
}
$people = json_decode(file_get_contents("database/userdata/user.json"), true);
$event = json_decode(file_get_contents("database/post/event.json"), true);

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
    <title>Admin:People</title>
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
                        <a class = "back" href="/admin/home">Back</a>
                    </div>
                </div>
        </div>
    </div>
    </header>
    <main class="people--container">
        <div class="people--main--content">
            <?php if($event != null){
                    if($event['public'] == 1){
                        echo "<p style = 'color: white'>Please Close the event to view and score the players.</p>";
                        }
                    }else{
                        echo "<p style = 'color: white'>No Event is Set.</p>";
                    }
            ?>
            <?php if($people != null && $event['public'] == 0):?>
            <?php foreach($people as $user):?>
            <?php if($user['scored'] != true):?>
            <div class="people--box">
                <div class="people--upper">
                    <p><?php echo $user['name']?></p>
                </div>
                <div class="people--lower">
                    <form action = "/admin/score" method="post">
                        <button type="submit" name="add" value="<?php echo $user['id']?>"><img width = "32"src="../assets/img/icon/blue_dice.png" alt=""></button>
                        <button type="submit" name="half" value="<?php echo $user['id']?>"><img width = "32"src="../assets/img/icon/logo.png" alt=""></button>
                        <button type="submit" name="remove" value="<?php echo $user['id']?>"><img width = "32"src="../assets/img/icon/red_dice.png" alt=""></button>
                    </form>
                </div>
            </div>
            <?php endif?>
            <?php endforeach?>
            <?php endif?>
        </div>
    </main>
</body>
</html>