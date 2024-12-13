<?php

session_start();
require 'connection.php';

$messageContent = $_POST['message-content'];

$sqlQuery = "INSERT INTO `messages` (sender_id, receiver_id, content, role) VALUES
(:sender_id, :receiver_id, :content, :role)";

$statement = $connection->prepare($sqlQuery);
$statement->execute([
    ':sender_id' => $_SESSION['user_id'],
    ':receiver_id' => $_SESSION['admin_id'],
    ':content' => $messageContent,
    ':role' => $_SESSION['user_role'],

]);

header('Location: user-chats.php');