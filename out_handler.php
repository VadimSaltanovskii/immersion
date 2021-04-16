<?php
session_start();
require "./functions.php";

session_unset();
redirect_to("page_login.php")
?>