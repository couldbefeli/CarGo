<?php
session_start();
require 'connection.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['error' => 'Not authorized']);
    exit();
}

// Validate input
if (!isset($_GET['sender_id'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

try {
    $query = "CALL sp_GetRecentAdminUserMessages(?)"; 
    $stmt = $connection->prepare($query);
    $stmt->bindValue(1, $_GET['sender_id'], PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result); 
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}
?>