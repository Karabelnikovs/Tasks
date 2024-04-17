<?php require "components/head.php" ?>
<?php if (isset($_SESSION["user_id"])) { ?>
    <p style="margin-top: -10px;"><a href="logout" class="btn btn-outline-danger">Log out</a></p> <br>

<?php } else { ?>
    <p><a href="login" class="btn btn-outline-success">Log in</a></p>
<?php } ?>



<form method="post" action="create">
<input name="title" type="text" placeholder="Title" value="<?= isset($_POST["title"]) ? $_POST["title"] : "" ?>" style="margin-bottom: 25px;"><br>
<input name="description" type="text" placeholder="Description" value="<?= isset($_POST["description"]) ? $_POST["description"] : "" ?>" style="margin-bottom: 20px;"><br>
<input name="deadline_date" type="datetime-local" value="<?= isset($_POST["deadline_date"]) ? $_POST["deadline_date"] : "" ?>" style="margin-bottom: 20px;"><br>

    <?php 
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='alert alert-danger'>$error</p><br>";
        }
    }
    ?>
    <button class="btn btn-success">submit</button>


</form>