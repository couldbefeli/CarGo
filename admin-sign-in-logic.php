<?php 

session_start();
require 'connection.php';

if (isset($_POST['adminSignInButton'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $selectQuery = "SELECT * FROM `accounts` WHERE Email = :email";
    $statement = $connection->prepare($selectQuery);

    $statement->execute([
        ':email' => $email,
    ]);

    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        // First, check verification status
        if ($user['Verification'] === 0) {
            $_SESSION['error'] = "Your Profile is in verification process. You cannot sign in until we verify your account. This is to ensure that all users are credible. Thank you.";
            header("Location: admin-sign-in.php");
            exit();
        }
        
        // Check role
        if ($user['role'] === "user") {
            $_SESSION['error'] = "You are a user. Please sign in in the user sign in page. You are being redirected to user sign in after confirming";
            header("Location: user-sign-in.php");
            exit();
        }
        
        // Check verification and password
        if ($user['Verification'] === 1) {
            if (password_verify($password, $user['Password'])) {
                // Set the session variables
                $_SESSION['admin_email'] = $user['Email'];
                $_SESSION['admin_id'] = $user['Account_ID'];
                $_SESSION['admin_firstName'] = $user['First_Name'];
                $_SESSION['admin_role'] = $user['role'];

                // Redirect to the homepage or dashboard
                header('Location: admin-analytics.php');
                exit();
            } else {
                // Incorrect password
                $_SESSION['error'] = "Invalid Credentials";
                header("Location: admin-sign-in.php");
                exit();
            }
        }
    } else {
        // No user found with this email
        $_SESSION['error'] = "Invalid Credentials";
        header("Location: admin-sign-in.php");
        exit();
    }
}