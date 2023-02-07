<?php
session_start();
if($_SESSION['username'] == NULL){
    header('Location: /login');
}

$L = "active";
$H = "";
$P = "";



require 'class/db.class.php';
$rank = array(100,200,400,500);
$badge = array("coder","programmer","developer","engineer");


$db = new db();
$sql = "SELECT * FROM user ORDER BY level DESC, dice DESC, name";
$num = 1;
$request = mysqli_query($db->conn, $sql);







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/leaderboard.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>WeCode: Leaderboard</title>
</head>
<body>
<?php require'parts/header.php'?>
<main>
    <section class="leaderboard">
        <div class="leaderboard--content">
            <?php while($user = mysqli_fetch_assoc($request)):?>
                <?php if($user['dice'] != 0):?>
                <div class="user--content">
                    <div class="header--box <?php if($num == 1){echo "top";}?>">
                        <h1><?php echo $num; $num++;?></h1>
                    </div>
                    <div class="user--main">
                        <div class="user--box1">
                        <img src="database/img/userProfile/<?php echo $user['img']?>" alt="" class="leaderboard--prof--pic">
                        <p><?php echo $user['name']?></p>
                        </div>
                        <div class="user--box2">
                            <img width = "20" src="assets/img/icon/blue_dice.png" alt="">
                            <p><?php echo $user['dice']."|".$rank[$user['level']]?></p>
                            <img width = "15" src="assets/img/icon/<?php echo $badge[$user['level']].".png" ?>" alt="">
                        </div>
                    </div>
                </div>
                <?php endif?>
            <?php endwhile?>
        </div>
    </section>
</main>
</body>
</html>