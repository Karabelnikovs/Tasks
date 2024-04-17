<?php

session_start();
date_default_timezone_set('Europe/Riga');
if(!isset($_SESSION['user_id'])){
    die(header('Location: /login'));
}
$page_title = "Tasks";
require "app/views/tasks.view.php";
?>