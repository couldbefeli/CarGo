<?php

require 'connection.php';

if (isset($_POST['carUpdateButton'])) {
    $id = $_POST['update_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $type = $_POST['type'];
    $transmission = $_POST['transmission'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    
    $sqlQuery = "CALL sp_update_car (?, ?, ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->bindValue(2, $model, PDO::PARAM_STR);
    $statement->bindValue(3, $capacity, PDO::PARAM_STR);
    $statement->bindValue(4, $transmission, PDO::PARAM_STR);
    $statement->bindValue(5, $price, PDO::PARAM_STR);
    $statement->bindValue(6, $brand, PDO::PARAM_STR);
    $statement->bindValue(7, $type, PDO::PARAM_STR);

    $statement->execute();

    header('Location: admin-car.php');
}