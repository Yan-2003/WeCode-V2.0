<?php
session_start();
if($_SESSION['admin'] == NULL){
    header("Location: /admin");
}
require 'class/dice.class.php';
if(isset($_POST['blue'])){
    $dice = new addDiceAPI($_POST['stid'], $_POST['dicevalue']);
}
if(isset($_POST['red'])){
    $dice = new RemoveDiceAPI($_POST['stid'], $_POST['dicevalue']);
}

if(isset($_POST['logout'])){
    session_unset();
    header('Location: /admin');
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
    <title>Admin:Home</title>
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
                        <a href="/admin/post"><img width = "25" src="../assets/img/icon/paper-plane.png" alt=""></a>
                    </div>
                </div>
        </div>
        <div class="nav--main">
        <div class="nav--content">
            <div class="signout--content">
                <form action="" method="post"><button class="signout--btn" type="submit" name="logout">Sign Out</button></form>
            </div>
        </div>
    </div>
    </header>
    <main class="dice--container">
        <p><?php echo @$dice->message?></p>
        <form action="" method="post" class="dice--form" autocomplete="off">
            <input type="text" class="input--style" name="stid" placeholder="Student ID NO.">
            <input type="number" class="input--style" name = "dicevalue" placeholder="Dice Value">
            <div class="dice--btn">
                <button type="submit" name="blue"><img width = "45" src="../assets/img/icon/blue_dice.png" alt=""></button>
                <button type="submit" name="red"><img width = "45" src="../assets/img/icon/red_dice.png" alt=""></button>
            </div>
        </form>
        <a href="/admin/people"><img width="32" style="filter: invert(1); margin: 10px" src="../assets/img/icon/user.png" alt=""></a>
    </main>
</body>
</html>