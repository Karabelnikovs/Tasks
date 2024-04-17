<?php
$page_title = "Login";

$config = require "public/config.php";
require "public/Database.php";

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database($config["config"]);
    $errors = [];

    $query_string = "SELECT * FROM users WHERE email = :email";


    $params = [":email" => $_POST["email"]];
    $user = $db->execute($query_string, $params)->fetchAll();

    if (!empty($user)) {
        $user = $user[0];
        if ($user) {
            if (password_verify($_POST["password"], $user["PASSWORD"])) {

                session_start();

                session_regenerate_id();

                $_SESSION["user_id"] = $user["id"];
                setcookie("user_id", $_SESSION["user_id"]);
                header("Location: tasks");
                exit();
            } else {
                $errors["password"] = "Password is incorrect";
            }
        }
        $is_invalid = true;
    } else {
        if (!isset($_POST["email"]) || empty($_POST["email"])) {
            $errors["email"] = "Email is required!";
        }else{
            $errors["email"] = "User does not exist";
        }
        if (!isset($_POST["password"]) || empty($_POST["password"])) {
            $errors["password"] = "Password is required!";
        }
    }


}

require "app/views/login.view.php";