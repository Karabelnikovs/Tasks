<?php require "components/head.php" ?>
<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<?php if (isset($_SESSION["user_id"])) { ?>
    <p><a href="logout" class="btn btn-outline-danger">Log out</a></p>
    <p><a href="create" class="btn btn-outline-info" style="position: absolute; top: 20px; right: 20px;">Add task</a></p>

<?php } else { ?>
    <p><a href="login" class="btn btn-outline-success">Log in</a></p>
<?php } ?>

<script defer src="public/cards.js"></script>
<link rel="stylesheet" href="public/style.css">






<div class="content">
    <form class="form relative">
        <div class="input-group mb-3">
            <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-labelledby="search" class="w-5 h-5 text-gray-700">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
            <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>'
                class="input rounded-full px-8 py-3 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow-md"
                placeholder="Search..." required="" />
            <button type="reset" class="absolute right-3 -translate-y-1/2 top-1/2 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </form>


    <h2 style="font-size: 30px;">Darbi:</h2>

    <div id="container"></div>
    <!-- <div class="table-responsive">
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
                                <p style="color: <?= (date("Y-m-d H:i:s", time()) >= $task["deadline_date"]) ? 'red' : 'black'; ?>"><?= $task["deadline_date"] ?></p>
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
                                        <input type="hidden" name="delete" value="<?= $task["id"] ?>">
                                        <button class="<?=
                                            $_SESSION["user_id"] == $task["user_created"]
                                            ? "btn btn-outline-danger" : "btn" ?>" type="submit">Izdzēst</button>
                                    </form>
                                    <form method="POST">
                                        <input type="hidden" name="edit" value="<?= $task["id"] ?>">
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
        </div> -->
</div>
</body>

</html>