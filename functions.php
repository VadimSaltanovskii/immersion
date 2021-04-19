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
        set_flash_message("success", "Авторизация успешна");
        return true;
    } else {
        set_flash_message("danger", "Пользователь не найден либо неверно введены логин или пароль");
        return false;
    }
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
