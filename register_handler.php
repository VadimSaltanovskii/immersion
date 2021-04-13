<?php

session_start();

$email = $_POST['email'];
$pass = $_POST['pass'];

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
    $statement->execute(["email" => $email, "password" => $pass]);
}

if (get_user_by_email($email)) {
    $message = "<strong>Уведомление!</strong> Этот эл. адрес уже занят другим пользователем.";
    $_SESSION['danger'] = $message;
    header("Location: /page_register.php");
    exit;
} else {
    add_user($email, $pass);
    $message = "<strong>Отлично!</strong> Регистрация прошла успешно";
    $_SESSION['success'] = $message;
    header("Location: /page_register.php");
    exit;
}
