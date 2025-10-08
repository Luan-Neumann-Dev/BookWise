<?php

    $search = $_REQUEST["search"] ?? '';

    $books = (new DB)->books($search);

    view('index', compact('books'));


