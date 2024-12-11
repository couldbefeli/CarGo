<?php
session_start();
include 'connection.php';

if (isset($_POST['user-signup-button'])) {
    $file_name = $_FILES['id']['name'];
    $temp_name = $_FILES['id']['tmp_name'];
    $folder = 'img/valid-ids/' . $file_name;

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contactNumber = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === $confirmPassword) {
        try {
            // First handle file upload
            if (!move_uploaded_file($temp_name, $folder)) {
                $_SESSION['error'] = "Failed to upload file.";
                header('location: user-sign-up.php');
                exit();
            }

            // If file upload successful, proceed with database operation
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $SQL_ADD_USER_QUERY = "CALL sp_add_account(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);
            $sql_add->bindValue(1, $firstname, PDO::PARAM_STR);
            $sql_add->bindValue(2, $lastname, PDO::PARAM_STR);
            $sql_add->bindValue(3, $address, PDO::PARAM_STR);
            $sql_add->bindValue(4, $contactNumber, PDO::PARAM_STR);
            $sql_add->bindValue(5, $email, PDO::PARAM_STR);
            $sql_add->bindValue(6, $hashed_password, PDO::PARAM_STR);
            $sql_add->bindValue(7, $file_name, PDO::PARAM_STR);
            $sql_add->bindValue(8, $address, PDO::PARAM_STR);
            $sql_add->bindValue(9, 0, PDO::PARAM_INT);
            $sql_add->bindValue(10, "user", PDO::PARAM_STR);

            if ($sql_add->execute()) {
                $_SESSION['success'] = "Registration successful! Please wait for account verification.";
                header('Location: user-sign-in.php');
                exit();
            } else {
                $_SESSION['error'] = "Failed to register user.";
                header('location: user-sign-up.php');
                exit();
            }

        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header('location: user-sign-up.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Passwords do not match.";
        header('location: user-sign-up.php');
        exit();
    }
}
