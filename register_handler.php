<?php
session_start();
require "./functions.php";

$email = $_POST["email"];
$password = $_POST["password"];

if (check_email_in_base($email)) {
    set_flash_message("danger", "Данный email уже существует");
    redirect_to("page_register.php");
} else {
    save_new_in_base($email, $password);
    set_flash_message("success", "Успешно! Воспользуйтесь данными для входа");
    redirect_to("page_login.php");
}
