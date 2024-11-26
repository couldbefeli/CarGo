<?php 
    require "connection.php";
    session_start();
    // unset($_SESSION["email"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>CarGo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
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
                        <a class="nav-link active text-success-emphasis" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="user-vehicles.php">VEHICLES</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-success" href="<?php if (!isset($_SESSION["email"])){echo "user-sign-in.php";} else { echo "user-chats.php";} ?>"><?php if (!isset($_SESSION["email"])){echo "SIGN IN";} else { echo "PROFILE";} 
                            ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="introduction">
        <div class="first-row">
            <div class="green-picture-container">
                <img class="green-picture" src="img/green-circle.png" alt="a green image">
            </div>
            <div class="cargo-title">
                <h1>CarGo

                </h1>
            </div>
        </div>
        <div class="second-row">
            <div class="second-row-column">
                <div class="second-row-intro">
                    <h2 class="second-row-header">Sustainable Drive Your Adventure Today!</h2>
                    <p class="second-row-paragraph">Find the perfect ride for every journey. Discover our range of cars,
                        from luxury to economy, tailored to suit every road and every traveler.</p>
                </div>
                <div class="second-row-button">
                    <button class="explore">EXPLORE OUR FLEET</button>
                    <button class="book-now">BOOK NOW</button>
                </div>
            </div>
            <div class="second-row-pictures">
                <img class="first-picture" src="img/place-holder-img-1.jpeg" alt="introduction of a car">
                <img class="second-picture" src="img/place-holder-img-2.jpeg" alt="introduction of a car">
            </div>
        </div>

    </section>

    <section class="our-car-brands">
        <div class="our-car-brands-container">
            <div class="car-brand-heading-container">
                <h1 class="our-car-brands-heading">Our Car Brands</h1>
            </div>

            <div class="car-brand-logo-container">
                <div class="car-brand-logo">
                    <img class="logo resize-logo" src="img/car-brands/toyota.png" alt="toyota">
                    <img class="logo" src="img/car-brands/honda.png" alt="honda">
                    <img class="logo" src="img/car-brands/ford.png" alt="ford">
                    <img class="logo" src="img/car-brands/chevrolet.png" alt="chevrolet">
                    <img class="logo" src="img/car-brands/nissan.png" alt="nissan">
                    <img class="logo" src="img/car-brands/bmw.png" alt="bmw">
                    <img class="logo" src="img/car-brands/audi.png" alt="audi">
                    <img class="logo resize-logo" src="img/car-brands/mitsubishi.png" alt="mitsubishi">
                </div>
            </div>
        </div>
    </section>

    <section class="featured-cars">
        <div class="featured-cars-container">
            <div class="feature-heading-container">
                <h1 class="featured-heading">Featured</h1>
            </div>
            <div class="carousel-container">
                <div class="carousel">
                    <div class="card border-0">
                        <div class="car-info">
                            <img src="img/car-featured/featured-placeholder.png" alt="a photo and description of a car">
                            <h3 class="car-name">Chevrolet Corvette Z06 2018</h3>
                            <p class="car-description">The 2018 Chevrolet Corvette Z06 delivers thrilling power with a
                                supercharged V8 engine and bold, iconic design—perfect for an unforgettable drive.</p>
                        </div>
                        <div class="reserve-btn-container">
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="car-info">
                            <img src="img/car-featured/featured-placeholder.png" alt="a photo and description of a car">
                            <h3 class="car-name">Chevrolet Corvette Z06 2018</h3>
                            <p class="car-description">The 2018 Chevrolet Corvette Z06 delivers thrilling power with a
                                supercharged V8 engine and bold, iconic design—perfect for an unforgettable drive.</p>
                        </div>
                        <div class="reserve-btn-container">
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="car-info">
                            <img src="img/car-featured/featured-placeholder.png" alt="a photo and description of a car">
                            <h3 class="car-name">Chevrolet Corvette Z06 2018</h3>
                            <p class="car-description">The 2018 Chevrolet Corvette Z06 delivers thrilling power with a
                                supercharged V8 engine and bold, iconic design—perfect for an unforgettable drive.</p>
                        </div>
                        <div class="reserve-btn-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us">
        <div class="about-us-container">
            <div class="about-us-heading-container">
                <h1 class="about-us-heading">About Us</h1>
            </div>
            <div class="about-us-row-container">
                <div class="about-us-row">
                    <div class="about-us-card">
                        <img class="about-us-img" src="img/about-us/about-us-placeholder.png" alt="">
                        <div class="about-us-info">
                            <div class="contact-title">Easy online booking</div>
                            <div class="contact-description">Enjoy fast and easy online booking for a seamless rental
                                experience.</div>
                        </div>
                    </div>
                    <div class="about-us-card">
                        <img class="about-us-img" src="img/about-us/about-us-placeholder.png" alt="">
                        <div class="about-us-info">
                            <div class="contact-title">Easy online booking</div>
                            <div class="contact-description">Enjoy fast and easy online booking for a seamless rental
                                experience.</div>
                        </div>
                    </div>
                    <div class="about-us-card">
                        <img class="about-us-img" src="img/about-us/about-us-placeholder.png" alt="">
                        <div class="about-us-info">
                            <div class="contact-title">Easy online booking</div>
                            <div class="contact-description">Enjoy fast and easy online booking for a seamless rental
                                experience.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

</html>