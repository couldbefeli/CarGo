<?php
session_start();
require 'connection.php';

if (isset($_POST['adminUpdatePasswordButton'])) {
    $currentPasswordInput = $_POST['adminCurrentPassword'];
    $newPassword = $_POST['adminNewPassword'];
    $confirmPassword = $_POST['adminConfirmPassword'];
    
    // Make sure admin is logged in
    if (!isset($_SESSION['admin_id'])) {
        $_SESSION['admin_error'] = "Please log in first";
        header("Location: admin-sign-in.php");
        exit();
    }

    // Fetch the current password
    $sqlQuery = 'CALL sp_select_account_password(?)';
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $_SESSION['admin_id'], PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if we got a valid result
    if (!$user || !isset($user['Password'])) {
        $_SESSION['admin_error'] = "Unable to verify current password";
        header("Location: admin-profile.php");
        exit();
    }
    
    // Verify the current password matches
    if (!password_verify($currentPasswordInput, $user['Password'])) {
        $_SESSION['admin_error'] = "Current password is incorrect";
        header("Location: admin-profile.php");
        exit();
    }

    // Validate new password
    if ($newPassword !== $confirmPassword) {
        $_SESSION['admin_error'] = "New passwords do not match";
        header("Location: admin-profile.php");
        exit();
    }

    // Close the cursor before next procedure
    $statement->closeCursor();

    // Hash and update the new password
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
    $sqlQuery = 'CALL sp_update_account_password(?, ?)';
    $statement = $connection->prepare($sqlQuery);
    $statement->bindParam(1, $_SESSION['admin_id'], PDO::PARAM_INT);
    $statement->bindParam(2, $hashed_password, PDO::PARAM_STR);
    
    try {
        $result = $statement->execute();
        if ($result) {
            $_SESSION['admin_success'] = "Password updated successfully. Please sign in with your new password.";
            header("Location: admin-sign-in.php");
        } else {
            $_SESSION['admin_error'] = "Failed to update password";
            header("Location: admin-profile.php");
        }
    } catch (PDOException $e) {
        $_SESSION['admin_error'] = "An error occurred while updating the password";
        header("Location: admin-profile.php");
    }
    exit();
}
?>