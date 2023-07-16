<?php

$envVars = parse_ini_file('../../.env');

$dbHost = $envVars['DB_HOST'];
$dbName = $envVars['DB_NAME'];
$dbUserName = $envVars['DB_USERNAME'];
$dbPassword = $envVars['DB_PASSWORD'];

    try {
        $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUserName, $dbPassword);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


?>