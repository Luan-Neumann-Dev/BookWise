<?php

$book = $database->query(
    query: "select * from books where id = :id",
    class: Book::class,
    params: ['id' => $_GET['id']]
)->fetch();

$evaluations = $database
    ->query(
        query: "select * from evaluations where book_id = :id",
        class: Evaluation::class,
        params: ['id' => $_GET['id']]
    )->fetchAll();

view('livro', compact('book', 'evaluations'));

