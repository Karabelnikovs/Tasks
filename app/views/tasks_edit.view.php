<?php require "components/head.php" ?>
<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">
</div>
<div class="w-100 h-100 flex select-none justify-center align-center">
    <div
        class="w-80 h-50  absolute mt-80 z-20 bg-neutral-800 rounded-3xl text-ne utral-300 p-4 gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow">
        <form class="w-100 h-100 flex flex-col items-center justify-center gap-3" method="post" action="create">
            <input name="title" type="text" placeholder="Title"
                value="<?= isset($_POST["title"]) ? $_POST["title"] : "" ?>" class="bg-gray-700 rounded-lg">
            <textarea name="description" placeholder="Description"
                value="<?= isset($_POST["description"]) ? $_POST["description"] : "" ?>"
                class="resize-none bg-gray-700 rounded-lg w-65 h-50"></textarea>
            <input name="deadline_date" type="datetime-local"
                value="<?= isset($_POST["deadline_date"]) ? $_POST["deadline_date"] : "" ?>"
                class="bg-gray-700 rounded-lg">

            <?php
            if (!empty($errors)) {
                echo '<ul class="error-messages" style="position: relative; top: -300px; right: -350px;">';
                foreach ($errors as $error) {
                    echo "<li class='alert-danger'>$error</li>";
                }
                echo '</ul>';
            }
            ?>
            <button
                class="group transition-all w-22 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full border-2 border-violet-500 hover:bg-violet-500">
                Submit</button>
        </form>
    </div>
</div>