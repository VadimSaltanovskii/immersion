<?php

function check_email_in_db(string $email)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $current_user = $statement->fetch(PDO::FETCH_ASSOC);
    return $current_user;
};

function save_user(string $email, string $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
    ]);
};

function authorization(string $email, string $password): bool
{
    $current_user = check_email_in_db($email);
    if ($current_user && password_verify($password, $current_user["password"])) {
        return true;
    } else {
        return false;
    }
}

function is_logged()
{
    return isset($_SESSION["logged_user"]);
}

function get_all_users()
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}














function set_flash_message(string $type, string $message)
{
    $_SESSION[$type] = $message;
};

function display_flash_message(string $type)
{
    echo $_SESSION[$type];
    unset($_SESSION[$type]);
}

function redirect_to(string $path)
{
    header("Location: ./$path");
    exit;
};
