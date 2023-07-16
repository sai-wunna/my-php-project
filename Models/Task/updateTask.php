<?php

function updateTaskToCompleteDB($id){
    try {
        require('../../Models/connectDB.php');
        $sql = "UPDATE tasks SET completed = :completed WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ":completed" => 1,
            ":id" => $id
        ]);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function updateTaskToNotCompleteDB($id){
    try {
        require('../../Models/connectDB.php');
        $sql = "UPDATE tasks SET completed = :completed WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ":completed" => 0,
            ":id" => $id
        ]);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

//________edit________
function updateTaskDB($id, $title, $deadline){
    try {
        require('../../Models/connectDB.php');
        $sql = "UPDATE tasks SET title = :title , deadline = :deadline , completed = :completed WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute([
            ":title" => $title,
            ":deadline" => $deadline,
            ":completed" => NULL,
            ":id" => $id
        ]);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
