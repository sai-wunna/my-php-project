<?php

require_once('../../Models/User/uploadImage.php');

if(empty($_POST['uploadImage'])){
    return header("../../Views/home.php");
}

// ________under construction_________