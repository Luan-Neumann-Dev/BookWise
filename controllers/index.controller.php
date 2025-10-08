<?php

    $books = (new DB)->books();

    view('index', compact('books'));


