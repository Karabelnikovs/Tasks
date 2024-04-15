<?php require "components/head.php" ?>
<?php if (isset($_SESSION["user_id"])) { ?>
    <p><a href="logout" class="btn btn-outline-danger">Log out</a></p>
    <p><a href="create" class="btn btn-outline-info" style="right: 0;
position: absolute;
top: 0;">Add task</a></p>
<?php } else { ?>
    <p><a href="login" class="btn btn-outline-success">Log in</a></p>
<?php } ?>




<div class="content">
    <h1>Darbi</h1><br>
    <form>
        <h2>Atrast task pēc nosaukuma</h2>
        <div class="input-group mb-3">
            <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>' class="form-control"
                placeholder="Nosaukums">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary"><a><span>Meklēt</span></a></button>
            </div>
        </div>
    </form>


    <h2>Darbi:</h1>
        <div class="table-responsive">
            <table class="table table-bordered" id="responsive-table">
                <thead>
                    <tr>
                        <th scope="col">Nosaukums</th>
                        <th scope="col">Apraksts</th>
                        <th scope="col">Autors</th>
                        <th scope="col">Uztaisīts</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Pabeigts</th>
                        <th scope="col">Papildus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $index => $task): ?>
                        <tr>
                            <th scope="row">
                                <?= $task["title"] ?>
                                </td>
                            <td>
                                <?= $task["DESCRIPTION"] ?>
                            </td>
                            <td>
                                <?= $task["username"] ?>
                            </td>

                            <td>
                                <?= $task["created_date"] ?>
                            </td>
                            <td>
                                <p style="color: <?= ($task["created_date"] >= $task["deadline_date"]) ? 'red' : 'black'; ?>"><?= $task["deadline_date"] ?></p>
                            </td>
                            <td>
                                <?php if (
                                    isset($_SESSION["user_id"])
                                    && $task["done"] == 1
                                    && isset($_SESSION["user_id"]) == $task["user_created"]
                                ): ?>
                                    <form method="POST">
                                        <input type="hidden" name="done" value="<?= $index ?>" class="form-control">
                                        <button type="submit" class="<?=
                                            $_SESSION["user_id"] == $task["user_created"]
                                            ? "btn btn-success" : "btn" ?>">Ir</button>
                                    </form>
                                <?php elseif (
                                    isset($_SESSION["user_id"])
                                    && $task["done"] == 0
                                    && isset($_SESSION["user_id"]) == $task["user_created"]
                                ): ?>
                                    <form method="POST">
                                        <input type="hidden" name="notdone" value="<?= $index ?>" class="form-control">
                                        <button type="submit" class="<?=
                                            $_SESSION["user_id"] == $task["user_created"]
                                            ? "btn btn-danger" : "btn" ?>">Nav</button>
                                    </form>
                                <?php else: ?>
                                    Ieejiet lai redzēt izpildijuma datus.
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (isset($_SESSION["user_id"])) { ?>
                                    <form method="POST" action="delete">
                                        <input type="hidden" name="delete" value="<?= $index ?>">
                                        <button class="<?=
                                            $_SESSION["user_id"] == $task["user_created"]
                                            ? "btn btn-outline-danger" : "btn" ?>" type="submit">Izdzēst</button>
                                    </form>
                                    <form method="POST">
                                        <input type="hidden" name="edit" value="<?= $index ?>">
                                        <button class="<?=
                                            $_SESSION["user_id"] == $task["user_created"]
                                            ? "btn btn-outline-info" : "btn" ?>" type="submit">Rediģēt</button>
                                    </form>
                                <?php } else { ?>
                                    Ieejiet lai redzēt papildus opcijas.
                                <?php } ?>
                            </td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>
</body>

</html>