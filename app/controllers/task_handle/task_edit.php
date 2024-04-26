<?php
//todo: implement edit feature for tasks
session_start();
date_default_timezone_set('Europe/Riga');


if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}


$config = require "public/config.php";
require "public/Database.php";

$db = new Database($config["config"]);
$page_title = "Edit task";

$query_string = "SELECT * FROM tasks WHERE id=?";
$params = [$_GET["id"]];


$tasks = $db->execute($query_string, $params)->fetchAll();



$errors = [];
$update_string = "UPDATE tasks SET deadline_date=?, title=?, DESCRIPTION=?, done=? WHERE id = ?";
$update_params = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (Validator::string($_POST['title'], min: 5, max: 50)) {
        $errors["title"] = "Title must be a string between 5 and 50 characters.";
    }
    if (Validator::string($_POST["description"], min: 10, max: 500)) {
        $errors["description"] = "Description must be a string between 10 and 500 characters.";
    }
    if (!Validator::validateDatetime(strtotime($_POST["deadline_date"]))) {
        $errors["deadline_date"] = "Deadline date must be a valid date.";
    }
    if (time() >= strtotime($_POST["deadline_date"])) {
        $errors["deadline_date"] = "Deadline date cannot be in the past or this instant.";
    }
    if (empty($errors)) {
        $update_params = [
            $_POST["deadline_date"],
            $name,
            $description,
            $_GET["id"]
        ];
        $updated = $db->execute($update_string, $update_params)->fetchAll();
        header('Location: /');
        exit();
    }


}

require "app/views/tasks_edit.view.php";