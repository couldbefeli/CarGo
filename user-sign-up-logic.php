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
        // hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $SQL_ADD_USER_QUERY = "INSERT INTO accounts 
                (First_Name, Last_Name, Address, Contact_Number, Email, Password, Valid_ID, Verification, role) 
                VALUES 
                (:firstname, :lastname, :address, :contact_number, :email, :password, :valid_id, :verification, :role)";
        $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);

        try {
            $sql_add->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':address' => $address,
                ':contact_number' => $contactNumber,
                ':email' => $email,
                ':password' => $password,
                ':valid_id' => $file_name,
                ':verification' => 0,
                ':role' => 'user',
            ]);
            // File upload
            if (move_uploaded_file($temp_name, $folder)) {
                header('Location: user-sign-in.php');
                exit();
            } else {
                $_SESSION['error'] = "Failed to upload file.";
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
