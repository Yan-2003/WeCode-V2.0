<?php
require 'class/db.class.php';
session_start();
    if($_SESSION['username'] == NULL){
        header('Location: /login');
    }
$db = new db();
$sql = "SELECT * FROM user";
$result = mysqli_query($db->conn, $sql);
$id;
$message = "";


if(isset($_POST['close'])){
    header("Location: /home");
}


?>

<?php while($user = mysqli_fetch_assoc($result)):?>
<?php if($user['username'] == $_SESSION['username']):?>
<?php $id = $user['id'];

$username = explode('@', $user['username']);

;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="assets/style/edit.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>Edit</title> 
</head>
<body>
    <header class="header--box">
        <div class="header--main">
            <div class="header--content">
                <a class="header--logo" href="">
                    <img width="32" src="assets/img/icon/logo.png" alt="">
                    <p>We<span style="color: #F68A26;">Code</span></p>
                </a>
            </div>
        </div>
    </header>

    <main>
        <form action="" method="post" class="edit--main" enctype="multipart/form-data" autocomplete="off">
                <p>
                <?php
if(isset($_POST['save'])){
    $filenewName = $_SESSION['username'].".";
    $serverPath = $_SERVER['DOCUMENT_ROOT']."/database/img/userProfile/";
    $files = $_FILES['files']['tmp_name'];
    $fileName = $_FILES['files']['name'];
    $fileSize = $_FILES['files']['size'];
    $file = explode(".",$fileName);
    $fileExtention = strtolower(end($file));
    $fileUpdate = $filenewName."jpg";
    if($fileExtention == "jpg"){
        if($fileSize > 10000000){
            echo "File is too large. the maximum file size is 7MB</br>";
        }else{
            move_uploaded_file($files, $serverPath.$filenewName.$fileExtention);
            echo "This may take a few minutes to update.</br>";
        }
    }else{
        echo "File must be in JPG format.</br>";
    }
    $updateSql = "UPDATE user SET name='".$_POST['name']."', email='".$_POST['email']."', studentID='".$_POST['stid']."', img='".$fileUpdate."' WHERE id=".$id;
    if(mysqli_query($db->conn, $updateSql)){
        echo  "Successfully Update Profile</br>";
    }else{
       echo "Something went wrong</br>";
    }
}
?>
                </p>
            <div class="edit--upper">
                <div class="profile--pic">
                    <img src="database/img/userProfile/<?php echo $user['img']?>" alt="">
                </div>
            </div>
            <label for="files" class="file--main">
                <input type="file"  id="files" name="files" accept="image/JPEG" class="file">
            </label>
            <div class="edit--lower">
                <input type="text" class="input--style1" name="name" value="<?php echo $user['name']?>" placeholder="Name" >
                <input type="text" class="input--style1" name="stid" value="<?php echo $user['studentID']?>" placeholder="Student ID no." >
                <input type="email"class="input--style1" name="email" value="<?php echo $user['email']?>" placeholder="Email" >
            </div>
            <div class="edit--buttons">
                <button type="submit" name="save"  class="button--style">Save</button>
                <button type="submit" name="close" class="button--style">Back</button>
            </div>


        </form>
    </main>
</body>
</html>
<?php endif?>
<?php endwhile?>

