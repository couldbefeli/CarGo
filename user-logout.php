<?php

session_start();
require 'connection.php';

unset($_SESSION['email']);
unset($_SESSION['user_id']);

header('Location: index.php');
