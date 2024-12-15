<?php

session_start();
require 'connection.php';

$sqlQuery = "SELECT * FROM v_booking_pending";
$statement = $connection->prepare($sqlQuery);
$statement->execute();
$pendingBookings = $statement->fetchAll(PDO::FETCH_ASSOC);

// var_dump($pendingBookings)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bookings</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 15px 0;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .card {
            margin: 15px 0;
        }

        canvas {
            max-height: 300px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar bg-white shadow-lg d-flex flex-column justify-content-between vh-100">
        <div>
            <nav>
                <div class="container-fluid mb-5 d-flex justify-content-center">
                    <img src="img/cargo-logo-assets/CarGo-Large.png" alt="">
                </div>
                <a href="admin-analytics.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-bar-chart-fill me-2"></i>Analytics</button></a>
                <a href="admin-car.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-car-front-fill me-2"></i>Cars</button></a>
                <a href="admin-user.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-people-fill me-2"></i>Users</button></a>
                <a href="admin-rental.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-clock-fill me-2"></i>Rental History</button></a>
                <a href="admin-rental.php"><button class="btn btn-success w-100 d-flex align-items-start"><i
                            class="bi bi-hourglass me-2"></i>Pending Booking</button></a>
                <hr class="text-secondary my-4">
                <a href="admin-chats.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-chat-dots-fill me-2 position-relative"><span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span></i></i>Chats</button></a>
                <a href="admin-profile.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-gear-fill me-2"></i></i>Profile</button></a>
            </nav>
        </div>
        <div>
            <hr class="text-secondary my-4">
            <div class="d-flex align-items-center ">
                <img src="img/avatar.png" class="me-3" width="40" height="40">
                <div class=" d-flex flex-column justify-content-center">
                    <small class="text-secondary">Welcome back <span>👋</span></small>
                    <p class="text-dark m-0 fw-bold"><?php echo $_SESSION['admin_firstName'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>Pending Booking</h2>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Booking_ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Model Name</th>
                    <th scope="col">PickUp Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Booking Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="bookingTable">
                <?php foreach ($pendingBookings as $pendingBooking): ?>
                    <?php if ($pendingBooking['Booking_Status'] != "Done"): ?>
                        <tr>
                            <td><?php echo $pendingBooking['Booking_ID'] ?></td>
                            <td><?php echo $pendingBooking['customer_name'] ?></td>
                            <td><?php echo $pendingBooking['Model_Name'] ?></td>
                            <td><?php echo date("F j, Y", strtotime($pendingBooking['PickUp_Date']))  ?></td>
                            <td><?php echo date("F j, Y", strtotime($pendingBooking['Return_Date'])) ?></td>
                            <td><?php echo $pendingBooking['Total_Price'] ?></td>
                            <td><?php echo $pendingBooking['Booking_Status'] ?></td>
                            <td>
                                <form action="admin-accept-pending-booking.php" method="POST">
                                    <input type="hidden" name="bookingID" value="<?php echo $pendingBooking['Booking_ID'] ?>">
                                    <button type="submit" class="btn btn-success btn-sm acceptBtn" name="acceptButton">Accept</button>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#deleteCarModal-<?php echo $pendingBooking['Booking_ID']; ?>" class="btn btn-danger btn-sm doneBtn" name="doneButton">Done</button>

                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteCarModal-<?php echo $pendingBooking['Booking_ID']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">This cannot be undone.</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to mark this booking as done?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="admin-accept-pending-booking.php" method="POST">
                                            <input type="hidden" name="bookingID" value="<?php echo $pendingBooking['Booking_ID'] ?>">
                                            <button type="submit" name="doneButton" class="btn btn-danger">Confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

            </tbody>
        <?php endforeach; ?>
        </table>
    </div>

    <script>

    </script>

</body>

</html>