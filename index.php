<?php

require 'models/Book.php';
require 'models/User.php';
session_start();

require 'Flash.php';

require 'functions.php';

require 'Validation.php';

$config = require 'config.php';

require "database.php";

require 'routes.php';