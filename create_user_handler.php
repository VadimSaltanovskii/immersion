<?php
session_start();
require "./functions.php";

$new_mail = $_POST["new_mail"];
$new_pass = $_POST["new_pass"];
$new_name = $_POST["new_name"];
$new_job = $_POST["new_job"];
$new_tel = $_POST["new_tel"];
$new_address = $_POST["new_address"];

if (check_mail_in_base($new_mail)) {
    set_flash_message("danger", "Такой пользователь существует");
    redirect_to("create_user.php");
} else {
    save_user($new_mail, $new_pass);

    set_flash_message("success", "Пользователь добавлен");
    redirect_to("create_user.php");
}
