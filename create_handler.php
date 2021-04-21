<?php
session_start();
require "./functions.php";

if (check_email_in_base($_POST["new_email"])) {
    set_flash_message("danger", "Пользователь с таким email уже существует");
    redirect_to("create_user.php");
} else {
    save_new_in_base($_POST["new_email"], $_POST["new_password"]);
    $user = get_user($_POST["new_email"]);
    update_general_info($user["id"], $_POST["new_name"], $_POST["new_job"], $_POST["new_tel"], $_POST["new_address"]);
    set_status($user["id"], $_POST["new_status"]);
    set_social_links($user["id"], $_POST["new_vk"], $_POST["new_telega"], $_POST["new_inst"]);
    add_avatar($user["id"], $_FILES["new_avatar"]);
    set_flash_message("success", "Пользователь успешно добавлен");
    redirect_to("users.php");
}
