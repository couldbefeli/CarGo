<?php
session_start();
include 'connection.php';

if (isset($_POST['adminSignUpButton'])) {
    $firstname = $_POST['admin_firstname'];
    $lastname = $_POST['admin_lastname'];
    $address = $_POST['admin_address'];
    $contact = $_POST['admin_contact'];
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $confirm_password = $_POST['admin_confirmpassword'];

    // Check if all fields are filled
    if (empty($firstname) || empty($lastname) || empty($address) || empty($contact) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header('location: admin-sign-up.php');
        exit();
    }

    // Match passwords
    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $SQL_ADD_USER_QUERY = "CALL sp_add_account(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);
        $sql_add->bindValue(1, $firstname, PDO::PARAM_STR);
        $sql_add->bindValue(2, $lastname, PDO::PARAM_STR);
        $sql_add->bindValue(3, $address, PDO::PARAM_STR);
        $sql_add->bindValue(4, $contact, PDO::PARAM_STR);
        $sql_add->bindValue(5, $email, PDO::PARAM_STR);
        $sql_add->bindValue(6, $hashed_password, PDO::PARAM_STR);
        $sql_add->bindValue(7, "n/a", PDO::PARAM_STR);
        $sql_add->bindValue(8, $address, PDO::PARAM_STR);
        $sql_add->bindValue(9, 1, PDO::PARAM_INT);
        $sql_add->bindValue(10, "admin", PDO::PARAM_STR);
        if ($sql_add->execute()) {
            $_SESSION['success'] = "Registration successful! Please wait for account verification.";
            header('Location: admin-sign-in.php');
            exit();
        } else {
            $_SESSION['error'] = "Failed to register user.";
            header('location: admin-sign-up.php');
            exit();
        }
        
        }
    } else {
        $_SESSION['error'] = "Passwords do not match.";
        header('location: admin-sign-up.php');
        exit();
    }

