<?php
define("DB_HOST", "localhost");
define("DB_PASS", "");
define("DB_USER", "root");
define("DB_NAME", "php_crud");

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error) {
    die($connection->connect_error);
}