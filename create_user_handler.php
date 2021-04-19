<?php
session_start();
require "./functions.php";

$new_name = $_POST["new_name"];
$new_job = $_POST["new_job"];
$new_tel = $_POST["new_tel"];
$new_address = $_POST["new_address"];
$new_email = $_POST["new_email"];
$new_password = $_POST["new_password"];
$new_status = $_POST["new_status"];
$new_vk = $_POST["new_vk"];
$new_telega = $_POST["new_telega"];
$new_inst = $_POST["new_inst"];
$new_photo = $_FILES["new_photo"];

if (check_email_in_db($new_email)) {
    set_flash_message("danger", "Пользователь с таким электронным адресом уже существует");
    redirect_to("create_user.php");
} else {
    save_user($new_email, $new_password);
    $new_user = check_email_in_db($new_email);
    update_general_user_info($new_user["id"], $new_name, $new_job, $new_tel, $new_address);
    set_status($new_user["id"], $new_status);
    set_social_links($new_user["id"], $new_vk, $new_telega, $new_inst);
    add_photo($new_user["id"], $new_photo);
    set_flash_message("success", "Новый пользователь успешно добавлен");
    redirect_to("users.php");
}
