<?php

session_start();
date_default_timezone_set('Europe/Riga');

if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}
$user_id = $_SESSION['user_id'];
$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);

$query_string = "SELECT * FROM tasks ORDER BY deadline_date ASC;";
$params = [];


$tasks = $db->execute($query_string, $params)->fetchAll();

$page_title = "Calendar";
require "app/views/calendar.view.php";