<?php

$id = $_REQUEST['id'];

$book = (new DB)->book($id);

view('livro', compact('book'));
?>

