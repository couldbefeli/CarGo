<?php

session_start();
require 'connection.php';

if (isset($_SESSION['admin_email']) && $_SESSION['admin_id']) {
    header('admin-analytics.php');
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        html,
        body {
            height: 100vh;
        }

        /* Main content area */
        main {
            flex: 1;
        }
    </style>
</head>

<body class="d-flex flex-column h-100 align-items-center justify-content-center">
    

    <main class='my-4 d-flex mt-5' >
        <div class="container d-flex justify-content-center">
            <div>
                <div class=" d-flex justify-content-center">
                    <img src="img/cargo-logo-assets/CarGo-Large.png" alt="">
                </div>
                <div class="px-5 py-5 bg-white shadow mt-4">
                    <div class="container" style="max-width: 500px;">
                        <form action="admin-sign-in-logic.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <input type="submit" class="btn btn-success w-100" value="Sign In" name="adminSignInButton">
                        </form>
                        <hr>
                        <div class="text-center">
                            <p class="m-0">Don’t have an account? <a href="admin-sign-up.php" class="text-success">Sign
                                    Up</a></p>
                            <small class="text-body-tertiary fw-lighter">
                                <i class="bi bi-info-circle"></i>
                                If you are a
                                user trying to sign in, <a href="user-sign-in.php" class="text-body-tertiary">sign in
                                    here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    

</body>

</html>