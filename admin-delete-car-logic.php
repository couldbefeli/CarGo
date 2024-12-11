<?php

require 'connection.php';

if (isset($_GET['delete'])) {
$id = $_GET['id'];


$SQL_ADD_USER_QUERY = "CALL sp_delete_car(?)";
$sql_add = $connection->prepare($SQL_ADD_USER_QUERY);
$sql_add->bindValue(1, $id, PDO::PARAM_STR);

$sql_add->execute();

// $sqlQuery = "DELETE FROM `cars` WHERE Car_ID = $id";
// $statement = $connection->prepare($sqlQuery);
// $statement->execute();

header("Location: admin-car.php");

}
