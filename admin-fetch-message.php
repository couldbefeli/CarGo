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
    // Modified query to get messages sent to any admin
    $query = "SELECT m.*, 
                     a1.Email as sender_email,
                     a2.Email as receiver_email
              FROM messages m
              JOIN accounts a1 ON m.sender_id = a1.Account_ID
              JOIN accounts a2 ON m.receiver_id = a2.Account_ID
              WHERE (sender_id = :sender AND receiver_id IN 
                    (SELECT Account_ID FROM accounts WHERE Role = 'admin'))
                 OR (sender_id IN 
                    (SELECT Account_ID FROM accounts WHERE Role = 'admin')
                    AND receiver_id = :sender)
              ORDER BY sent_at DESC 
              LIMIT 50";

    $stmt = $connection->prepare($query);
    $stmt->execute([
        ':sender' => $_GET['sender_id']
    ]);

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}