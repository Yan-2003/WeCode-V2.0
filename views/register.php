<?php
require 'class/register.class.php';
if(isset($_POST['submit'])){
    $user = new registerAPI($_POST['username'], $_POST['name'], $_POST['studentid'], $_POST['email'], $_POST['password'], $_POST['cpassword']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/sign.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>Register</title>
</head>
<body>
    <main>
        <section class="login--page">

            <a class="logo" href="/">
                <img width="45" src="assets/img/icon/logo.png" alt="">
                <h1>We<span style="color: #F68A26;">Code</span></h1>
            </a>
            <div class="form--content">
                <form action="" method="post" autocomplete="off">
                <h5><?php echo @$user->message?></h5>
                    <div class="box--input">
                        <img width="45" src="assets/img/icon/user.png">
                        <input class="input--style" type="text" placeholder="Username" value="<?php echo @$user->sendUsername; ?>" name="username" >
                    </div>
                    
                    <div class="box--input">
                        <img width="45" src="assets/img/icon/user.png">
                        <input class="input--style" type="text" placeholder="Full Name" value="<?php echo @$user->sendName; ?>" name="name">
                    </div>
                    <div class="box--input">
                        <img width="45" src="assets/img/icon/id-card.png">
                        <input class="input--style" type="text" placeholder="Student ID on." value="<?php echo @$user->sendStudentID; ?>" name="studentid">
                    </div>

                    <div class="box--input">
                        <img width="45" src="assets/img/icon/email.png">
                        <input class="input--style" type="email" placeholder="Email Address" value="<?php echo @$user->sendEmail; ?>" name="email">
                    </div>
                    <div class="box--input">
                    <div class="lock--main" onclick="show2()"><div class="lock2"></div></div>
                        <input class="input--style" type="password" placeholder="Password" value="<?php echo @$user->sendPassword; ?>" name="password" id="password">
                    </div>
                    <div class="box--input">
                        <div class="lock--main" onclick="show1()"><div class="lock1"></div></div>
                        <input class="input--style" type="password" placeholder="Confirm Password" value="<?php echo @$user->sendCPasword; ?>" name="cpassword" id="cpassword">
                    </div>
                    <button class="button--style" type="submit" name="submit">Register</button>
                </form>
                <a class="text--link" href="/login">Already have an Account? Click Here.</a>
            </div>  

            <div class="main--powered">
                <img width= "45" src="assets/img/picture/weits.png" alt="">
                <p>Powered by We Innovate Teach and Support.</p>
            </div>

        </section>



    </main>
<script src="scripts/showpass.js"></script>
</body>
</html>