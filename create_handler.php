<?php
session_start();
require "./functions.php";

if (check_email_in_base($_POST["new_email"])) {
    set_flash_message("danger", "Пользователь с таким email уже существует");
    redirect_to("create_user.php");
}