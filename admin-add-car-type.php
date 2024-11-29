<?php

require 'connection.php';

if (isset($_POST['addCarTypeButton'])) {
    $carTypeName = $_POST['addCarTypeInput'];

    $sqlQuery = "INSERT INTO `car_type` (type_name) VALUES(:type_name)";
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':type_name' => ucfirst(strtolower($carTypeName))
    ]);

    header('Location: admin-car.php');
}