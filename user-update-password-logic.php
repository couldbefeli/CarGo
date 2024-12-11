<?php
session_start();
require 'connection.php';

if (isset($_POST['userUpdatePasswordButton'])) {
    $userCurrentPasswordInput = $_POST['userCurrentPassword'];
    $userNewPassword = $_POST['userNewPassword'];
    $userConfirmPassword = $_POST['userConfirmPassword'];

    // Fetch the current password
    $sqlQuery = 'SELECT password FROM accounts WHERE Account_ID = :id';
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([':id' => $_SESSION['user_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);


    // Verify current password
    if (!$user || $user['password'] !== $userCurrentPasswordInput) {
        $_SESSION['user_error'] = "Current password is incorrect.";
        header("Location: user-profile.php");
        exit();
    }

    // Validate new password
    if ($userNewPassword !== $userConfirmPassword) {
        $_SESSION['user_error'] = "New passwords do not match.";
        header("Location: user-profile.php");
        exit();
    }

    // Update password
    $sqlQuery = 'UPDATE accounts SET password = :password WHERE Account_ID = :id';
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':password' => $userNewPassword,
        ':id' => $_SESSION['user_id']
    ]);

    $_SESSION['user_success'] = "Password updated successfully. Please sign in with your new password.";
    header("Location: user-sign-in.php");
    exit();
}