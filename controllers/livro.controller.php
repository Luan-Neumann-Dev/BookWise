<?php

$book = Book::get($_GET['id']);

$evaluations = $database
    ->query(
        query: "select * from evaluations where book_id = :id",
        class: Evaluation::class,
        params: ['id' => $_GET['id']]
    )->fetchAll();

view('livro', compact('book', 'evaluations'));

