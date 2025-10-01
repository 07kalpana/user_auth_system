<?php
require 'config.php';
$token = $_REQUEST['token'];
$userId = $redis->get("session:$token");
if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'Invalid session']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $profile = $profileCollection->findOne(['user_id' => (int)$userId]);
    echo json_encode(['success' => true, 'profile' => $profile]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'contact' => $_POST['contact'],
        'dob' => $_POST['dob'],
        'address' => $_POST['address']
    ];
    $profileCollection->updateOne(['user_id' => (int)$userId], ['$set' => $updateData]);
    echo json_encode(['success' => true]);
}
?>