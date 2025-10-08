<?php

class DB {

    /**
     * Retorna todos os livros do banco de dados
     *
     * @return array[Livro]
     *
     */
    public function books(): array {
        $db = new PDO('sqlite:database.sqlite');
        $query = $db->query("select * from books");
        $items = $query->fetchAll();

        $results = [];

        foreach ($items as $item) {
           $book = new Book;
           $book->id = $item["id"];
           $book->title = $item["title"];
           $book->author = $item["author"];
           $book->description = $item["description"];
           $results[] = $book;
        }

        return $results;
    }
}
