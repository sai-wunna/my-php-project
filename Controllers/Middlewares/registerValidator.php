<?php

function validator($name, $email, $password, $confirmPassword){

    $requirement = true;
    $confirmation = true;

    if($name == false || $email == false || $password == false || $confirmPassword == false){
        $requirement = false;
        setcookie('requirement', "Fill the form completely" , time() + 1 , "/");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $requirement = false;
        setcookie('requirement', "Must be type of email", time() + 1  , "/");
    }
    
    if(!$requirement){
        return $requirement = false;
    }
    
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        
        $confirmation = false;
        setcookie('confirmation', "A-Z 0-9 min-8 weak-password", time() + 1 , "/");
    }else if($password !== $confirmPassword){

        $confirmation = false;
        setcookie('confirmation', "The password must be identical", time() + 1 , "/");
    }

    if(!$confirmation){
        return $confirmation = false;
    } else {
        return true;
    }

}
