<?php

session_start();
session_unset();
session_destroy();
setcookie("user_id", null, time());
header("Location: tasks");
exit;