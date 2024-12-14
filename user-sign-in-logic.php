<?php
session_start();
require "connection.php";

if (isset($_POST["userSigninButton"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $selectQuery = "CALL sp_account_sign_in(?)";
    $statement = $connection->prepare($selectQuery);
    $statement->bindParam(1, $email, PDO::PARAM_STR);

    $statement->execute();

    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Debug database values
        error_log("Found user - Stored hash: " . $user['Password']);
        error_log("Verification status: " . $user['Verification']);
        
        // Test password verification
        $isPasswordValid = password_verify($password, $user['Password']);
        error_log("Password verification result: " . ($isPasswordValid ? "true" : "false"));

        if ($user['role'] === "admin") {
            $_SESSION['error'] = "You are admin. Please log in in your respective sign in page. You are being redirected to admin sign in. Thank you.";
            header("Location: admin-sign-in.php");
            exit();
        } 

        else if ($user['Verification'] === 0) {
            $_SESSION['error'] = "Your Profile is in verification process.";
            header("Location: user-sign-in.php");
            exit();
        } 
        
        else if ($user['Verification'] === 1 && $isPasswordValid) {
            $_SESSION['email'] = $user['Email'];
            $_SESSION['user_id'] = $user['Account_ID'];
            $_SESSION['user_role'] = $user['role'];
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