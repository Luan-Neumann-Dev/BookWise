<?php

$book = $database->query(
    query: "
        select
            b.id, 
            b.title,
            b.author,
            b.description,
            b.release_year,
            round(sum(e.note) / 5.0) as evaluation_note,
            count(e.id) as evaluation_count
        from books b
        left join evaluations e on e.book_id = b.id
        where b.id = :id
        group by
            b.id, b.title, b.author, b.description, b.release_year
    ",
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

