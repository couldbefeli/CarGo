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

    $sqlQuery = "INSERT INTO `cars` (Model_Name, Brand, Car_Type, Capacity, Transmission, Price, Car_Image, Car_Status) VALUES (:model, :brand, :type, :capacity, :transmission, :price,  :car_image, :car_status)";

    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':model' => $model,
        ':brand' => $brand,
        ':type' => $type,
        ':capacity' => $capacity,
        ':transmission' => $transmission,
        ':price' => $price,
        ':car_image' => $file_name,
        ':car_status' => 'available',

    ]);

    move_uploaded_file($temporary_name, $folder);
    header('Location: admin-car.php');
    
}


