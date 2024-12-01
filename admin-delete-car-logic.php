<?php

require 'connection.php';

if (isset($_GET['delete'])) {
$id = $_GET['id'];

$sqlQuery = "DELETE FROM `cars` WHERE Car_ID = $id";
$statement = $connection->prepare($sqlQuery);
$statement->execute();

header("Location: admin-car.php");

}
