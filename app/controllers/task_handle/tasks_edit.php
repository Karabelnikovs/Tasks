<?php
//todo: implement edit feature for tasks
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}


$config = require "config.php";
require "Database.php";

$db = new Database($config["config"]);
$page_title = "Tasks";

$query_string = "SELECT * FROM tasks";
$params = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

}