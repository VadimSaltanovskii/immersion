<?php 
function get_user_by_email(string $email)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "SELECT * FROM registration WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email]);
    $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $currentUser;
};

function add_user(string $email, string $pass)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "INSERT INTO registration (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email, "password" => password_hash($pass, PASSWORD_DEFAULT)]);
};

function set_flash_message(string $type, string $message) {
    $message = $message;
    $_SESSION["{$type}"] = $message;
}

function redirect_to (string $path) {
    header("Location: {$path}");
    exit;
}