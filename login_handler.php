<?php

session_start();
require "functions.php";


$email = $_POST['login_email'];
$password = $_POST['login_password'];

check_user($email, $password);

// var_dump($_POST['login_email']);
// var_dump($_POST['login_password']);

