<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: /');
    exit();
}

$user_id = auth()->id;
$book_id = $_POST['book_id'];
$evaluation = $_POST['evaluation'];
$note = $_POST['note'];
$validation = Validation::validate([
    'evaluation' => ['required'],
    'note' => ['required'],
], $_POST);

if($validation->failed()){
    header('Location: /livro?id='.$book_id);
    exit();
}

$database->query(
    query: "insert into evaluations (user_id, book_id, evaluation, note)
    values (:user_id, :book_id, :evaluation, :note);",
    params: compact('user_id', 'book_id', 'evaluation', 'note')
);

flash()->push('mensagem', 'Avaliação criada com sucesso.');
header('Location: /livro?id='.$book_id);
exit();