<?php

require('../../Models/Task/deleteTask.php');

// it checks wheter auth() and onwer of the task
require('../Middlewares/taskOwner.php');
$task_id = $_GET['id'];

if(!taskOwner($task_id)){
    setcookie('taskUpdate', "Not Authorized", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}


$deletion = deleteTaskDB($task_id);
if($deletion){
    setcookie('taskUpdate', "Completely Deleted The Task", time() +1 , '/');
    return header("location: ../userController/rememberME.php");
}
setcookie('taskUpdate', "Cannot Delete Task", time() +1 , '/');
return header("location: ../userController/rememberME.php");
