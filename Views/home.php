<?php
session_start();
require('../Controllers/Middlewares/xssFilter.php');
require("../Controllers/Middlewares/auth.php");
if(!auth()){
    return header("location: ../index.php");
} else if(empty($_SESSION['userdata'])){
    return header('location: ../index.php');
}
$tasks = isset($_SESSION['tasks']) ? xssFilter($_SESSION['tasks']) : [];
$user = xssFilter($_SESSION['userdata']);
$name= $user['name'];
$email= $user['email'];
$img= $user['image'] ?? false;

?>
    <?php require_once('./templates/header.php'); headerTemplate()?>
        <div class="row justify-content-center my-2">
            <div class="col-12 col-lg-8 col-md-10">
                <div class="card border-1 bg-light p-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                                <?php
                                if($img) {
                                    echo "<img src='../assets/img/$img' class='w-75 rounded-circle m-2'>";
                                } else {
                                    echo "<form action='../Controllers/UserController/uploadImage.php' method='post' enctype='multipart/formdata' class='input-group my-5'>
                                        <input type='file' name='image' class='form-control' required>
                                        <input type='submit' class='btn btn-primary name='uploadImage' value='Upload'>
                                    </form>";
                                }
                                ?>
                            </div><!-- align-items-end -->
                            <div class="col-12 col-lg-6 col-md-12 d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h5">
                                        <span class="text-muted">Name : </span>
                                        <span><?= $name ?></span>
                                    </div>
                                    <div class="h5">
                                        <span class="text-muted">Email : </span>
                                        <span><?= $email ?></span>
                                    </div>
                                    <a href="../Controllers/UserController/logout.php" class="btn btn-sm bg-danger text-light">logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-2">
            <div class="col-12 col-lg-8 col-md-10">
                <div class="card border-1 bg-light p-2">
                    <div class=" card-body px-2">
                        <div class="container p-2 h5">
                            Tasks
                            <span class='badge bg-success px-2 float-end'><?= count($tasks) ?></span>
                        </div>
                        <?php 
                        if(isset($_COOKIE['taskCreation'])){
                            echo "<div class='alert alert-info my-2'>{$_COOKIE['taskCreation']}</div>";
                        }
                        if(isset($_COOKIE['taskUpdate'])){
                            echo "<div class='alert alert-info my-2'>{$_COOKIE['taskUpdate']}</div>";
                        }
                        ?>
                        <ul class="list-group">  
                        <?php
                            if (count($tasks) > 0) {
                                foreach ($tasks as $task) {
                                    if($task['completed'] === '1' ){
                                        $taskCompletion = "text-decoration-line-through";
                                        $completeBtn = 'd-none';
                                        $incompleteBtn = 'text-success';
                                    } else {
                                        $taskCompletion = "";
                                        $completeBtn = 'text-success';
                                        $incompleteBtn = 'd-none';
                                    }
                                    echo "<li class='list-group-item'>
                                    <span class='h6 $taskCompletion'>{$task['title']}</span>
                                    <button type='button' class='btn btn-sm float-end' data-bs-toggle='modal' data-bs-target='#updateTask{$task['id']}'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>
                                            <div class='text-danger fst-italic $taskCompletion'> Deadline:  {$task['deadline']}</div>
                                        </li>
                                        
                                        <div class='modal fade' id='updateTask{$task['id']}'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <span class='modal-title'>Edit Task</span>
                                                        <button class='btn btn-close' data-bs-dismiss='modal'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                    <div class='text-danger $taskCompletion'>Deadline: {$task['deadline']}</div>
                                                        <form method='post' action='../Controllers/TaskController/editTask.php' class='m-2'>
                                                            <input type='date' class='form-control my-1' name='deadline' required>
                                                            <input type='text' class='form-control my-1' name='title' placeholder='{$task['title']}' class='form-control' required>
                                                            <input type='hidden' name='id' value='{$task['id']}' class='form-control'>
                                                            <button type='submit' name='editTask' class='btn btn-sm text-primary my-1 float-end'>Update</button>
                                                        </form>
                                                        <button type='button' class='btn btn-sm text-danger' data-bs-toggle='collapse' data-bs-target='#deleteConfirm'>
                                                            <i class='bi bi-trash'></i>
                                                        </button>
                                                        <a href='../Controllers/TaskController/completedTask.php?id={$task['id']}' class='btn btn-sm $completeBtn'><i class='bi bi-square'></i></a>
                                                        <a href='../Controllers/TaskController/notCompletedTask.php?id={$task['id']}' class='btn btn-sm  $incompleteBtn'><i class='bi bi-check2-square'></i></a>
                                                        <div class='collapse' id='deleteConfirm'>
                                                            <div class='float-end'>
                                                                <a href='../Controllers/TaskController/deleteTask.php?id={$task['id']}' class='btn btn-sm btn-danger'>Delete?</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                }
                            } else {
                                echo "<li class='list-group-item'>No Tasks</li>";
                            }
                        ?>
                        </ul>


                        <!-- create task form -start-->
                        <button type="button" class="btn btn-sm btn-secondary float-end my-2" data-bs-toggle="collapse" data-bs-target="#addTaskForm">
                            Add Task!
                        </button>
                        <div class="collapse my-2" id="addTaskForm">
                            <form method="post" action="../Controllers/TaskController/createTask.php">
                                <div class="input-group">
                                    <input type="hidden" name="user_id" value="<?= $_COOKIE['token_id'] ?>" class="form-control">
                                    <input type="date" name="deadline" class="form-control" required>
                                    <input class="form-control w-50" name="title" placeholder="Add your Task here" required>
                                    <button class="btn btn-primary" name="createTask" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- create task form -end-->

                    </div>
                </div>
            </div>
        </div>
    <?php require_once('./templates/footer.php'); footerTemplate() ?>