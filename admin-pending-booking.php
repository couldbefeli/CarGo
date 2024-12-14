<?php

session_start();


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
        <h2>Booking History</h2>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Booking_ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Model Name</th>
                    <th scope="col">PickUp Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Rent Date</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Booking Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="bookingTable">
                <tr data-status="Pending">
                    <td>101</td>
                    <td>John Doe</td>
                    <td>Toyota Corolla</td>
                    <td>2024-12-01</td>
                    <td>2024-12-05</td>
                    <td>5 Days</td>
                    <td>$200</td>
                    <td>Pending</td>
                    <td>
                        <button class="btn btn-success btn-sm acceptBtn">Accept</button>
                        <button class="btn btn-danger btn-sm doneBtn">Done</button>
                    </td>
                </tr>
                <tr data-status="Pending">
                    <td>102</td>
                    <td>Jane Smith</td>
                    <td>Honda Civic</td>
                    <td>2024-12-03</td>
                    <td>2024-12-07</td>
                    <td>4 Days</td>
                    <td>$180</td>
                    <td>Pending</td>
                    <td>
                        <button class="btn btn-success btn-sm acceptBtn">Accept</button>
                        <button class="btn btn-danger btn-sm doneBtn">Done</button>
                    </td>
                </tr>
                <tr data-status="Pending">
                    <td>103</td>
                    <td>Michael Brown</td>
                    <td>Ford Escape</td>
                    <td>2024-12-02</td>
                    <td>2024-12-06</td>
                    <td>5 Days</td>
                    <td>$250</td>
                    <td>Pending</td>
                    <td>
                        <button class="btn btn-success btn-sm acceptBtn">Accept</button>
                        <button class="btn btn-danger btn-sm doneBtn">Done</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        
    </script>

</body>

</html>
