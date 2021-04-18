<?php
session_start();
require "./functions.php";

$new_mail = $_POST["new_mail"];
$new_pass = $_POST["new_pass"];
$new_name = $_POST["new_name"];
$new_job = $_POST["new_job"];
$new_tel = $_POST["new_tel"];
$new_address = $_POST["new_address"];
$new_status = $_POST["new_status"];
$new_photo = $_POST["new_photo"];
$new_vk = $_POST["new_vk"];
$new_telega = $_POST["new_telega"];
$new_inst = $_POST["new_inst"];

if (!empty($new_mail)) {
    if (check_mail_in_base($new_mail)) {
        set_flash_message("danger", "Такой пользователь существует");
        redirect_to("create_user.php");
    } else {
        if (!empty($new_pass)) {
            save_user($new_mail, $new_pass);
            update_user_info(get_user($new_mail)["id"], $new_name, $new_job, $new_tel, $new_address);
            add_status(get_user($new_mail)["id"], $new_status);
            // // add_photo(get_user($new_mail)["id"], $new_photo);
            add_social_net_links(get_user($new_mail)["id"], $new_vk, $new_telega, $new_inst);
            set_flash_message("success", "Пользователь успешно добавлен");
            redirect_to("users.php");
        } else {
            set_flash_message("danger", "Введите пароль");
            redirect_to("create_user.php");
        }
    }
} else {
    set_flash_message("danger", "Email обязателен для заполнения");
    redirect_to("create_user.php");
}
