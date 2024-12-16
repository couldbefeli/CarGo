<?php

session_start();
require 'connection.php';

if (!isset($_SESSION['admin_email']) && !isset($_SESSION['admin_id'])) {
    header('Location: admin-sign-in.php');
    exit(); // Ensure the script stops execution after redirection
}


$sqlQuery = "SELECT * FROM `v_all_users`";
$statement = $connection->prepare($sqlQuery);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Users</title>
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
                <a href="admin-car.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-car-front-fill me-2"></i>Cars</button></a>
                <a href="admin-user.php"><button class="btn  btn-success  w-100 d-flex align-items-start"><i
                            class="bi bi-people-fill me-2"></i>Users</button></a>
                <a href="admin-rental.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-clock-fill me-2"></i>Rental History</button></a>
                <a href="admin-pending-booking.php"><button class="btn text-success w-100 d-flex align-items-start"><i
                            class="bi bi-hourglass me-2"></i>Pending Booking</button></a>

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
        <h2>Users</h2>

        <table class="table mt-3  w-100">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row):
                    $verified = ($row["Verification"]) === 1 ? "Verified" 
                    : ($row["Verification"] === 2 ? "Blocked" 
                    : "Pending");
                ?>
                    <tr>
                        <th scope="row"><?php echo $row['Account_ID'] ?></th>
                        <td><?php echo $row['First_Name'] ?></td>
                        <td><?php echo $row['Last_Name'] ?></td>
                        <td><?php echo $verified ?></td>
                        <td>
                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewDetailsModal-<?php echo $row['Account_ID'] ?>">Details</button>

                            <!-- modal for viewing details -->
                            <div class="modal fade" id="viewDetailsModal-<?php echo $row['Account_ID'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body m-0 p-0">
                                            <img src="img/valid-ids/<?php echo $row['Valid_ID'] ?>" alt="" class="w-100">
                                            <div class="container mb-2">
                                                <div class="d-flex container" style="gap:.25rem">
                                                    <div class="col">
                                                        <label for="user_name" class="form-label text-body-tertiary"><sub>First
                                                                Name</sub></label>
                                                        <input type="text" class="form-control border-0 border-bottom rounded-0" id="user_firstname" placeholder="<?php echo $row['First_Name'] ?>"
                                                            readonly=true>
                                                    </div>

                                                    <div class="col">
                                                        <label for="user_lastname" class="form-label text-body-tertiary"><sub>Last
                                                                Name</sub></label>
                                                        <input type="email" class="form-control border-0 border-bottom rounded-0" id="user_lastname" placeholder="<?php echo $row['Last_Name'] ?>"
                                                            readonly=true>
                                                    </div>

                                                    <div class="col">
                                                        <label for="user_contact" class="form-label text-body-tertiary"><sub>Contact
                                                                #</sub></label>
                                                        <input type="text" class="form-control border-0 border-bottom rounded-0" id="user_contact" placeholder="<?php echo $row['Contact_Number'] ?>"
                                                            readonly=true>
                                                    </div>


                                                </div>

                                                <div class="container">
                                                    <label for="user_lastname" class="form-label text-body-tertiary"><sub>Address</sub></label>
                                                    <input type="email" class="form-control border-0 border-bottom rounded-0" id="user_lastname"
                                                        placeholder="<?php echo $row['Address'] ?>" readonly=true>

                                                    <div class="d-flex" style="gap: .25rem">
                                                        <div>
                                                            <label for="user_created"
                                                                class="form-label text-body-tertiary"><sub>Account Created</sub></label>
                                                            <input type="text" class="form-control border-0 border-bottom rounded-0" id="user_created" placeholder="<?php echo  date("F d, Y", strtotime($row['Account_Created']))  ?>"
                                                                readonly=true>
                                                        </div>

                                                        <div>
                                                            <label for="user_email"
                                                                class="form-label text-body-tertiary"><sub>Email</sub></label>
                                                            <input type="email" class="form-control border-0 border-bottom rounded-0" id="user_username" placeholder="<?php echo $row['Email'] ?>"
                                                                readonly=true>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="admin-user-action.php" class="d-inline" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['Account_ID'] ?>">
                                <button name='verifyButton' class="btn btn-success btn-sm" <?php echo $row['Verification'] === 1 ? "disabled" : "" ?> type="submit">Verify</button>
                                <button name='<?php echo $row['Verification'] === 2 ? "unblockButton" : "blockButton" ?>' class="btn btn-danger btn-sm" type="submit"><?php echo $row['Verification'] === 2 ? "Unblock" : "Block" ?></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</body>

</html>