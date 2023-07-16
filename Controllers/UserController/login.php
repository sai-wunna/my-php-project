<?php
require_once('../../Models/User/login.php');
require_once('../../Models/User/getUserData.php');
require('../TaskController/getTask.php');
session_start();
setcookie('email' , '' , time() - 1 , "/");

//____check already login or not - first_____
if(isset($_COOKIE['token_id'])){
    return require_once('./rememberMe.php');
}
if(!$_POST['login']){
    return header("location: ../../index.php");
}

$email = $_POST['email'] ?? false;
$password = $_POST['password'] ?? false;

if(!($email && $password)){
    setcookie('login_comfirmation', "Fill the form completry", time() + 1);
    return header("location: ../../index.php");
}

try {
    // first try login with the user's email
    $user = Login($email);
    
    if(!$user){
        // if not user___ RETURN
        setcookie("login_comfirmation" , "Wrong email", time() + 1 , "/");
        return header("location: ../../index.php");
    }
    
    if(!password_verify($password, $user['password'])){
        // if user__but password is not correct ___ RETURN
        setcookie("login_comfirmation" , "Wrong Password", time() + 1, "/");
        return header("location: ../../index.php");
    }

    $user_id = $user['id'];
    //____take user's id from the database
    $token_h = bin2hex(random_bytes(16));

    // ____set it in cookie so do not need to login again
    $token_id = $token_h . $user_id . md5($token_h);
    setcookie("token_id", $token_id, time() + 900000, "/");

    //____and set that cookie to database
    $SetTokenToDB = setTokenId($token_id, $email);

    $update_user = getUserDataByEmailDB($email);

    if($SetTokenToDB  && $update_user){
        $_SESSION['userdata'] = $update_user;
        getTask($user_id);
        return header("location: ../../Views/home.php");
    }
    setcookie('email' , $email , time() + 30 , "/");
    setcookie("login_comfirmation" , "Login Failed", time() + 1 , "/");
    return header("location: ../../index.php");


} catch (Exception $e) {
    echo $e->getMessage();
}


?>