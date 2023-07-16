<?php
require_once("../../Models/User/logout.php");
require_once("../Middlewares/auth.php");
if(!auth()){
    return header("location: ../../index.php");
}

if(!DeleteTokenId()){
    return header("location: ../../Views/home.php");
}
session_start();
session_unset();
session_destroy();
setcookie('token', "" , time() - 1 ,"/");
header("location: ../../index.php");