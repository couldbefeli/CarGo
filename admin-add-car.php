<?php

require 'connection.php';

if (isset($_POST['addCarButton'])) {
    $file_name = $_FILES['carPic']['name'];
    $temporary_name = $_FILES['carPic']['tmp_name'];
    $folder = "img/cars/$file_name";

    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $seats = $_POST['seats'];
    $model = $_POST['model'];
    $transmission = $_POST['transmission'];
    $price = $_POST['price'];

    
}


