<?php

require "public/signup_validator.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = new Validator($_POST["username"], $_POST["email"], $_POST["password"], $_POST["password_confirmation"]);
    $errors = $errors->validate( $_POST["email"], $_POST["username"], $_POST["password"], $_POST["password_confirmation"]);

    if (empty($errors)) {
        $config = require "public/config.php";
        require "public/Database.php";
    
        $db = new Database($config["config"]);
    
        $users = $db->execute("SELECT * FROM users WHERE email = :email", [":email" => $_POST["email"]])->fetchall();
        if (empty($users)) {
    
            $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $user_status = 0;
            $query_string = "INSERT INTO users (username, PASSWORD, email, administrator) VALUES (?, ?, ?, ?)";
            $params = [];
    
            $params = [
                $_POST["username"],
                $password_hash,
                $_POST["email"],
                $user_status
            ];
            $db->execute($query_string, $params);
            session_start();
                
                session_regenerate_id();
                
                $_SESSION["user_id"] = $user["id"];
            header("Location: signup-succes");
            exit;
        }else{
            header("Location: signup");
            die();
        }
    }
    else{
        var_dump($errors);
    }
}




$page_title = "Signup";
require "app/views/signup.view.php";