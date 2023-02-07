<?php
$request = $_SERVER['REQUEST_URI'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="icon" href="assets/img/icon/logo.png">
    <title>WeCode: 404</title>
</head>
<body>
    <main>
        <div class="notfound">
            <img width = "300" src="assets/img/icon/page-not-found.png" alt="">
            <h1>404 Page not found!</h1>
            <p>if this error occurred the URL: <?php echo $request?> is not found.</p>
        </div>
    </main>
</body>
</html>