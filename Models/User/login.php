<?php

//_____this is to validate the user______and only take___email to match user's___id if match to set cookie
function Login($email){
    try {
        require('../../Models/connectDB.php');
        $sql = "SELECT id , name , password FROM users WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->execute([":email" => $email]);
        return $user = $statement->fetch();
    } catch (Exception $e) {
        echo $e->getErrorMessage();
    }
}

function setTokenId($token_id, $email){
    try {
        require('../../Models/connectDB.php');
        $sql = "UPDATE users SET token_id = :token_id WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->execute([ ":token_id" => $token_id ,":email" => $email]);
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}