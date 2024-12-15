<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '
    <script>
    alert("' . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . '");
    </script>';
    unset($_SESSION['error']); // Clear the error message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

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

    <main class='mt-2 mb-5
    '>
        <div class="container d-flex justify-content-center">
            <div>
                <h1 class="mb-2 text-center">Sign Up</h1>
                <div class="px-5 py-5 bg-white shadow">
                    <div class="container" style="max-width: 729px;">
                        <form action="user-sign-up-logic.php" method="POST" enctype="multipart/form-data">
                            <!-- First Name -->
                            <div class="mb-3 d-flex col">
                                <div class="w-100">
                                    <label for="firstname" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3 d-flex col">
                                <div class="w-100">
                                    <label for="lastname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="mb-3 d-flex col">
                                <div class="w-100">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input type="number" class="form-control" id="contact" name="contact" required>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row">
                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Email and Valid ID -->
                            <div class="row">
                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex col">
                                    <div class="w-100">
                                        <label for="id" class="form-label">Valid ID</label>
                                        <input type="file" class="form-control" id="id" name="id" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Password and Confirm Password -->
                            <div class="row">
                                <div class="mb-3 d-flex col">
                                    <div class="w-100 position-relative">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" minlength="4" maxlength="16" required>
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                        <small class="form-text text-muted">Password must be between 4 and 16 characters.</small>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex col">
                                    <div class="w-100 position-relative">
                                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirmpassword" name="confirmPassword" minlength="4" maxlength="16" required>
                                            <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                                <i class="bi bi-eye-slash" id="toggleConfirmPasswordIcon"></i>
                                            </span>
                                        </div>
                                        <small class="form-text text-danger" id="passwordMismatch" style="display: none;">Passwords do not match!</small>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-success w-100" value="Sign Up" name="user-signup-button">
                        </form>


                        <hr>
                        <div class="text-center">
                            <p>Already have an account? <a href="user-sign-in.php" class="text-success">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="footer mt-auto bg-light my-5 py-5">
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
    // eye toggle on password
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });

    // eye toggle on confirm password
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmPasswordField = document.getElementById('confirmpassword');
        const icon = document.getElementById('toggleConfirmPasswordIcon');
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });

    // check if password and confirm password matches
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirmpassword');
    const passwordMismatchText = document.getElementById('passwordMismatch');

    confirmPasswordField.addEventListener('input', function() {
        if (passwordField.value !== confirmPasswordField.value) {
            passwordMismatchText.style.display = 'block';
        } else {
            passwordMismatchText.style.display = 'none';
        }
    });

    passwordField.addEventListener('input', function() {
        if (passwordField.value !== confirmPasswordField.value) {
            passwordMismatchText.style.display = 'block';
        } else {
            passwordMismatchText.style.display = 'none';
        }
    });
</script>

</html>