<?php

require('../../Models/Task/updateTask.php');

// it checks wheter auth() and onwer of the task
require('../Middlewares/taskOwner.php');
$id = $_GET['id'] ?? false;

if(!taskOwner($id)){
    setcookie('taskUpdate', "Not Authorized", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}

$completion = updateTaskToNotCompleteDB($id);
if($completion){
    setcookie('taskUpdate', "Not Completed A task yet", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}
setcookie('taskUpdate', "Cannot Change Task", time() +1 , '/');
return header("location: ../userController/rememberME.php");
