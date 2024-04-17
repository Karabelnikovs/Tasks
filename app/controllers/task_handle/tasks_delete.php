<?php
session_start();
date_default_timezone_set('Europe/Riga');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id']) && isset($_POST['delete'])) {

    $config = require "public/config.php";
    require "public/Database.php";

    $db = new Database($config["config"]);
    $tasks = $db->execute("SELECT
    tasks.*, users.username
    FROM tasks
    INNER JOIN users ON tasks.user_created = users.id WHERE users.id = ?", [$_SESSION["user_id"]])->fetchAll();
    $query_string = "DELETE FROM tasks WHERE id = ? AND user_created = ?";
    $params = [
        $tasks[$_POST["delete"]]["id"],
        $_SESSION["user_id"]
    ];
    $db->execute($query_string, $params);
}
