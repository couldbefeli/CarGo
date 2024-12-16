<?php

session_start();
require 'connection.php';

if (!isset($_SESSION['email'])) {
    header('Location: user-sign-in.php');
}

if (isset($_SESSION['user_error'])) {
    echo '
    <script>
    alert("' . htmlspecialchars($_SESSION['user_error'], ENT_QUOTES, 'UTF-8') . '");
    </script>';
    unset($_SESSION['user_error']); // Clear the error message after displaying it
}


$sqlQuery = "CALL sp_select_user(?)";
$statement = $connection->prepare($sqlQuery);
$statement->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="img/cargo-logo-assets/CarGo-Large.png" alt="Logo"></a>
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
                    <li class="nav-item mb-3 ">
                        <a class="nav-link text-dark" href="user-billing-history.php"><i class="bi bi-receipt me-2"></i>Billing History</a>
                    </li>
                    <li class="nav-item bg-success rounded">
                        <a class="nav-link text-white" href="user-profile.php"><i class="bi bi-person-circle me-2"></i>Profile</a>
                    </li>
                </ul>
            </aside>

            <!-- Billing History Section -->
            <div class="col-12 col-md-9 col-lg-10 p-4">
                <h3>Profile</h3>

                <div class="card" style="max-width: 500px; margin: auto;">
            <div class="card-body text-center">
                <!-- Avatar -->
                <img src="img/avatar.png" alt="User Avatar" class="rounded-circle mb-4" style="width: 100px; height: 100px;">
    
                <h5 class="card-title">User Information</h5>
                <div class="row text-start mt-4">
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">First Name:</sub>
                        <p class="form-control-plaintext"><?php echo $user['First_Name'] ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">Last Name:</sub>
                        <p class="form-control-plaintext"><?php echo $user['Last_Name'] ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <sub class="form-sub text-body-tertiary">Email:</sub>
                        <p class="form-control-plaintext"><?php echo $user['Email'] ?></p>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <sub class="form-sub text-body-tertiary">Address:</sub>
                        <p class="form-control-plaintext"><?php echo $user['Address'] ?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="user-logout.php"><button class="btn text-success me-2" >
                        Log out
                    </button></a>
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
                        <form action="user-update-password-logic.php" method="POST">
                            <div class="mb-3">
                                <sub for="currentPassword" class="form-sub text-body-tertiary">Current Password</sub>
                                <input type="password" class="form-control" id="currentPassword" name="userCurrentPassword" required>
                            </div>
                            <div class="mb-3">
                                <sub for="newPassword" class="form-sub text-body-tertiary">New Password</sub>
                                <input type="password" class="form-control" id="newPassword" name="userNewPassword" required>
                            </div>
                            <div class="mb-3">
                                <sub for="confirmPassword" class="form-sub text-body-tertiary">Confirm New Password</sub>
                                <input type="password" class="form-control" id="confirmPassword" name="userConfirmPassword" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="userUpdatePasswordButton">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                
            </div>
        </div>
    </main>

</body>
</html>
