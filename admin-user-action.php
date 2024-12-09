<?php
require 'connection.php';

if (isset($_POST['verifyButton'])) {

    $id = $_POST['id'];

    $sqlQuery = "UPDATE `accounts` SET Verification = 1 WHERE Account_ID = $id";
    $statement = $connection->prepare($sqlQuery);
    $statement->execute(); 

    header("Location: admin-user.php");

} elseif (isset($_POST['blockButton'])) {

    $id = $_POST['id'];
    $sqlQuery = "UPDATE `accounts` SET Verification = 2 WHERE Account_ID = $id";
    $statement = $connection->prepare($sqlQuery);
    $statement->execute(); 

    header("Location: admin-user.php");

}