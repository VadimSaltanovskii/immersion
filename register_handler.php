<?php

session_start();

require "functions.php";

$email = $_POST['email'];
$pass = $_POST['pass'];

if (get_user_by_email($email)) {
    set_flash_message("danger", "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.");
    redirect_to("/page_register.php");
} else {
    add_user($email, $pass);
    set_flash_message("success", "<strong>Отлично!</strong> Регистрация прошла успешно");
    redirect_to("/page_login.php");
}
