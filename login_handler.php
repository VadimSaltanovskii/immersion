<?php
session_start();
require "./functions.php";

$mail = $_POST["mail"];
$pass = $_POST["pass"];

if (check_user_data($mail, $pass)) {
    set_flash_message("success", "Успешно");
    $_SESSION["currentUser"] = get_user($mail);
    $_SESSION["logged"] = $mail;
    redirect_to("users.php");
} else {
    set_flash_message("danger", "Неверный логин или пароль");
    redirect_to("page_login.php");
}
