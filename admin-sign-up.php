<?php

session_start();
require 'connection.php';

echo '<script>alert($_SESSION[\'error\']) </script>';

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
                        <form action="admin-sign-up-logic.php" method="POST">
                            <div class="row">
                                
                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="admin_firstname" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="admin_firstname" name="admin_firstname"
                                            >
                                    </div>
                                </div>

                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="admin_lastname" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="admin_lastname" name="admin_lastname"
                                            >
                                    </div>
                                </div>

                            </div>

                            <div class="row ">

                                <div class="mb-3 d-flex col ">
                                    <div class="w-100">
                                        <label for="admin_address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="admin_address" name="admin_address"
                                            >
                                    </div>
                                </div>

                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="admin_contact" class="form-label">Contact #</label>
                                        <input type="number" class="form-control" id="admin_contact"
                                        name="admin_contact" >
                                    </div>
                                </div>


                            </div>

                            <div class="row ">

                                <div class="mb-3 d-flex col ">
                                    <div class="w-100">
                                        <label for="admin_email" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" id="admin_email"
                                        name="admin_email" >
                                    </div>
                                </div>

                            </div>

                            <div class="row ">

                                <div class="mb-3 d-flex col ">
                                    <div class="w-100">
                                        <label for="admin_password" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="admin_password"
                                        name="admin_password" >
                                    </div>
                                </div>

                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="admin_confirmpassword" class="form-label">Confirm Password</label>
                                        <input type="text" class="form-control" id="admin_confirmpassword"
                                        name="admin_confirmpassword">
                                    </div>
                                </div>


                            </div>

                            <input type="submit" class="btn btn-success w-100" value="Sign In" name="adminSignUpButton">
                        </form>
                        <hr>
                        <div class="text-center">
                            <p class="m-0">Already have an account? <a href="admin-sign-in.php" class="text-success">Sign
                                    In</a></p>
                            <small class="text-body-tertiary fw-lighter">
                                <i class="bi bi-info-circle"></i>
                                If you are a
                                user trying to sign up, <a href="user-sign-up.php" class="text-body-tertiary">sign up
                                    here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    

</body>

</html>