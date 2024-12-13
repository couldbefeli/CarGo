<?php

require 'connection.php';


session_start();

if (!isset($_SESSION['admin_email']) && !isset($_SESSION['admin_id'])) {
    header('Location: admin-sign-in.php');
    exit(); // Ensure the script stops execution after redirection
}


$sqlCarType = "SELECT type_name, brand_name FROM `car_type`, `car_brand` WHERE car_type.type_id = car_brand.brand_id";
$statement = $connection->prepare($sqlCarType);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

$sqlCars = "SELECT * FROM `cars`";
$statement = $connection->prepare($sqlCars);
$statement->execute();
$result2 = $statement->fetchAll(PDO::FETCH_ASSOC);

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
                <a href="admin-rental.php"><button class="btn text-success w-100 d-flex align-items-start"><i
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
                    <p class="text-dark m-0 fw-bold"><?php echo $_SESSION['admin_firstName'] ?></p>
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
            <?php foreach ($result2 as $row): ?>
                <div class="col">
                    <div class="card bg-transparent" style="width: 100%;">
                        <div class="bg-body-secondary p-5">
                            <img src="img/cars/<?php echo $row['Car_Image'] ?>" class="card-img-top" alt="..." width="100" height="100">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title"><?php echo $row['Model_Name'] ?></h6>
                            <div class="d-flex justify-content-between">
                                <!-- Delete Button -->
                                <button class="btn btn-sm btn-danger w-100 me-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteCarModal-<?php echo $row['Car_ID']; ?>">Delete</button>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteCarModal-<?php echo $row['Car_ID']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">This cannot be undone.</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <b><?php echo $row['Model_Name'] ?></b>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="admin-delete-car-logic.php" method="GET">
                                                    <input type="hidden" value="<?php echo $row['Car_ID'] ?>" name="id">
                                                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Update Button -->
                                <button class="btn btn-sm btn-warning w-100" data-bs-toggle="modal"
                                    data-bs-target="#editCarModal-<?php echo $row['Car_ID']; ?>">Update</button>

                                <!-- Update Modal -->
                                <div class="modal fade" id="editCarModal-<?php echo $row['Car_ID']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="admin-update-car-logic.php" method="POST">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?php echo $row['Model_Name'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <select class="form-select" name="brand">
                                                                    <option value="" disabled>Brand</option>
                                                                    <?php foreach ($result as $rows):
                                                                        $selected = ($rows['brand_name'] === $row['Brand']) ? 'selected' : '';
                                                                    ?>
                                                                        <option value="<?php echo $rows['brand_name'] ?>" <?php echo $selected; ?>>
                                                                            <?php echo htmlspecialchars($rows['brand_name']); ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <span class="input-group-text">Model</span>
                                                                <input type="text" class="form-control"
                                                                    placeholder="<?php echo $row['Model_Name'] ?>" name="model" required value="<?php echo $row['Model_Name'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-2">
                                                                <select class="form-select" name="type">
                                                                    <option disabled>Car Type</option>
                                                                    <?php foreach ($result as $rows):
                                                                        $selected = ($rows['type_name'] === $row['Car_Type']) ? 'selected' : '';
                                                                    ?>
                                                                        <option value="<?php echo $rows['type_name'] ?>" <?php echo $selected; ?>>
                                                                            <?php echo htmlspecialchars($rows['type_name']); ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-2">
                                                                <select class="form-select" name="transmission">
                                                                    <?php $isAutomatic = $row['Transmission'] === 'automatic'; ?>
                                                                    <option disabled>Transmission</option>
                                                                    <option value="automatic" <?php echo $isAutomatic ? 'selected' : '' ?>>
                                                                        Automatic
                                                                    </option>
                                                                    <option value="manual" <?php echo !$isAutomatic ? 'selected' : '' ?>>
                                                                        Manual
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <span class="input-group-text">Capacity</span>
                                                                <input type="number" class="form-control"
                                                                    placeholder="<?php echo $row['Capacity'] ?>" name="capacity" required value="<?php echo $row['Capacity'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <span class="input-group-text">Price (₱)</span>
                                                                <input type="number" class="form-control"
                                                                    placeholder="<?php echo $row['Price'] ?>" name="price" required value="<?php echo $row['Price'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <?php ?>
                                                    <input type="hidden" name="update_id" value="<?php echo $row['Car_ID'] ?>">
                                                    <button type="submit" class="btn btn-warning" name="carUpdateButton">Update</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

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








    <script>

    </script>
</body>

</html>