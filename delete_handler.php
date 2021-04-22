<?php
session_start();
require "./functions.php";

$current_user = get_user_by_id($_GET["id"]);

delete_user($_GET["id"]);
set_flash_message("success", "Пользователь удален");
if ($_SESSION["isLogged"]["id"] === $_GET["id"]) {
    unset($_SESSION["isLogged"]);
    redirect_to("page_register.php");
} else {
    redirect_to("users.php");
}
