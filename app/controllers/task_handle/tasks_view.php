<?php

session_start();
date_default_timezone_set('Europe/Riga');



$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);
$page_title = "Tasks";
// todo: work on a better solution for this query
$query_string = "SELECT
tasks.*, users.username
FROM tasks
INNER JOIN users ON tasks.user_created = users.id WHERE users.id = ?";
if(!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}
$params = [$_SESSION['user_id']];

if (isset($_GET["title"]) && $_GET["title"] != "") {
    $query_string .= " WHERE title=:title";
    $params[":title"] = $_GET["title"];
}

$tasks = $db->execute($query_string, $params)->fetchAll();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["done"])) {
        $index = $_POST["done"];
        if ($_SESSION["user_id"] == $tasks[$index]["user_created"]) {
            $update_query = "UPDATE tasks SET done = 0 WHERE user_created = ? AND id = ?";
            $update_params = [
                $_SESSION['user_id'],
                $tasks[$index]['id']
            ];
            $db->execute($update_query, $update_params);
            header("Location: tasks");
            exit();
        }
    }
    if (isset($_POST["notdone"])) {
        $index = $_POST["notdone"];
        if ($_SESSION["user_id"] == $tasks[$index]["user_created"]) {

            $update_query = "UPDATE tasks SET done = 1 WHERE user_created = ? AND id = ?";
            $update_params = [
                $_SESSION['user_id'],
                $tasks[$index]['id']
            ];
            $db->execute($update_query, $update_params);

            header("Location: tasks");
            exit();
        }
    }
}


require "app/views/tasks.view.php";
return json_encode($tasks);
?>