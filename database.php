<?php

class DB {

    private $db;

    public function __construct() {

        $this->db = new PDO('sqlite:database.sqlite');

    }

    public function query($query, $class = null, $params = [])
    {
        $prepare = $this->db->prepare($query);

        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $prepare->execute($params);

        return $prepare;
    }

    public function books($search = null) {
        $prepare = $this->db->prepare("select * from books where user_id = 1 and title like :search");

        $prepare->bindValue('search', "%$search%");

        $prepare->setFetchMode(PDO::FETCH_CLASS, Book::class);

        $prepare->execute();

        return $prepare->fetchAll();
    }

    public function book($id) {

        $prepare = $this->db->prepare("select * from books where id = :id");

        $prepare->bindParam('id', $id);

        $prepare->setFetchMode(PDO::FETCH_CLASS, Book::class);

        $prepare->execute();

        return $prepare->fetch();
    }
}
