<?php
$server_json = json_decode(file_get_contents("./server.json"), true);  
$request = $_SERVER['REQUEST_URI'];


if($server_json['state'] == true){
    switch($request){
        case '/' : require 'views/index.php';
        break;
        case '/login' : require 'views/login.php';
        break;
        case '/register' : require 'views/register.php';
        break;
        case '/home' : require 'views/home.php';
        break;
        case '/leaderboard' : require 'views/leaderboard.php';
        break;
        case '/profile' : require 'views/profile.php';
        break;
        case '/info' : require 'views/info.php';
        break;
        case '/edit' : require 'views/edit.php';
        break;
        case '/admin' : require 'views/admin/login.php';
        break;
        case '/admin/home' : require 'views/admin/home.php';
        break;
        case '/admin/post' : require 'views/admin/post.php';
        break;
        case '/admin/people' : require 'views/admin/people.php';
        break;
        case '/admin/score' : require 'views/admin/class/people.class.php';
        break;
        default: 
        http_response_code(404);
        require 'views/404.php';
    }
}else{
    http_response_code(500);
    require "views/server_down.php";
}



