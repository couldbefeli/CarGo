<?php
session_start();
require "connection.php";


if (isset($_POST["userSigninButton"])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $selectQuery = "SELECT * FROM `accounts` WHERE Email = :email";
    $statement = $connection->prepare($selectQuery);

    $statement->execute([
        ':email' => $email,
    ]);

    // Check if the user exists
    if ($statement->rowCount() > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        var_dump(password_verify($password, $user['Password']));
        // Verify the password
        if ($user['Verification'] === 0) {
            $_SESSION['error'] = "Your Profile is in verification process. You cannot sign in until we verify your account. This is to ensure that all users are credible. Thank you.";
            header("Location: user-sign-in.php");
        } else if ($user['Verification'] === 1) {
            if ($password === $user['Password']) {
                // Set the session variables
                $_SESSION['email'] = $user['Email'];
                $_SESSION['user_id'] = $user['Account_ID']; // Optionally, store user ID or other session data

                // Redirect to the homepage or dashboard
                header('Location: index.php');
                exit();
            }
        }
    } else {
        $_SESSION['error'] = "Invalid Credentials";
        header("Location: user-sign-in.php");
    }
}
