<?php

require 'dados.php';

$id = $_REQUEST['id'];

$filtrado = array_filter($books, fn($book) => $book['id'] == $id);

$book = array_pop($filtrado);

view('livro', compact('book'));
?>

