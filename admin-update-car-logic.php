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

    

    $sqlQuery = "UPDATE `cars` SET Model_Name = :model, Brand = :brand, Car_Type = :car_type, Capacity = :capacity, Transmission = :transmission, Price = :price WHERE Car_ID = $id";

    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':model' => $model,
        ':brand' => $brand,
        ':car_type' => $type,
        ':capacity' => $capacity,
        ':transmission' => $transmission,
        ':price' => $price,
    ]);

    header('Location: admin-car.php');
}