<?php
$pdo = new PDO("mysql:host=localhost;dbname=auth_demo", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require 'vendor/autoload.php';
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$mongoDB = $mongoClient->auth_demo;
$profileCollection = $mongoDB->profiles;
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
?>