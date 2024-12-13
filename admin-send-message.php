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
    $query = "CALL sp_admin_send_message(?, ?, ?)"; 
    $stmt = $connection->prepare($query);
    $stmt->bindValue(1, $_SESSION['admin_id'], PDO::PARAM_INT);
    $stmt->bindValue(2, $_POST['receiver_id'], PDO::PARAM_INT);
    $stmt->bindValue(3, trim($_POST['message']), PDO::PARAM_STR); // Changed to PARAM_STR
    $stmt->execute();

    echo json_encode(['success' => true]); 
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]); 
}
?>