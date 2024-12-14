<?php 
session_start();
require 'connection.php';

if (!isset($_SESSION['admin_email']) && !isset($_SESSION['admin_id'])) {
    header('Location: admin-sign-in.php');
    exit(); // Ensure the script stops execution after redirection
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Rental History</title>
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
            <nav class="">
                <div class="container-fluid mb-5 d-flex justify-content-center">
                    <img src="img/cargo-logo-assets/CarGo-Large.png" alt="">
                </div>
                <a href="admin-analytics.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-bar-chart-fill me-2"></i>Analytics</button></a>
                <a href="admin-car.php"><button class="btn w-100 text-success d-flex align-items-start"><i
                            class="bi bi-car-front-fill me-2"></i>Cars</button></a>
                <a href="admin-user.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-people-fill me-2"></i>Users</button></a>
                <a href="admin-rental.php"><button class="btn btn-success w-100 d-flex align-items-start"><i
                            class="bi bi-clock-fill me-2"></i>Rental History</button></a>
                            <a href="admin-pending-booking.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-hourglass me-2"></i>Pending Booking</button></a>

                <hr class="text-secondary my-4">
                <a href="admin-chats.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-chat-dots-fill me-2 position-relative"><span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden"></span>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Rental History</h2>

        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 row-cols-xl-9 gx-3 gy-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card bg-transparent" style="width: 100%;">
                    <div class="bg-body-secondary p-5">
                        <img src="img/car.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Chevrolet Corvette Z06 2018</h6>
                        <div class="d-flex justify-content-end">

                            <button class="btn btn-sm btn-success " data-bs-toggle="modal"
                                data-bs-target="#historyCarModal" id="historyCarModalButton">View History</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <!-- modal for update car -->

    <div class="modal fade" id="historyCarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chevrolet Corvette Z06-2018</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Car</th>
                            <th scope="col">Username</th>
                            <th scope="col">Cash Payment</th>
                            <th scope="col">Days</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Chevrolet Corvette Z06 2018</td>
                            <td>juandealcruz00</td>
                            <td>₱ 46,600</td>
                            <td>4</td>
                            <td>March 4, 2023</td>
                          </tr>
                         
                        </tbody>
                      </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <script>

    </script>
</body>

</html>