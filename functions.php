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

function get_all_users()
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function update_general_user_info(int $id, string $name, string $job, string $tel, string $address)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET name=:name, job=:job, tel=:tel, address=:address WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "name" => $name,
        "job" => $job,
        "tel" => $tel,
        "address" => $address,
    ]);
}

function set_status(int $id, string $status)
{
    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET status = :status WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "status" => $status,
    ]);
}

function set_social_links(int $id, string $vk, string $telega, string $inst)
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

function add_photo(int $id, array $file)
{
    $tmp_name = $file["tmp_name"];
    $name = md5_file($tmp_name);
    $image = getimagesize($tmp_name);
    $extension = image_type_to_extension($image[2]);
    move_uploaded_file($tmp_name, "./img/demo/avatars/" . $name . $extension);

    $pdo = new PDO("mysql:host=localhost;dbname=immersion", "root", "root");
    $sql = "UPDATE users SET photo = :photo WHERE id=:id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "id" => $id,
        "photo" => $name . $extension,
    ]);
}

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

function logout()
{
    unset($_SESSION["logged_user"]);
    redirect_to("page_login.php");
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
