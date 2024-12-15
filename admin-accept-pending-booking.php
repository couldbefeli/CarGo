<?php

require 'connection.php';

if (isset($_POST['acceptButton'])) {
    $id = $_POST['bookingID'];

    $status = "Ongoing";

    $sqlQuery = "CALL sp_update_booking_status(?, ?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1,$id, PDO::PARAM_INT);
    $statement->bindParam(2,  $status, PDO::PARAM_STR);

    $statement->execute();


    header("Location: admin-pending-booking.php");

} else if (isset($_POST['doneButton'])) {
    $id = $_POST['bookingID'];


    $status = "Done";

    $sqlQuery = "CALL sp_update_booking_status(?, ?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1,$id, PDO::PARAM_INT);
    $statement->bindParam(2, $status, PDO::PARAM_STR);

    $statement->execute();

    header("Location: admin-pending-booking.php");

}
