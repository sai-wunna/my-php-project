<?php

//______clear token form database if logout
function DeleteTokenId(){

    try {
        require('../../Models/connectDB.php');
    
        $token_id = $_COOKIE['token_id'];
    
        $sql = "UPDATE users SET token_id = NULL WHERE token_id = :token_id";
        $statement = $connection->prepare($sql);
        $statement->execute([":token_id" => $token_id]);

        // rowCount means the counting of data from table that has been effected (update)
        return $statement->rowCount() > 0;

    } catch (Exception $e) {
        echo $e->getMessage();
    }

}