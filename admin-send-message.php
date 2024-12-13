<?php
session_start();
require 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    echo json_encode(['error' => 'Not authorized']);
    exit();
}

// Validate input
if (!isset($_POST['receiver_id']) || !isset($_POST['message'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

try {
    $query = "INSERT INTO messages (sender_id, receiver_id, content, sent_at, role) 
              VALUES (:sender, :receiver, :content, NOW(), 'admin')";
    $stmt = $connection->prepare($query);
    $stmt->execute([
        ':sender' => $_SESSION['admin_id'],
        ':receiver' => $_POST['receiver_id'],
        ':content' => trim($_POST['message'])
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}