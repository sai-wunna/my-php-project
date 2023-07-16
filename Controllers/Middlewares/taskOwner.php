<?php

function taskOwner($id){
    require('./getTask.php');
    require('../Middlewares/auth.php');
    require('../Middlewares/getUserData.php');
    
    session_start();

    if(!auth()){
        return false;
    }

    $token_id = $_COOKIE['token_id']; 
    $user = getUserDataByToken($token_id);

    if(!$user){
        return false;
    }

    $user_task_id = getUserTaskIds($user['id']);
    
    foreach($user_task_id as $utid){
        if($utid['id'] === intVal($id)){
            return true;
        }
    }
    return false;
}
