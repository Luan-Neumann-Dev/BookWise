<?php

if(!auth()) {
    header('Location: /');
    exit();
}

$books = $database->query("select * from books where user_id = :id", Book::class, ['id' => auth()->id]);
view('meus-livros', compact('books'));