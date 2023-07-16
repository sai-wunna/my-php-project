<?php

//_______if not auth()______no authority_____
//_____simple logic if we use auth() in our file___return true if there is user or false
function auth(){
    if(isset($_COOKIE['token_id'])){
        return true;
    }
    return false;
};