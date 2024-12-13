<?php

require 'connection.php';

if (isset($_POST['addCarButton'])) {
    $file_name = $_FILES['carPic']['name'];
    $temporary_name = $_FILES['carPic']['tmp_name'];
    $folder = "img/cars/$file_name";

    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $capacity = $_POST['seats'];
    $model = $_POST['model'];
    $transmission = $_POST['transmission'];
    $price = $_POST['price'];
    $datetime = date_create()->format('Y-m-d H:i:s');

    $sqlQuery = "CALL sp_add_car (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindValue(1, $model, PDO::PARAM_STR);
    $statement->bindValue(2, $capacity, PDO::PARAM_STR);
    $statement->bindValue(3, $transmission, PDO::PARAM_STR);
    $statement->bindValue(4, $price, PDO::PARAM_INT);
    $statement->bindValue(5, $file_name, PDO::PARAM_STR);
    $statement->bindValue(6, "available", PDO::PARAM_STR);
    $statement->bindValue(7, $datetime, PDO::PARAM_STR);
    $statement->bindValue(8, $brand, PDO::PARAM_INT);
    $statement->bindValue(9, $type, PDO::PARAM_INT);
    
    move_uploaded_file($temporary_name, $folder);
    $statement->execute();
    header('Location: admin-car.php');
    
}


