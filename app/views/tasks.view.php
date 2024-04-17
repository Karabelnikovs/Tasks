<?php require "components/head.php" ?>
<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<?php if (isset($_SESSION["user_id"])) { ?>
    <a href="logout" class="btn btn-outline-danger" style="position: absolute; top: 20px; left: 20px;">Log out</a>
    <a href="create" class="btn btn-outline-info" style="position: absolute; top: 20px; right: 20px;">Add task</a>

<?php } else { ?>
    <a href="login" class="btn btn-outline-success">Log in</a>
<?php } ?>

<script defer src="public/cards.js"></script>
<link rel="stylesheet" href="public/style.css">

<div class="content">
    <h1 style="font-size: 25px; ">Darbi</h1><br>
    <form>
        <h2 style="position: absolute; top: 78px; right: 680px">Atrast task pēc nosaukuma</h2>
        <div class="input-group mb-3">
            <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>' class="form-control"
                placeholder="Nosaukums">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" style="background-color: white; color: black;" onmouseover="this.style.color='black'" onmouseout="this.style.color='';"><a><span>Meklēt </span></a></button>
            </div>
        </div>
    </form>


    <h2 style="font-size: 30px;">Darbi:</h2>

    <div id="container"></div>
</div>
</body>

</html>