<?php
session_start();
require 'connection.php';

if (isset($_POST['userUpdatePasswordButton'])) {
    $userCurrentPasswordInput = $_POST['userCurrentPassword'];
    $userNewPassword = $_POST['userNewPassword'];
    $userConfirmPassword = $_POST['userConfirmPassword'];

    // Fetch the current password
    $sqlQuery = 'CALL sp_select_account_password (?)';
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $statement->execute();
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

    $statement->closeCursor();

    // Update password with new prepared statement
    $hashed_password = password_hash($userNewPassword, PASSWORD_DEFAULT);
    $sqlQuery = 'CALL sp_update_account_password(?, ?)';
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $statement->bindParam(2, $hashed_password, PDO::PARAM_STR);

    try {
        $result = $statement->execute();
        if ($result) {
            $_SESSION['user_success'] = "Password updated successfully. Please sign in with your new password.";
            header("Location: user-sign-in.php");
        } else {
            $_SESSION['user_error'] = "Failed to update password. Please try again.";
            header("Location: user-profile.php");
        }
    } catch (PDOException $e) {
        $_SESSION['user_error'] = "An error occurred while updating the password";
        header("Location: user-profile.php");
    }
    exit();
}
?>