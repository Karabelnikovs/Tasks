<?php require "components/head.php" ?>
<div
    class=" bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">
</div>
<a href="/"
    class="group transition-all w-22 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full px-4 py-1 absolute top-7 left-10 border-2 border-red-500 hover:bg-red-500">Back
    <svg class="stroke-white stroke-2 transition-all duration-300 relative -right-1 top-1 w-5 h-5 " viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg" fill="none">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
    </svg>
</a>
<div class="w-100 h-screen flex select-none justify-center items-center">
    <div
        class="w-80 h-50  absolute z-20 bg-neutral-800 rounded-3xl text-ne utral-300 p-4 gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow">
        <form class="w-100 h-100 flex flex-col items-center justify-center gap-3" method="post">
            <input name="title" type="text" placeholder="Title" value="<?= $tasks[$index]["title"] ?>"
                class="bg-gray-700 rounded-lg text-gray-400 p-1 px-2 outline outline-purple-400 outline-2 focus:outline-offset-2">
            <textarea name="description" placeholder="Description"
                class="resize-none bg-gray-700 rounded-lg w-65 h-50 text-gray-400 p-1 px-2 outline outline-purple-400 outline-2 focus:outline-offset-2"><?= htmlspecialchars($tasks[$index]["DESCRIPTION"]) ?></textarea>
            <input name="deadline_date" type="datetime-local" value="<?= $tasks[$index]["deadline_date"] ?>"
                class="bg-gray-700 rounded-xl text-gray-400 p-1 px-2 outline outline-purple-400 outline-2 focus:outline-offset-2">

            <?php
            if (!empty($errors)) {
                echo '<ul class="error-messages" style="position: relative; top: -300px; right: -350px;">';
                foreach ($errors as $error) {
                    echo "<li class='alert-danger'>$error</li>";
                }
                echo '</ul>';
            }
            ?>
            <button class=" p-1 w-20 justify-center group transition-all w-22 flex flex-nowrap text-white over:no-underline
                duration-300 rounded-full border-2 border-violet-500 hover:bg-violet-500">
                Save</button>
        </form>
    </div>
</div>