<?php

function check_mail_in_base(string $mail): bool
{
    $pdo = new PDO("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "SELECT * FROM registration WHERE mail=:mail";
    $statement = $pdo->prepare($sql);
    $statement->execute(["mail" => $mail]);
    $currentMail = $statement->fetch(PDO::FETCH_ASSOC);
    return !empty($currentMail);
}

function save_user(string $mail, string $pass)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "INSERT INTO registration (mail, pass) VALUES (:mail, :pass)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "mail" => $mail,
        "pass" => password_hash($pass, PASSWORD_DEFAULT),
    ]);
}

function update_user_info (int $id, string $name, string $job, string $tel, string $address) {
    $pdo = new PDO ("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "SELECT * FROM registration WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute(["id" => $id]);
    $sql2 = "UPDATE registration SET name = $name, job = $job, tel = $tel, address = $address";
    $statement = $pdo->prepare($sql2);
    $statement->execute();
}

function check_user_data(string $mail, string $pass): bool
{
    $pdo = new PDO("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "SELECT * FROM registration WHERE mail=:mail";
    $statement = $pdo->prepare($sql);
    $statement->execute(["mail" => $mail]);
    $currentUser = $statement->fetch(PDO::FETCH_ASSOC);

    return !empty($currentUser) && password_verify($pass, $currentUser["pass"]);
}

function get_user(string $mail)
{
    $pdo = new PDO("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "SELECT * FROM registration WHERE mail=:mail";
    $statement = $pdo->prepare($sql);
    $statement->execute(["mail" => $mail]);
    $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $currentUser;
}

function get_all_users()
{
    $pdo = new PDO("mysql:host=localhost;dbname=study", "root", "root");
    $sql = "SELECT * FROM registration";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function is_not_logged()
{
    return !isset($_SESSION["logged"]);
}

function set_flash_message(string $type, string $message)
{
    $_SESSION[$type] = $message;
}

function redirect_to(string $path)
{
    header("Location: /$path");
    exit;
}
