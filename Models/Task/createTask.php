<?php

function createTaskDB($title, $user_id, $deadline){
    try {
        require('../../Models/connectDB.php');
        $sql = "INSERT INTO tasks ( title, user_id , deadline) VALUES ( :title, :user_id , :deadline ) ";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ":title" => $title,
            ":user_id" => $user_id,
            ":deadline" => $deadline
        ]);
        return true;
    } catch (Exception $e) {
        setcookie('taskCreation', "Failed To Add Task", time() + 1 ,"/");
        return $e->getMessage();
    }
}