<?php
// Example hash and input
$hashedPassword = '$2y$10$V.3pK9ycv';
$inputPassword = '1234';

// Use password_verify to check if the input matches the hashed password
if (password_verify($inputPassword, $hashedPassword)) {
    echo "Password is correct!";
} else {
    echo "Password is incorrect!";
}
?>