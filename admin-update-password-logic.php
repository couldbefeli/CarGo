<?php
session_start();
require 'connection.php';

if (isset($_POST['adminUpdatePasswordButton'])) {
    $currentPasswordInput = $_POST['adminCurrentPassword'];
    $newPassword = $_POST['adminNewPassword'];
    $confirmPassword = $_POST['adminConfirmPassword'];

    // Fetch the current password
    $sqlQuery = 'SELECT password FROM accounts WHERE Account_ID = :id';
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([':id' => $_SESSION['admin_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verify current password
    if (!$user || $user['password'] !== $currentPasswordInput) {
        $_SESSION['admin_error'] = "Current password is incorrect.";
        header("Location: admin-profile.php");
        exit();
    }

    // Validate new password
    if ($newPassword !== $confirmPassword) {
        $_SESSION['admin_error'] = "New passwords do not match.";
        header("Location: admin-profile.php");
        exit();
    }

    // Update password
    $sqlQuery = 'UPDATE accounts SET password = :password WHERE Account_ID = :id';
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([
        ':password' => $newPassword,
        ':id' => $_SESSION['admin_id']
    ]);

    $_SESSION['admin_success'] = "Password updated successfully. Please sign in with your new password.";
    header("Location: admin-sign-in.php");
    exit();
}