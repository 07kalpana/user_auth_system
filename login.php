<?php
require 'config.php';
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch();
if ($user && password_verify($password, $user['password'])) {
    $token = bin2hex(random_bytes(16));
    $redis->setex("session:$token", 86400, $user['id']);
    echo json_encode(['success' => true, 'token' => $token]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
}
?>