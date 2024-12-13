<?php

require 'connection.php';

if (isset($_POST['reserveButton'])) {
    $carID = $_POST['Car_ID'];
    echo $carID;
}