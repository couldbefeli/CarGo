<?php

session_start();
require 'connection.php';
date_default_timezone_set('Asia/Manila');

if (isset($_POST['reserveButton'])) {
    
    $carID = $_POST['Car_ID'];
    $origPrice = $_POST['price'];

    $pickUpHour = date("H:i:s");
    $accountID = $_SESSION['user_id'];
    $pickupDate = date("Y-m-d", strtotime($_POST['pickupDate']));
    $returnDate = date("Y-m-d", strtotime($_POST['returnDate']));
    $bookingStatus = 1;
    $totalDays = max(1, date_diff(date_create($pickupDate), date_create($returnDate))->days);
    $totalPrice = $origPrice * $totalDays;

    $sqlFetchBooking = "CALL sp_checkdate(?)";
    $stmt = $connection->prepare($sqlFetchBooking);
    $stmt->bindParam(1, $carID, PDO::PARAM_INT);
    $stmt->execute();



    $bookingSpecific = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($bookingSpecific);

    $stmt->closeCursor();
    
   if ($totalDays > 7){
        $_SESSION['error'] = "The rental period cannot exceed 7 days.";
        header("Location: user-vehicles.php");
        exit;
    }

    // foreach ($bookingSpecific as $booking) {
    //     $existingStartDate = $booking['PickUp_Date'];
    //     $existingEndDate = $booking['Return_Date'];

    //     if (isDateOverlapping($pickupDate, $returnDate, $existingStartDate, $existingEndDate)) {
    //         $_SESSION['error'] = "Please Select another date. Someone booked that date already";
    //         header("Location: user-vehicles.php");
    //     };

    // }

    

    $sqlQuery = "CALL sp_add_booking(?, ?, ? ,? ,?, ?, ?)";
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $carID, PDO::PARAM_INT);
    $statement->bindParam(2, $accountID, PDO::PARAM_INT);
    $statement->bindParam(3, $pickupDate, PDO::PARAM_STR);
    $statement->bindParam(4, $returnDate, PDO::PARAM_STR);
    $statement->bindParam(5, $bookingStatus, PDO::PARAM_INT);
    $statement->bindParam(6, $totalDays, PDO::PARAM_INT);

    $statement->bindParam(7, $totalPrice, PDO::PARAM_INT);


    $statement->execute();



    // echo $totalPrice;
    $_SESSION['reserve_success'] = "You have successfully reserved a car. You are being redirected to your billing history now.";
    header("Location: user-billing-history.php");
}

function isDateOverlapping($startDate1, $endDate1, $startDate2, $endDate2) {
    $start1 = $startDate1;
    $end1 = $endDate1;
    $start2 = strtotime($startDate2);
    $end2 = strtotime($endDate2);


    return ($start1 <= $end2 && $end1 >= $start2);
}