<?php

$book = (new DB)->book($_REQUEST['id']);

view('livro', compact('book'));
?>

