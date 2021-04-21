<?php
session_start();
require "./functions.php";


update_general_info($_SESSION["current_id"], $_POST["upd_name"], $_POST["upd_job"], $_POST["upd_tel"], $_POST["upd_address"]);
set_flash_message("success", "Данные успешно обновлены");
redirect_to("page_profile.php");
