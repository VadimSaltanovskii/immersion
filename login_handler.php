<?php
session_start();
require "./functions.php";

$email = $_POST["email"];
$password = $_POST["password"];

if (authorization($email, $password)) {
    redirect_to("users.php");
} else {
    redirect_to("page_login.php");
}
