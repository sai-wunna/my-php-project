<?php

function deleteTaskDB($task_id){
    try {
        require('../../Models/connectDB.php');
        $sql = "DELETE FROM tasks WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ":id" => $task_id
        ]);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}