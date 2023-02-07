<?php
require 'class/db.class.php';
session_start();
if($_SESSION['username'] == NULL){
    header('Location: /login');
}

$L = "";
$H = "";
$P = "active";



$rank2 = array(100,200,400,500);
$badge1 = array("coder","programmer","developer","engineer","done");
$badge2 = array("Coder","Programmer","Developer","Engineer","Done");
$name = "";
$rank = "";
$nrank = "";
$dice = "";
$idon = "";
$level = "";
$prolifeimg = "";
$db = new db();
$sql = "SELECT * FROM user";
$request = mysqli_query($db->conn, $sql);
while($user = mysqli_fetch_assoc($request)){
    if($user['username'] == $_SESSION['username']){
        $name = $user['name'];
        $rank = $badge2[$user['level']];
        $nrank = $badge2[$user['level']+1];
        $dice = $user['dice'];
        $level = $user['level'];
        $idon = $user['studentID'];
        $prolifeimg = $user['img'];
    }
}


$barProg = ($dice / $rank2[$level]) * 100;


if(isset($_POST['logout'])){
    session_unset();
    header("Location: /login");
}
if(isset($_POST['edit'])){
    header("Location: /edit");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/profile.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>WeCode: Profile</title>
</head>
<body>
<?php require'parts/header.php'?>
<main>
    <section class="profile">
        <div class="profile--content">
            <div class="profile--style">
                <div class="profile--box1">
                    <div class="profile--header">
                        <p>You're Profile</p>
                        <form class="tool--box" action="" method="post">
                            <button class="signout--btn" name="edit"><img width="20" style="filter:invert(1) ;" src="assets/img/icon/pencil.png" alt=""></button>
                            <button class="signout--btn" name="logout" type="submit"><img width="20"  src="assets/img/icon/logout.png" alt=""></button>
                        </form>
                    </div>
                    <div class="profile--main">
                        <img src="database/img/userProfile/<?php echo $prolifeimg?>" alt="" class="profile--pic">
                        <div class="profile--info">
                            <p id="myname"><?php echo $name?></p>
                            <p><?php echo $_SESSION['username']?></p>
                            <p><?php echo $idon?></p>
                        </div>
                    </div>
                </div>
                <div class="profile--box2">
                    <div class="profile--header">
                        <div class="header--box">
                            <p>You're Progress</p>
                        </div>
                    </div>
                    <div class="profile--card--box">
                        <div class="card--content">
                            <div class="rank--info">
                                <div class="rank--content">
                                    <img class="img--rank" src="assets/img/icon/<?php echo $badge1[$level].".png"?>" alt="">
                                    <p><?php echo $rank?></p>
                                    <h3>Current Rank:</h3>
                                </div>
                                <img class="img--rank" src="assets/img/icon/right-arrow.png" alt="">
                                <div class="rank--content">
                                    <img class="img--rank" src="assets/img/icon/<?php echo $badge1[$level+1].".png"?>" alt="">
                                    <p><?php echo $nrank?></p>
                                    <h3>Next Rank:</h3>
                                </div>
                            </div>
                            <div class="dice--collected">
                                <img src="assets/img/icon/blue_dice.png" alt="" class="img--dice">
                                <div class="dice--content">
                                    <p>Dice Collected: <?php echo $dice."/".$rank2[$level]?></p>
                                    <div class="bar">
                                        <style>
                                            @keyframes load {
                                                0%{
                                                    width: 0%;
                                                }
                                                100%{
                                                    width:  <?php echo $barProg?>;
                                                }
                                            }
                                        </style>
                                        <div class="prog--bar" style="width: <?php echo $barProg?>%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>