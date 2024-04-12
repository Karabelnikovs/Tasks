<?php require "components/head.php" ?>
<?php if (isset($_SESSION["user_id"])) { ?>
    <p><a href="logout" class="btn btn-outline-danger">Log out</a></p>
<?php } else { ?>
    <p><a href="login" class="btn btn-outline-success">Log in</a></p>
<?php } ?>



<form method="post" action="create">
    <input name="title" type="text" placeholder="title" value='<?= isset($_POST["title"]) ? $_POST["title"] : "" ?>'><br>
    <input name="description" type="text" placeholder="description" value='<?= isset($_POST["description"]) ? $_POST["description"] : "" ?>'><br>
    <input name="deadline_date" type="datetime-local" value='<?= isset($_POST["deadline_date"]) ? $_POST["deadline_date"] : "" ?>'><br>
    <?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='alert alert-danger'>$error</p><br>";
        }
    }
    ?>
    <button class="btn btn-success">submit</button>


</form>