<?php
session_start();
require "./functions.php";

$current_user = get_user_by_id($_SESSION["current_id"]);


if (check_email_in_base($_POST["upd_email"]) && $_POST["upd_email"] != $current_user["email"]) {
    set_flash_message("danger", "Такой email уже существует");
    redirect_to("security.php?id={$current_user['id']}");
} elseif ($_POST["upd_password"] === $_POST["confirm_password"]) {
    edit_credentials($current_user["id"], $_POST["upd_email"], $_POST["upd_password"]);
    set_flash_message("success", "Данные успешно обновлены");
    redirect_to("page_profile.php");
} else {
    set_flash_message("danger", "Пароли не совпадают");
    redirect_to("security.php?id={$current_user['id']}");
}
