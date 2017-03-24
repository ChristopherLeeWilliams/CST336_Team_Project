<?php
$dbHost = getenv("IP");
$dbPort = 3306;
$dbName = "PCBuilder";
$dbUsername = getenv("C9_USER");
$dbPassword = "";

// Connect to database
$dbConn = new PDO("mysql:host=$dbHost;dbname=$dbName; port=$dbPort", $dbUsername, $dbPassword);
?>