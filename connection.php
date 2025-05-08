<?php

$host = getenv("DB_HOST");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$name = getenv("DB_NAME");

$database = new mysqli($host, $user, $pass, $name);

if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}
?>
