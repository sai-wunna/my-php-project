<?php

///_______whether there is token so from that take user with that id and match its token
function getUserDataByIdDB($id, $token_id){
    try {
        require('../../Models/connectDB.php');
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute([":id" => $id]);
        $userData = $statement->fetch();
        
        if($token_id !== (isset($userData['token_id']) ? $userData['token_id'] :false)){
            return false;
        }
        return $userData;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

///______this is only to set userdata for viewing_______
function getUserdataByEmailDB($email){
    try {
        require('../../Models/connectDB.php');
        $sql = "SELECT name, email , image FROM users WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->execute([":email" => $email]);
        $userData = $statement->fetch();
    
        return $userData;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}