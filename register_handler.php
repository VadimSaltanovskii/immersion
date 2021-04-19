<?php
session_start();

require "./functions.php";

$email = $_POST["email"];
$password = $_POST["password"];

if (check_email_in_db($email)) {
    set_flash_message("danger", "Такой пользователь уже существует");
    redirect_to("page_register.php");
} else {
    save_user($email, $password);
    set_flash_message("success", "Пользователь успешно зарегистрирован");
    redirect_to("page_login.php");
}
