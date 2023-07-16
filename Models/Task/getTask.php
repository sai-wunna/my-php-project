<?php

// get all data of tasks of a certain user for viewing
function getTaskDB($user_id){
    try {
        require('../../Models/connectDB.php');
        $sql = "SELECT id, title, deadline, completed FROM tasks WHERE user_id = :user_id ";
        $statement = $connection->prepare($sql);
        $statement->execute([":user_id" => $user_id]);
        $tasks = $statement->fetchAll();
        return $tasks;
    } catch (Exception $e) {
        echo $e->getmessage();
    }
}

/// similar but only tasks' ids of a certain user for checking authority
function getUserTaskIdsDB($user_id){
    try {
        require('../../Models/connectDB.php');
        $sql = "SELECT id FROM tasks WHERE user_id = :user_id ";
        $statement = $connection->prepare($sql);
        $statement->execute([":user_id" => $user_id]);
        $user_task_ids = $statement->fetchAll();
        return $user_task_ids;
    } catch (Exception $e) {
        echo $e->getmessage();
    }
}