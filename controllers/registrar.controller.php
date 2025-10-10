<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation = Validation::validate([
       'name' => ['required'],
       'email' => ['required', 'email', 'confirmed'],
       'password' => ['required', 'min:8', 'max:30', 'strong'],
    ], $_POST);

    if ($validation->failed()) {
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

    header('location: /login?mensagem=Registrado com sucesso!');

    exit();
}