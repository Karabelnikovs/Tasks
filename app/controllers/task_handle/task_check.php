<?php

session_start();
date_default_timezone_set('Europe/Riga');



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["check"])) {

        $config = require "public/config.php";
        require "public/Database.php";

        $db = new Database($config["config"]);
        $query_string = "SELECT
        tasks.*, users.username
        FROM tasks
        INNER JOIN users ON tasks.user_created = users.id WHERE users.id = ?";

        $params = [$_SESSION['user_id']];

        $tasks = $db->execute($query_string, $params)->fetchAll();
        $index = $_POST["check"];
        if ($_SESSION["user_id"] == $tasks[$index]["user_created"]) {
            $update_query = "UPDATE tasks SET done = ? WHERE user_created = ? AND id = ?";
            $update_params = [
                $tasks[$index]["done"] ? 0 : 1,
                $_SESSION['user_id'],
                $tasks[$index]['id']
            ];
            $db->execute($update_query, $update_params);
        }
    }
}

?>