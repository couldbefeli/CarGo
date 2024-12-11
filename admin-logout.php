
<?php

session_start();
require 'connection.php';

unset($_SESSION['admin_email']);
unset($_SESSION['admin_id']);

header('Location: admin-sign-in.php');
