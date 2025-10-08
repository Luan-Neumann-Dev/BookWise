<?php

/**
 * Representação de 1 registro da Tabela Books
 */
class Book {
    public $id;
    public $title;
    public $author;
    public $description;
    public $user_id;

    public static function make($item): Book
    {
        $book = new self();
        $book->id = $item["id"];
        $book->title = $item["title"];
        $book->author = $item["author"];
        $book->description = $item["description"];
        $book->user_id = $item["user_id"];
        return $book;
    }
}
