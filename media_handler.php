<?php
session_start();
require "./functions.php";

$current_user = get_user_by_id($_SESSION["current_id"]);

add_avatar($current_user["id"], $_FILES["upd_avatar"]);
set_flash_message("success", "Данные успешно обновлены");
redirect_to("page_profile.php");
