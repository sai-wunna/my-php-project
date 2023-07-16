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
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/app.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="container text-light text-center p-3 my-2">
            <h2 class="fst-italic text-decoration-underline">Login Form</h2>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-11 col-lg-5 col-md-8">
                <div class="card bg-light border-3 rounded">
                    <div class="card-body">
                        <form action="./Controllers/UserController/login.php" method="post">
                            <div class="p-2 m-1">
                                <label class="h5">Email</label>
                                <input type="text" name="email" value="<?php echo $email ?? false ?>" class="form-control" required>
                            </div>
                            <div class="p-2 m-1">
                                <label class="h5">Password</label>
                                <input type="pwd" name="password" class="form-control" required>

                            </div>
                            <div class="text-center my-2">
                                <input type="submit" name="login" class="btn btn-primary rounded-pill px-5" value="Login"> 
                            </div>
                            <span class="float-end"><a href="./register.php">Register</a> here!</span>
                        </form>
                    </div>
                </div>
                <?php
                    if(isset($_COOKIE['login_comfirmation'])) echo "<div class='text-danger my-2'>".$_COOKIE['login_comfirmation']."</div>";
                ?>
                <?php
                    if(isset($_COOKIE['registration'])) echo "<div class='text-success my-2'>".$_COOKIE['registration']."</div>";
                ?>            
            </div>
        </div>
    </div>
</body>
</html>