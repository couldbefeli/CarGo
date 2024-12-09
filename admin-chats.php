<?php
require 'connection.php';

$sqlQuery = "SELECT * FROM `accounts` WHERE Verification = 1";
$statement = $connection->prepare($sqlQuery);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chats</title>
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

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .content {
                padding: 10px;
            }

            .container-fluid {
                flex-wrap: wrap;
                justify-content: center;
            }

            .sidebar a button {
                text-align: center;
            }

            .d-flex.align-items-center img {
                width: 30px;
                height: 30px;
            }

            .sidebar h4 {
                text-align: center;
            }

            .container img {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                padding: 10px;
            }

            .content {
                padding: 5px;
            }

            .card {
                margin: 10px 0;
            }

            #chat-content {
                font-size: 14px;
            }

            .input-group input {
                font-size: 12px;
            }

            .btn {
                font-size: 14px;
            }
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
                <a href="admin-rental.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-clock-fill me-2"></i>Rental History</button></a>

                <hr class="text-secondary my-4">
                <a href="admin-chats.php"><button class="btn btn-success w-100 d-flex align-items-start"><i
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
                    <p class="text-dark m-0 fw-bold">Admin01</p>
                </div>
            </div>
        </div>

    </div>

    <div class="sidebar bg-white shadow-lg d-flex flex-column justify-content-between vh-100">
        <div>
            <div class="container text-success">
                <div>
                    <?php foreach ($result as $row): ?>
                        <a class="btn m-0 p-0 py-2 mb-2">
                            <div class="container-fluid d-flex text-success  w-100 align-items-center">
                                <img src="img/avatar.png" alt="" width="34" class=" me-2 rounded-circle">
                                <small class="m-0 "><?php echo $row['First_Name'] . " " . $row['Last_Name'] ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="col-12 col-md-9 col-lg-10 d-flex flex-column p-4">

            <h3 class="text-start">Chats</h3>
            <div class="container d-flex flex-column bg-light p-0"
                style="max-width: 100%; height: 75vh; border: 1px solid #ddd; border-radius: 8px;">

                <div id="chat-content" class="flex-grow-1 p-3 overflow-auto d-flex flex-column-reverse">
                    <!-- Chat Sent -->
                    <div class="d-flex justify-content-end mb-3">
                        <div class="p-3 bg-success text-white rounded-3" style="max-width: 75%;">
                            <p class="mb-0">I'm good, thank you! How about you?</p>
                            <small class="text-white-50">12:01 PM</small>
                        </div>
                    </div>

                    <!-- Chat Received -->
                    <div class="d-flex mb-3">
                        <div class="p-3 bg-body-secondary rounded-3" style="max-width: 75%;">
                            <p class="mb-0">Hello! How are you doing?</p>
                            <small class="text-muted">12:00 PM</small>
                        </div>
                    </div>


                </div>
                <form action="">
                    <div class="p-3 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder='Aa' aria-label="Type a message">
                            <button class="btn btn-success" type="button"><i class="bi bi-send-fill"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    </div>

    <script>

    </script>
</body>

</html>