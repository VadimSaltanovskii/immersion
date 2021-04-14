<?php

session_start();
require "functions.php";


$email = $_POST['login_email'];
$password = $_POST['login_password'];

check_user($email, $password);


