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
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $SQL_ADD_USER_QUERY = "INSERT INTO accounts 
                (First_Name, Last_Name, Address, Contact_Number, Email, Password, Verification, role) 
                VALUES 
                (:firstname, :lastname, :address, :contact_number, :email, :password, :verification, :role)";
        $sql_add = $connection->prepare($SQL_ADD_USER_QUERY);

        try {
            $sql_add->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':address' => $address,
                ':contact_number' => $contact,
                ':email' => $email,
                ':password' => $password,
                ':verification' => 1,
                ':role' => 'admin',
            ]);

            // Redirect to sign-in page
            header('Location: admin-sign-in.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header('location: admin-sign-up.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Passwords do not match.";
        header('location: admin-sign-up.php');
        exit();
    }
}
