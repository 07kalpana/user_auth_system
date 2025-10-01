<?php
require 'config.php';
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $password]);
$userId = $pdo->lastInsertId();
$profileCollection->insertOne([ 'user_id' => $userId, 'username' => $username, 'email' => $email ]);
echo json_encode(['success' => true]);
?>