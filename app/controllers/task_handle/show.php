<?php

session_start();
date_default_timezone_set('Europe/Riga');


if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}


$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);
$page_title = "Show task";

$query_string = "SELECT * FROM tasks WHERE id = ?";


$params = [$_GET["id"]];

$tasks = $db->execute($query_string, $params)->fetchAll();

require "app/views/show.view.php";