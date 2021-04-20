<?php
session_start();
require "./functions.php";

unset($_SESSION["isLogged"]);
redirect_to("page_login.php");
