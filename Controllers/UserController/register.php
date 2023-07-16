<?php
require_once("../../Models/User/login.php");
require_once("../../Models/User/getUserData.php");
require_once("../../Models/User/register.php");
require_once("../Middlewares/registerValidator.php");

if(empty($_POST['register'])){
    return header("location: ../../register.php");
}

$name = $_POST['name'] ?? false;
$email = $_POST['email'] ?? false;
$password = $_POST['password'] ?? false;
$confirmPassword = $_POST['confirmPassword'] ?? false;

//____validate whether the data requirement is filled or not____
$validation = validator($name , $email, $password, $confirmPassword);

if(!$validation){
    setcookie('registration', "Failed", time() + 1 ,"/");
    return header("location: ../../register.php");
}

try {
    ///____whether user is already registered or not
    $user = getUserdataByEmailDB($email);
    if ($user) {
        setcookie("error" , "Already have an account" , time() + 1 , "/");
        return header("Location: ../../register.php");
    }

    $registration = registerDB($name, $email, $password);
    if(!$registration){
        setcookie('registration', "Failed", time() + 1 ,"/");
        return header("location: ../../register.php");
    }
    setcookie('registration', "Registration Complete", time() + 1 ,"/");
    return header("location: ../../index.php");
    
} catch (Exception $e) {
    setcookie("error", $e->getMessage() , time() + 1 , "/");
    return header("location: ../../register.php");
}

?>
