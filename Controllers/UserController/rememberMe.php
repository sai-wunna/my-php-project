<?php

//___its is used to point here when there is token or after updates are taken --- to make refresh home-page___
try {
    require_once('../Middlewares/getUserData.php');
    require('../TaskController/getTask.php'); 
    $token = $_COOKIE['token_id'];
    $user = getUserDataByToken($token);
    if($user){
        session_start();
        $_SESSION['userdata'] = $user;
        getTask($user['id']);
        return header("location: ../../Views/home.php");
    } else {
        session_unset();
        session_destroy();
        setcookie('token_id', '', time() -1 , '/');
        return header("location: ../../index.php");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
