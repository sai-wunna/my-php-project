<?php

function registerDB($name, $email, $password){
    try {
        require('../../Models/connectDB.php');
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = $connection->prepare($sql);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $statement->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $hash,
        ]);
        return true;
    } catch (Exception $e) {
        setcookie('registration', "Failed", time() + 15 ,"/");
        echo $e->getMessage();
    }
}