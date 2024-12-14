<?php

session_start();
require 'connection.php';

unset($_SESSION['email']);
unset($_SESSION['user_id']);
unset($_SESSION['user_role']);

header('Location: index.php');
