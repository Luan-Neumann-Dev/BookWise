<?php

$mensagem = $_REQUEST["mensagem"] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $user = $database->query(
        query: 'select * from users where email = :email and password = :password',
        params: compact("email", "password")
    )->fetch();

    if ($user) {
        $_SESSION['auth'] = $user;
        $_SESSION['mensagem'] = "Seja bem-vindo {$user['name']}!";
        header("Location: /");
        exit();
    }
}

view('login', compact('mensagem'));