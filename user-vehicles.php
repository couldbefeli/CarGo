<?php

session_start();
require 'connection.php';

$sqlCars = "SELECT * FROM `cars`";
$statement = $connection->prepare($sqlCars);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$sqlCarType = "SELECT type_name, brand_name FROM `car_type`, `car_brand` WHERE car_type.type_id = car_brand.brand_id";
$statement = $connection->prepare($sqlCarType);
$statement->execute();
$result2 = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <style>
        input[type="checkbox"]:checked {
            background-color: green;
        }
    </style>
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
                        <a class="nav-link active text-success" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success-emphasis" href="user-vehicles.php">VEHICLES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-success" href="<?php if (!isset($_SESSION["email"])) {
                                                                    echo "user-sign-in.php";
                                                                } else {
                                                                    echo "user-chats.php";
                                                                } ?>"><?php if (!isset($_SESSION["email"])) {
                                                                            echo "SIGN IN";
                                                                        } else {
                                                                            echo "PROFILE";
                                                                        }
                                                                        ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row">
            <aside class="col-12 col-md-3 col-lg-2 bg-body-tertiary p-3 vh-100">
                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Filter</h4>
                        <a href="#" class="text-success">Reset</a>
                    </div>
                    <div class="d-flex flex-column p-3 bg-body-secondary border-0 rounded mb-4">
                        <h5>Types</h5>
                        <div class="d-flex flex-wrap " style="gap: .5rem;">
                            <?php foreach ($result2 as $row): ?>

                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" value="<?php echo $row['type_name'] ?>" id="<?php echo $row['type_name'] ?>">
                                    <label class="form-check-label" for="<?php echo $row['type_name'] ?>"><?php echo $row['type_name'] ?></label>


                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="d-flex flex-column p-3 bg-body-secondary border-0 rounded mb-4">
                        <h5>Brand</h5>
                        <div class="d-flex flex-wrap" style="gap: .5rem;">
                            <?php foreach ($result2 as $row): ?>

                                <input type="checkbox" class="btn-check" id="<?php echo $row['brand_name'] ?>" >
                                <label class="btn btn-outline-success btn-sm" for="<?php echo $row['brand_name'] ?>"><?php echo $row['brand_name'] ?></label>
                            <?php endforeach; ?>

                        </div>
                    </div>


                </div>
            </aside>

            <div class="col-12 col-md-9 col-lg-10 p-3">
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-9 g-3">
                    <?php foreach ($result as $row): ?>
                        <div class="col">
                            <div class="card">
                                <div class="d-flex justify-content-center bg-body-secondary p-3">
                                    <img src="img/cars/<?php echo $row['Car_Image'] ?>" class="card-img-top" alt="..."
                                        style=" max-width: 14rem;" width="100" height="140">
                                </div>
                                <div class="card-body">
                                    <h5><?php echo $row['Brand'] . " " . $row['Model_Name'] ?></h5>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex mb-3 text-body-tertiary">
                                            <div class="me-4"><i class="bi bi-car-front-fill"></i>
                                                <caption><?php echo ucfirst($row['Transmission']) ?></caption>
                                            </div>
                                            <div class="me-4"><i class="bi bi-person-fill"></i>
                                                <caption><?php echo $row['Capacity'] ?> Seater</caption>
                                            </div>
                                            <caption>₱<?php echo $row['Price'] ?></caption>
                                        </div>
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="<?php if (!isset($_SESSION['email'])) {
                                                                echo "#signInModal";
                                                            } else if (isset($_SESSION['email'])) {
                                                                echo "#reserveCar-" . $row['Car_ID'];
                                                            }  ?>">Reserve Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal for reserving a car SESSION EMAIL TRUE -->
                        <div class="modal fade" tabindex="-1" id="reserveCar-<?php echo $row['Car_ID'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo $row['Brand'] . " " . $row['Model_Name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="bg-body-secondary px-4 py-5">
                                            <div class="d-flex justify-content-center ">
                                                <img src="img/cars/<?php echo $row['Car_Image'] ?>" alt="" class="w-100">
                                            </div>
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="mt-2">Rent Date</h4>
                                            <h6 class="mt-2 text-end">
                                                <small><?php echo $row['Price'] ?></small>
                                                <caption>/day</caption>
                                            </h6>
                                        </div>


                                        <div class="mb-3">
                                            <form action="" class="row">
                                                <div class="col">
                                                    <label for="rentFromDate" class="form-label text-body-tertiary">Pickup Date</label>
                                                    <input type="date" class="form-control" id="pickupDate"
                                                        placeholder="name@example.com">
                                                </div>

                                                <div class="col">
                                                    <label for="rentToDate" class="form-label text-body-tertiary">Return Date</label>
                                                    <input type="date" class="form-control" id="returnDate"
                                                        placeholder="name@example.com">
                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Reserve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>



                </div>

                <!-- modal for SESSION EMAIL FALSE -->
                <div class="modal fade" id="signInModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                You need to sign in to reserve a car. Click the button below to sign in.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="user-sign-in.php"><button type="button" class="btn btn-success">Sign In</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        const myInput = document.getElementById('myInput')
    </script>
</body>

</html>