<?php
session_start();
require "./functions.php";

$upd_name = $_POST["upd_name"];
$upd_job = $_POST["upd_job"];
$upd_tel = $_POST["upd_tel"];
$upd_address = $_POST["upd_address"];

update_general_user_info($_SESSION["logged_user"]["id"], $upd_name, $upd_job, $upd_tel, $upd_address);
set_flash_message("success", "Данные успешно изменены");
redirect_to("users.php");
