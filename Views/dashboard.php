<?php
    session_start();
    require_once("../Controllers/Middlewares/auth.php");
    if(!auth()){
        return header("location: ../index.php");
    }
    $users = $_SESSION['userdataAll'] ?? false;
?>

    <?php require('./templates/header.php') ; headerTemplate()?>
    
    <h1>under construction...</h1>

    <?php require('./templates/footer.php') ; footerTemplate()?>
