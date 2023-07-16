<?php

require('../../Models/Task/updateTask.php');

// it checks wheter auth() and onwer of the task
require('../Middlewares/taskOwner.php');

$task_id = $_GET['id'];

if(!taskOwner($task_id)){
    setcookie('taskUpdate', "Not Authorized", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}


$completion = updateTaskToCompleteDB($task_id);
if($completion){
    setcookie('taskUpdate', "Completed A task", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}
setcookie('taskUpdate', "Cannot Change Task", time() +1 , '/');
return header("location: ../userController/rememberME.php");