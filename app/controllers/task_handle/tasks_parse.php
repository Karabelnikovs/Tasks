<?php
session_start();
$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);
$page_title = "Tasks";
$query_string = "SELECT
tasks.*, users.username
FROM tasks
INNER JOIN users ON tasks.user_created = users.id WHERE users.id = ?";

$params = [$_SESSION['user_id']];
echo json_encode($db->execute($query_string, $params)->fetchAll());