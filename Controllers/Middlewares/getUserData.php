<?php

// ---to assit rememberMe----and it return false if the cookie's token_is is not match form database
function getUserDataByToken($token_id){
    require_once('../../Models/User/getUserData.php');

    $id = substr(substr($token_id, 32), 0, -32); 
    
    $user = getUserDataByIdDB($id, $token_id);

    return $user;
}

// to get user's id as it is not given to viewing
// so to add task it helps user's id
function getUserToken($token_id){

    return $id = substr(substr($token_id, 32), 0, -32);

}

?>