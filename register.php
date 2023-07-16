<?php
session_start();
require_once('./Controllers/Middlewares/auth.php');
if(auth()){
    return header("location: ./Controllers/UserController/rememberMe.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/app.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="container text-center p-3 my-2">
            <h2 class="fst-italic text-light text-decoration-underline">REGISTERATION FORM</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-11 col-lg-5 col-md-8">
                <div class="card bg-light border-3 rounded">

                    <div class="card-body">
                        <form action="./Controllers/UserController/register.php" method="post">
                            <div class="p-1 m-1">
                                <label class="h6">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="p-1 m-1">
                                <label class="h6">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="p-1 m-1">
                                <label class="h6">Password</label>
                                <input type="pwd" name="password"  class="form-control" required>
                            </div>
                            <div class="p-1 m-1">
                                <label class="h6">Confirm Password</label>
                                <input type="pwd" name="confirmPassword" class="form-control" required>
                                <?php
                                if(isset($_COOKIE['requirement'])) echo "<div class='text-danger my-2'>".$_COOKIE['requirement']."</div>";
                                if(isset($_COOKIE['confirmation']))echo "<div class='text-danger my-2'>" .$_COOKIE['confirmation']."</div>";
                                if(isset($_COOKIE['error']))echo "<div class='text-danger my-2'>" .$_COOKIE['error']."</div>";
                                ?>
                            </div>
                            <div class="text-center mt-2">
                                <input type="submit" name="register" class="btn btn-primary rounded-pill px-5" value="Register"> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="float-end text-light"><a href="./index.php" >Login</a> Now!</div>
            </div>
        </div>
    </div>
</body>
</html>