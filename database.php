<?php

class DB {

    private $db;

    public function __construct() {

        $this->db = new PDO('sqlite:database.sqlite');

    }

    public function books($search = null) {
        $prepare = $this->db->prepare("select * from books where user_id = 1 and title like :search");

        $prepare->bindValue('search', "%$search%");

        $prepare->execute();

        $items = $prepare->fetchAll();

        return array_map(fn($item) => Book::make($item), $items);
    }

    public function book($id) {

        $sql = "select * from books where id = {$id}";

        $query = $this->db->query($sql);

        $items = $query->fetchAll();

        return array_map(fn($item) => Book::make($item), $items)[0];

    }
}
