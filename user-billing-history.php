<?php

session_start();
require 'connection.php';
if (!isset($_SESSION['email'])) {
    header('Location: user-sign-in.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/cargo-logo-assets/CarGo-Large.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-success" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="user-vehicles.php">VEHICLES</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                    <a class="nav-link text-success" href="<?php if (!isset($_SESSION["email"])){echo "user-sign-in.php";} else { echo "user-chats.php";} ?>"><?php if (!isset($_SESSION["email"])){echo "SIGN IN";} else { echo "PROFILE";} 
                            ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row ">
            
            <aside class="col-12 col-md-3 col-lg-2 bg-light p-3 d-flex flex-column mt-5 rounded" style="height: max-content;">
                <ul class="nav flex-column">
                    <li class="nav-item mb-3 ">
                        <a class="nav-link text-dark" href="user-chats.php"><i class="bi bi-chat-dots me-2"></i>Chats</a>
                    </li>
                    <li class="nav-item mb-3 bg-success rounded">
                        <a class="nav-link text-white" href="user-billing-history.php"><i class="bi bi-receipt me-2"></i>Billing History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="user-profile.php"><i class="bi bi-person-circle me-2"></i>Profile</a>
                    </li>
                </ul>
            </aside>

            <!-- Billing History Section -->
            <div class="col-12 col-md-9 col-lg-10 p-4">
                <h3>Billing History</h3>
                <table class="table">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Rented Car Name</th>
                            <th>Date Rented</th>
                            <th>Payment (Cash)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ford Mustang</td>
                            <td>2024-10-12</td>
                            <td>120</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
