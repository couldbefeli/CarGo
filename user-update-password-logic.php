<?php
session_start();
require 'connection.php';

if (isset($_POST['userUpdatePasswordButton'])) {
    $userCurrentPasswordInput = $_POST['userCurrentPassword'];
    $userNewPassword = $_POST['userNewPassword'];
    $userConfirmPassword = $_POST['userConfirmPassword'];

    // Fetch the current password
    $sqlQuery = 'SELECT Password FROM accounts WHERE Account_ID = :id';
    $statement = $connection->prepare($sqlQuery);
    $statement->execute([':id' => $_SESSION['user_id']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verify current password
    if (!password_verify($userCurrentPasswordInput, $user['Password'])) {
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

    // Update password with new prepared statement
    $updateQuery = 'UPDATE accounts SET Password = :password WHERE Account_ID = :id';
    $updateStatement = $connection->prepare($updateQuery);
    $updateStatement->execute([
        ':password' => password_hash($userNewPassword, PASSWORD_DEFAULT),
        ':id' => $_SESSION['user_id']
    ]);

    if ($updateStatement->rowCount() > 0) {
        $_SESSION['user_success'] = "Password updated successfully. Please sign in with your new password.";
        header("Location: user-sign-in.php");
    } else {
        $_SESSION['user_error'] = "Failed to update password. Please try again.";
        header("Location: user-profile.php");
    }
    exit();
}
?>