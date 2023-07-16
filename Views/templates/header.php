<?php

function headerTemplate(){
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="../assets/css/app.css">
        <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
        <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </head>
    <body class="m-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-mid-10 text-md-center text-lg-start border border-1 bg-light m-2 rounded-pill">
                    <span class="h4 badge text-dark bg-white p-3 rounded-pill mt-2">My PHP-functional Project</span>
                </div>
            </div>
    ';
}

