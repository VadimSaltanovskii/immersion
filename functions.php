<?php

// 1. Проверка email в базе:
function check_email_in_base(string $email): bool
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $target = $statement->fetch(PDO::FETCH_ASSOC);
    return !empty($target);
}
// 2. Созранить в базу:
function save_new_in_base(string $email, string $password)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
    ]);
}
// 3. Получить пользователя по email:
function get_user(string $email)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $target = $statement->fetch(PDO::FETCH_ASSOC);
    return $target;
}
// 4. Подготовить сообщение:
function set_flash_message(string $type, string $message)
{
    $_SESSION[$type] = $message;
}
// 5. Вывести сообщение:
function display_flash_message(string $type)
{
    echo $_SESSION[$type];
    unset($_SESSION[$type]);
}
// 6. Перевести на другую страницу:
function redirect_to(string $filename)
{
    header("Location: ./$filename");
    exit;
}
// 7. Проверка авторизации:
function user_authorization(string $email, string $password): bool
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    $target = $statement->fetch(PDO::FETCH_ASSOC);
    return $target && password_verify($password, $target["password"]);
}
// 8. Получить всех текущих пользователей:
function get_all_users(): array
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}
// 9. Редактировать общую информацию:
function update_general_info($id, $name, $job, $tel, $address)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET name =:name, job=:job, tel=:tel, address=:address WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "name" => $name,
        "job" => $job,
        "tel" => $tel,
        "address" => $address,
    ]);
}
// 10. Установить статус:
function set_status($id, $status)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET status =:status WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "status" => $status,
    ]);
}
// 11. Добавить ссылки на соц. сети:
function set_social_links($id, $vk, $telega, $inst)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET vk=:vk, telega=:telega, inst=:inst WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "vk" => $vk,
        "telega" => $telega,
        "inst" => $inst,
    ]);
}
