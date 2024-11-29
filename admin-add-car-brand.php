<?php

require 'connection.php';

if (isset($_POST['addCarBrandButton'])) {
    $carBrandName = $_POST['addCarBrandInput'];

    $sqlQuery = "INSERT INTO `car_brand` (brand_name) VALUES(:brand_name)";
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':brand_name' => ucfirst(strtolower($carBrandName))
    ]);

    header('Location: admin-car.php');
}