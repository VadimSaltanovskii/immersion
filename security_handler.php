<?php
session_start();
require "./functions.php";

$current_user = get_user_by_id($_SESSION["current_id"]);


if (check_email_in_base($_POST["upd_email"]) && $_POST["upd_email"] != $current_user["email"]) {
    set_flash_message("danger", "Такой email уже существует");
    redirect_to("security.php?id={$current_user['id']}");
} else {
    set_flash_message("success", "Данные успешно обновлены");
    redirect_to("page_profile.php");
}
