<?php

function getTask($user_id){
    require('../../Models/Task/getTask.php');
    $tasks = getTaskDB($user_id);
    if($tasks){
        return $_SESSION['tasks'] = $tasks;
    }
    return $_SESSION['tasks'] = [];
}

function getUserTaskIds($id){
    require('../../Models/Task/getTask.php');
    $user_task_ids = getUserTaskIdsDB($id);
    
    return $user_task_ids ? $user_task_ids : [];
}