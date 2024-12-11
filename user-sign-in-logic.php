<?php
session_start();
require "connection.php";

if (isset($_POST["userSigninButton"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $selectQuery = "SELECT * FROM `accounts` WHERE Email = :email";
    $statement = $connection->prepare($selectQuery);

    $statement->execute([
        ':email' => $email,
    ]);

    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Debug database values
        error_log("Found user - Stored hash: " . $user['Password']);
        error_log("Verification status: " . $user['Verification']);
        
        // Test password verification
        $isPasswordValid = password_verify($password, $user['Password']);
        error_log("Password verification result: " . ($isPasswordValid ? "true" : "false"));

        if ($user['Verification'] === 0) {
            $_SESSION['error'] = "Your Profile is in verification process.";
            header("Location: user-sign-in.php");
            exit();
        } 
        
        if ($user['Verification'] === 1 && $isPasswordValid) {
            $_SESSION['email'] = $user['Email'];
            $_SESSION['user_id'] = $user['Account_ID'];
            header('Location: index.php');
            exit();
        } else {
            // More specific error message for debugging
            if (!$isPasswordValid) {
                $_SESSION['error'] = "Password verification failed";
            } else {
                $_SESSION['error'] = "Verification status check failed";
            }
            header("Location: user-sign-in.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "No user found with this email";
        header("Location: user-sign-in.php");
        exit();
    }
}