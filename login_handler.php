<?php
session_start();
require "./functions.php";

$email = $_POST["email"];
$password = $_POST["password"];


if (authorization($email, $password)) {
    set_flash_message("success", "Авторизация успешна");
    $_SESSION["logged_user"] = check_email_in_db($email);
    redirect_to("users.php");
} else {
    set_flash_message("danger", "Пользователь не найден либо неверно введены логин или пароль");
    redirect_to("page_login.php");
}
