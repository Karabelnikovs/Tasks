<?php
//todo: implement tasks create
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: /');
    exit();
}


$config = require "public/config.php";
require "public/Database.php";
require "public/signup_validator.php";
$db = new Database($config["config"]);


$query_string = "
INSERT INTO tasks(title, user_created, created_date, deadline_date, DESCRIPTION) 
VALUES (?,?,?,?,?)";
$params = [];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (Validator::string($_POST['title'], min: 5, max:50)) {
        $errors["title"] = "Title must be a string between 5 and 50 characters.";
    }
    if (Validator::string($_POST["description"], min:10, max:500)) {
        $errors["description"] = "Description must be a string between 10 and 500 characters.";
    }
    if (!Validator::validateDatetime(strtotime($_POST["deadline_date"]))) {
        $errors["deadline_date"] = "Deadline date must be a valid date.";
    }

    if (empty($errors)) {
        $params = [
            $_POST["title"],
            $_SESSION['user_id'],
            date("Y-m-d H:i:s", time(), ),
            date("Y-m-d H:i:s", strtotime($_POST["deadline_date"]), ),
            $_POST["description"]
        ];
        $db->execute($query_string, $params);
        header('Location: /');
        exit();
    }
}

$page_title = "Create task";
require "app/views/tasks_create.view.php";