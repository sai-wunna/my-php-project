<?php


require('../../Models/Task/createTask.php');
require('../Middlewares/auth.php');
require('../Middlewares/getUserData.php');
session_start();
if(!auth()){
    return header("location: ../../index.php");
}

if(isset($_POST['createTask'])){
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $user_id = getUserToken($_POST['user_id']);

    $task = createTaskDB($title,$user_id,$deadline);
    if($task){
        setcookie('taskCreation', "Completely Added A Task", time() + 1 ,"/");
        return header("location: ../userController/rememberMe.php");
    }
    setcookie('taskCreation', "Failed To Add Task", time() + 15 ,"/");
    return header("location: ../userController/rememberMe.php");
}
return header("location: ../../index.php");