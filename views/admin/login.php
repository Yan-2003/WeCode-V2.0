<?php 
$message = "";

if(isset($_POST['submit'])){
        if($_POST['username'] == "Admin"){
            if($_POST['password'] == "wecodeadmin123"){
                session_start();
                $_SESSION['admin'] = $_POST['username'];
                header("Location:/admin/home");
            }else{
                $message = "Incorrect Admin password.";
            }

        }else{
            $message = "Incorrect Admin name.";
        }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/sign.css">
    <link rel="icon" href="../assets/img/icon/logo.png">
    <title>Login</title>
</head>
<body>
    <main>
        <section class="login--page">

            <a class="logo" href="index.html">
                <img width="45" src="../assets/img/icon/logo.png" alt="">
                <h1>We<span style="color: #F68A26;">Code</span></h1>
            </a>

            <div class="form--content">
                <h1>WeCode Admin</h1>
                <form action="" method="post" autocomplete="off">
                    <h5><?php $message?></h5>
                    <div class="box--input">
                        <img width="45" src="../assets/img/icon/user.png">
                        <input class="input--style" type="text" placeholder="Admin name" autofocus name="username">
                    </div>
                    <div class="box--input">
                    <div class="lock--main" onclick="show1()"><div class="lock1"></div></div>
                        <input class="input--style" type="password" placeholder="Password" id="cpassword"  name="password">
                    </div>
                    <button class="button--style" type="submit" name="submit">Login</button>
                </form>
            </div>  

            <div class="main--powered">
                <img width= "45" src="../assets/img/picture/weits.png" alt="">
                <p>Powered by We Innovate Teach and Support.</p>
            </div>

        </section>



    </main>
<script src="../scripts/showpass.js"></script>
</body>
</html>