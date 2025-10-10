<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation = Validation::validate([
       'name' => ['required'],
       'email' => ['required', 'email', 'confirmed'],
       'password' => ['required', 'min:8', 'max:30', 'strong'],
    ], $_POST);

    if ($validation->failed('register')) {
        header("Location: /login");
        exit();
    }

    $database->query(
        query: "insert into users (name, email, password) values (:name, :email, :password)",
        params: [
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']
        ]
    );

    flash()->push('mensagem', 'Registrado com sucesso!');

    header('location: /login');

    exit();
}