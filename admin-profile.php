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
                <a href="admin-chats.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-chat-dots-fill me-2 position-relative"><span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden"></span>
                            </span></i></i>Chats</button></a>
                <a href="admin-profile.php"><button class="btn btn-success w-100 d-flex align-items-start"><i
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



    <div class="content">
        <h2 class="mb-4">Profile</h2>
    
        <!-- User Information Section -->
        <div class="card" style="max-width: 500px; margin: auto;">
            <div class="card-body text-center">
                <!-- Avatar -->
                <img src="img/avatar.png" alt="User Avatar" class="rounded-circle mb-4" style="width: 100px; height: 100px;">
    
                <h5 class="card-title">User Information</h5>
                <div class="row text-start mt-4">
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">First Name:</sub>
                        <p class="form-control-plaintext">John</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">Last Name:</sub>
                        <p class="form-control-plaintext">Doe</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">Email:</sub>
                        <p class="form-control-plaintext">john.doe@example.com</p>
                    </div>
                    <div class="col-md-6 mb-3 text-body-tertiary">
                        <sub class="form-sub">Username:</sub>
                        <p class="form-control-plaintext">Admin01</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <sub class="form-sub text-body-tertiary">Address:</sub>
                        <p class="form-control-plaintext">123 Main St, Springfield, USA</p>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn text-success me-2" >
                        Log out
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        Change Password
                    </button>
                </div>
                
                
            </div>
        </div>
    
        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-subledby="changePasswordModalsub"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalsub">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-sub="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <sub for="currentPassword" class="form-sub text-body-tertiary">Current Password</sub>
                                <input type="password" class="form-control" id="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <sub for="newPassword" class="form-sub text-body-tertiary">New Password</sub>
                                <input type="password" class="form-control" id="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <sub for="confirmPassword" class="form-sub text-body-tertiary">Confirm New Password</sub>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>

    <script>

    </script>
</body>

</html>