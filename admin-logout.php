
<?php

session_start();
require 'connection.php';

unset($_SESSION['admin_email']);
unset($_SESSION['admin_id']);
unset($_SESSION['admin_firstName']);

header('Location: admin-sign-in.php');
