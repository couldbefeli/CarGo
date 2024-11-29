<?php

session_start();
require 'connection.php';

$messageContent = $_POST['message-content'];

$sqlQuery = "INSERT INTO `messages` (sender_id, receiver_id, content, is_read) VALUES
(:sender_id, :receiver_id, :content, :is_read)";

$statement = $connection->prepare($sqlQuery);
$statement->execute([
    ':sender_id' => $_SESSION['user_id'],
    ':receiver_id' => 4,
    ':content' => $messageContent,
    ':is_read' => 0,

]);

header('Location: user-chats.php');