<?php

session_start();
date_default_timezone_set('Europe/Riga');

$page_title = "Tasks";
require "app/views/tasks.view.php";
?>