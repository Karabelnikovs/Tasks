<?php
// TODO VERY NOT COOL METHOD OF DOING THIS PLS SOMEONE WORK ON SECURITY!!!!!!!!

$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);
$page_title = "Tasks";
$query_string = "SELECT
tasks.*, users.username
FROM tasks
INNER JOIN users ON tasks.user_created = users.id WHERE users.id = ?";

$params = [$_COOKIE['user_id']];
echo json_encode($db->execute($query_string, $params)->fetchAll());