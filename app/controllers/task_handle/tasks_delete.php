<?php
// todo: better method for deleting tasks
session_start();


$config = require "config.php";
require "Database.php";

$db = new Database($config["config"]);

$query_string = "DELETE FROM tasks WHERE id = ? AND user_created = ?";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    if(isset($_POST["delete"])){
        $params = [
            $_POST["delete"],
            $_SESSION["user_id"]
        ];
        $db->execute($query_string, $params);
        header("Location: tasks");
        exit();
    }


}

