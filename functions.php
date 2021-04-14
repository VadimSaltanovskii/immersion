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

function add_user(string $email, string $pass, string $role = "user")
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "INSERT INTO registration (email, password, role) VALUES (:email, :password, :role)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => password_hash($pass, PASSWORD_DEFAULT),
        "role" => $role,
    ]);
};

function set_flash_message(string $type, string $message)
{
    $message = $message;
    $_SESSION["{$type}"] = $message;
}

function redirect_to(string $path)
{
    header("Location: {$path}");
    exit;
}

function check_user(string $email, string $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "SELECT * FROM registration WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
    ]);
    $target = $statement->fetch(PDO::FETCH_ASSOC);

    if ($target && (password_verify($password, $target['password']) || $password === $target["password"])) {
        $_SESSION['email'] = $target['email'];
        $_SESSION['password'] = $target['password'];
        $_SESSION['logged'] = $target['email'];
        redirect_to("/users.php");
    } else {
        set_flash_message("danger", "Пользователь не найден");
        redirect_to("/page_login.php");
    }
};

function is_not_logged(): bool
{
    return !isset($_SESSION['logged']);
}

function check_admin(string $email, string $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "SELECT * FROM registration WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
    ]);
    $target = $statement->fetch(PDO::FETCH_ASSOC);

    if ($target && (password_verify($password, $target['password']) || $password === $target["password"]) && $target['role'] === 'admin') {
        return true;
    } else {
        return false;
    }
}

function get_all_users()
{
    $pdo = new PDO("mysql:host=localhost;dbname=study;", "root", "root");
    $sql = "SELECT * FROM registration";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
