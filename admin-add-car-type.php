<?php

require 'connection.php';

if (isset($_POST['addCarTypeButton'])) {
    $carTypeName = $_POST['addCarTypeInput'];

    $SQL_ADD_USER_QUERY = "CALL sp_add_car_type(?)";
    $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);
    $sql_add->bindValue(1, $carTypeName, PDO::PARAM_STR);

    $sql_add->execute();

    header('Location: admin-car.php');
}