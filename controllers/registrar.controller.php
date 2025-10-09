<?php

require 'Validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation = Validation::validate([
       'name' => ['required'],
       'email' => ['required', 'email', 'confirmed'],
//       'password' => ['required', 'min:8', 'max:30', 'strong'],
    ], $_POST);

    if ($validation->failed()) {

        $_SESSION['$validations'] = $validation->validations;

        header("Location: /login");

        exit();

    }

    $validations = [];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $confirmationEmail = $_POST['confirmation_email'];
    $password = $_POST['password'];

    if (strlen($name) == 0) {
        $validations[] = 'O nome é obrigatório';
    }
    if (strlen($email) == 0) {
        $validations[] = 'O email é obrigatório';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validations[] = 'O email é inválido!';
    }
    if ($email != $confirmationEmail) {
        $validations[] = 'O email de confirmação está diferente';
    }
    if (strlen($password) < 8 || strlen($password) > 30) {
        $validations[] = 'A senha precisa ter entre 8 a 30 caracteres';
    }
    if (sizeof($validations) > 0) {
        $_SESSION['validations'] = $validations;
        header('Location: /login');
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