<?php

if(!auth()) {
    header('Location: /');
    exit();
}

$books = Book::mine(auth()->id);
view('meus-livros', compact('books'));