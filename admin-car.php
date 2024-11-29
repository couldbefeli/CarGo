<?php

require 'connection.php';

$sqlCarType = "SELECT type_name, brand_name FROM `car_type`, `car_brand` WHERE car_type.type_id = car_brand.brand_id";
$statement = $connection->prepare($sqlCarType);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cars</title>
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar bg-white shadow-lg d-flex flex-column justify-content-between vh-100">
        <div>
            <h4>Admin Dashboard</h4>
            <nav class="">
                <div class="container-fluid mb-5 d-flex justify-content-center">
                    <img src="img/cargo-logo-assets/CarGo-Large.png" alt="">
                </div>
                <a href="admin-analytics.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-bar-chart-fill me-2"></i>Analytics</button></a>
                <a href="admin-car.php"><button class="btn btn-success w-100 d-flex align-items-start"><i
                            class="bi bi-car-front-fill me-2"></i>Cars</button></a>
                <a href="admin-user.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-people-fill me-2"></i>Users</button></a>
                <a href="#"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-clock-fill me-2"></i>Rental History</button></a>

                <hr class="text-secondary my-4">
                <a href="admin-chats.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-chat-dots-fill me-2 position-relative"><span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
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

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Car Management</h2>
            <div class="d-flex">
                <button type="button" class="btn btn-success d-flex align-items-center me-2" data-bs-toggle="modal"
                    data-bs-target="#addCarBrandModal" id="addCarBrandModalButton">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Car Brand
                </button>
                <button type="button" class="btn btn-success d-flex align-items-center me-2" data-bs-toggle="modal"
                    data-bs-target="#addCarTypeModal" id="addCarTypeModalButton">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Car Type
                </button>
                <button type="button" class="btn btn-success d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#addCarModal" id="addCarModalButton">
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Car
                </button>
            </div>

        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 row-cols-xl-9 gx-3 gy-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="card bg-transparent" style="width: 100%;">
                    <div class="bg-body-secondary p-5">
                        <img src="img/car.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Chevrolet Corvette Z06 2018</h6>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-danger w-100 me-2" data-bs-toggle="modal"
                                data-bs-target="#deleteCarModal" id="deleteCarModalButton">Delete</button>
                            <button class="btn btn-sm btn-warning  w-100" data-bs-toggle="modal"
                                data-bs-target="#editCarModal" id="editCarModalButton">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for add CAR BRAND -->
    <div class="modal fade" id="addCarBrandModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a Car Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin-add-car-brand.php" method="POST">
                    <div class="modal-body">
                        <label for="addCarBrandInput"><sub>Car Brand</sub></label>
                        <input type="text" name="addCarBrandInput" id="addCarBrandInput" class="form-control mt-2" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addCarBrandButton">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal for add CAR TYPE -->

    <div class="modal fade" id="addCarTypeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a Car Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin-add-car-type.php" method="POST">
                    <div class="modal-body">
                        <label for="addCarTypeInput"><sub>Car Type</sub></label>
                        <input type="text" name="addCarTypeInput" id="addCarTypeInput" class="form-control mt-2">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addCarTypeButton">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal for add car -->

    <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Car</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin-add-car.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01" accept=".jpg, .jpeg, .png">Image</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="carPic">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <select class="form-select" name="brand">
                                    <option value="" disabled selected>Brand</option>

                                    <?php foreach ($result as $row): ?>

                                        <option value="<?php echo $row['brand_name'] ?>"><?php echo $row['brand_name'] ?></option>
                                    <?php endforeach; ?> 
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Model</span>
                                    <input type="text" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" name="model">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="input-group input-group-sm mb-2">

                                    <select class="form-select" name="type">
                                        <option value="" selected disabled>Type</option>
                                        <?php foreach ($result as $row): ?>
                                        <option value="<?php echo $row['type_name'] ?>"><?php echo $row['type_name'] ?></option>
                                        
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group input-group-sm mb-2">

                                    <select class="form-select" name="transmission">
                                        <option value="" selected disabled>Transmission</option>
                                        <option value="automatic">Automatic</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text" id="">Seats</span>
                                <input type="number" class="form-control" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-sm" name="seats">
                                    
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Price</span>
                                    <input type="number" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm" name="price">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addCarButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal for delete car -->

    <div class="modal fade" id="deleteCarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Are you sure you want to delete this Car?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for update car -->

    <div class="modal fade" id="editCarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Chevrolet Corvette Z06-2018</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Brand</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Chevrolet">
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Model</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="Corvette Z06-2018">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-select">
                                <option selected>Car Type</option>
                                <option value="minivan">Minivan</option>
                                <option value="van">Van</option>
                                <option value="suv">SUV</option>
                                <option value="luxury">Luxury</option>
                                <option value="wagon">Wagon</option>
                                <option value="pickup">Pickup</option>
                                <option value="sedan">Sedan</option>
                                <option value="compact">Compact</option>
                            </select>
                        </div>

                        <div class="col">
                            <select class="form-select">
                                <option selected>Transmission</option>
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <select class="form-select">
                                <option selected>Capacity</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                            </select>
                        </div>

                        <div class="col">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Price (₱)</span>
                                <input type="number" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm" placeholder="20,000">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Update</button>
                </div>
            </div>
        </div>
    </div>




    <script>

    </script>
</body>

</html>