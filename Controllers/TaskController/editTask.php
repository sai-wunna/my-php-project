<?php

require('../../Models/Task/updateTask.php');

// it checks wheter auth() and onwer of the task
require('../Middlewares/taskOwner.php');
$id = $_POST['id'] ?? false;

if(!taskOwner($id)){
    setcookie('taskUpdate', "Not Authorized", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}

if(isset($_POST['editTask'])){
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    
    $updatetask = updateTaskDB($id , $title ,$deadline);

    if($updatetask){
        setcookie('taskUpdate', "Task was edited Completely", time() + 1 ,"/");
        return header("location: ../userController/rememberMe.php");
    }
    setcookie('taskUpdate', "Task edition Failed", time() + 1 ,"/");
    return header("location: ../userController/rememberMe.php");
}
return header("location: ../../index.php");

