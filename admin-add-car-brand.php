<?php

require 'connection.php';

if (isset($_POST['addCarBrandButton'])) {
    $carBrandName = $_POST['addCarBrandInput'];

    $SQL_ADD_USER_QUERY = "CALL sp_add_car_brand(?)";
    $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);
    $sql_add->bindValue(1, $carBrandName, PDO::PARAM_STR);

    $sql_add->execute();

    header('Location: admin-car.php');
}