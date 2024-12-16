<?php
require 'connection.php';

if (isset($_POST['verifyButton'])) {

    $id = $_POST['id'];

    // admin verify
    $sqlQuery = "CALL sp_admin_user_verify(?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute(); 

    header("Location: admin-user.php");

} elseif (isset($_POST['blockButton'])) {

    // admin block
    $id = $_POST['id'];
    $sqlQuery = "CALL sp_admin_user_block(?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute(); 

    header("Location: admin-user.php");

}

elseif (isset($_POST['unblockButton'])) {

    // admin block
    $id = $_POST['id'];
    $sqlQuery = "CALL sp_admin_user_unblock(?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $id, PDO::PARAM_INT);
    $statement->execute(); 

    header("Location: admin-user.php");

}