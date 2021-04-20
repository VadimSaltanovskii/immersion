<?php
session_start();
require "./functions.php";

$email = $_POST["email"];
$password = $_POST["password"];

if (!user_authorization($email, $password)) {
    set_flash_message("danger", "Пользователь не найден, либо неверно введен логин или пароль");
    redirect_to("page_login.php");
} else {
    $_SESSION["isLogged"] = get_user($email);
    set_flash_message("success", "Добро пожаловать");
    redirect_to("users.php");
}
