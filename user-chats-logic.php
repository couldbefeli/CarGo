<?php

session_start();
require 'connection.php';

$messageContent = $_POST['message-content'];
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : $_POST['hiddenAdminID'];
echo $_POST['hiddenAdminID'];

$sqlQuery = "CALL sp_add_message(?, ?, ?, ?)";

$statement = $connection->prepare($sqlQuery);
$statement->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
$statement->bindParam(2, $admin_id, PDO::PARAM_INT);
$statement->bindParam(3, $messageContent, PDO::PARAM_STR);
$statement->bindParam(4, $_SESSION['user_role'], PDO::PARAM_STR);

$statement->execute();

header('Location: user-chats.php');
