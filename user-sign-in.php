<?php
session_start();
require "connection.php";

if (isset($_SESSION['error'])) {
    echo '
    <script>
    alert("' . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . '");
    </script>';
    unset($_SESSION['error']); // Clear the error message after displaying it
}
if (isset($_SESSION['user_success'])) {
    echo '
    <script>
    alert("' . htmlspecialchars($_SESSION['user_success'], ENT_QUOTES, 'UTF-8') . '");
    </script>';
    unset($_SESSION['user_success']); // Clear the error message after displaying it
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
            height: 100%;
        }

        /* Main content area */
        main {
            flex: 1;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/cargo-logo-assets/CarGo-Large.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-success" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="user-vehicles.php">VEHICLES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success-emphasis" href="user-sign-in.php">SIGN IN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class='my-4'>
        <div class="container d-flex justify-content-center">
            <div>
                <h1 class="mb-5 text-center">Sign In</h1>
                <div class="px-5 py-5 bg-white shadow">
                    <div class="container" style="max-width: 500px;">

                    <!-- form -->
                        <form method="POST" action="user-sign-in-logic.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" min="4" max="16" required>
                                    <span class="input-group-text bg-transparent border-start-0" style="cursor: pointer;">
                                        <i class="bi bi-eye-slash text-muted" id="togglePassword"></i>
                                    </span>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success w-100" value="Sign In" name="userSigninButton">
                        </form>
                        <hr>
                        <div class="text-center">
                            <p class="m-0">Don’t have an account? <a href="user-sign-up.php" class="text-success">Sign
                                    Up</a></p>
                            <small class="text-body-tertiary fw-lighter">
                                <i class="bi bi-info-circle"></i>
                                If you are an
                                admin trying to sign in, <a href="admin-sign-in.php" class="text-body-tertiary">sign in
                                    here</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="footer mt-auto bg-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 d-flex align-items-center mb-3 mb-md-0">
                    <a href="#"><img src="img/cargo-logo-assets/CarGo-White-BG.png" alt="CarGo Logo"
                            class="img-fluid"></a>
                </div>

                <div class="col-md-3 mb-3">
                    <h5 class="footer-title">Top Cities</h5>
                    <ul class="list-unstyled">
                        <li>Manila</li>
                        <li>Baguio</li>
                        <li>Cabanatuan</li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3">
                    <h5 class="footer-title">Explore</h5>
                    <ul class="list-unstyled">
                        <li>Intercity Ride</li>
                        <li>Limousine Service</li>
                        <li>Private Car Service</li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3">
                    <h5 class="footer-title">Intercity Rides</h5>
                    <ul class="list-unstyled">
                        <li>Manila - Cabanatuan</li>
                        <li>Cabanatuan - Baguio</li>
                        <li>Baguio - Manila</li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4 align-items-center">
                <div class="col-md-6 d-flex justify-content-start mb-3 mb-md-0">
                    <a href="#" class="me-3">Terms</a>
                    <a href="#" class="me-3">Privacy Policy</a>
                    <a href="#" class="me-3">Legal Notice</a>
                    <a href="#" class="me-3">Accessibility</a>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#"><img src="img/social-logo/youtube.png" alt="YouTube" class="social-logo me-2"></a>
                    <a href="#"><img src="img/social-logo/twitter.png" alt="Twitter" class="social-logo me-2"></a>
                    <a href="#"><img src="img/social-logo/facebook.png" alt="Facebook" class="social-logo me-2"></a>
                    <a href="#"><img src="img/social-logo/instagram.png" alt="Instagram" class="social-logo me-2"></a>
                    <a href="#"><img src="img/social-logo/linkedin.png" alt="LinkedIn" class="social-logo"></a>
                </div>
            </div>
        </div>
    </footer>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {

            // show and unshow password
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // toggle the icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
</script>

</html>