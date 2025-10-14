<?php

if($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /meus-livros");
    exit();
}

if(!auth()) {
    abort(403);
}

$user_id = auth()->id;
$title = $_POST["title"];
$author = $_POST["author"];
$description = $_POST["description"];
$release_year = $_POST["release_year"];

$validation = Validation::validate([
    'title' => ['required', 'min:3'],
    'author' => ['required'],
    'description' => ['required'],
    'release_year' => ['required'],
], $_POST);

if ($validation->failed()) {
    header("Location: /meus-livros");
    exit();
}

$database->query(
    query: "insert into books (title, author, description, release_year, user_id)
values (':title', ':author', ':description', ':release_year', ':user_id');",
    params: compact('title', 'author', 'description', 'release_year', 'user_id')
);

flash()->push('mensagem', 'Livro cadastrado com sucesso!');
header("Location: /meus-livros");
exit();