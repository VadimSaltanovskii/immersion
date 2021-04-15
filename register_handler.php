<?php
session_start();
require "./functions.php";

$mail = $_POST["mail"];
$pass = $_POST["pass"];

if (check_mail_in_base($mail)) {
    set_flash_message("danger", "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
    redirect_to("page_register.php");
} else {
    save_user($mail, $pass);
    set_flash_message("success", "Регистрация успешна");
    redirect_to("page_login.php");
}
