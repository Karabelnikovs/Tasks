<?php require "components/head.php" ?>
<div class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden"></div>
<?php if (isset($_SESSION["user_id"])) { ?>
    <a href="/" class="group transition-all w-22 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full px-2 py-1 absolute top-7 left-10 border-2 border-red-500 hover:bg-red-500">Back
        <svg class="group-hover:stroke-black stroke-white stroke-2 transition-all duration-300 relative -right-1 top-1 w-5 h-5 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
        </svg>
    </a>
<?php } else { ?>
    <a href="login" class="group transition-all w-24 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full px-2 py-1 absolute top-7 left-10 border-2 border-green-500 hover:bg-green-500">Log in
        <svg class="group-hover:stroke-black stroke-white transition-all duration-300 relative -right-1 top-1 w-5 h-5 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12h-9.5m7.5 3l3-3-3-3m-5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h5a2 2 0 002-2v-1" />
        </svg>
    </a>
<?php } ?>

<div class="w-100 h-100 flex select-none justify-center align-center">
    <div class="w-80 h-50 flex absolute mt-80  flex-col z-20 bg-neutral-800 rounded-3xl text-neutral-300 p-4 gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 transition-shadow">
        <form class="w-100 h-50" method="post" action="create">
            <input name="title" type="text" placeholder="Title" value="<?= isset($_POST["title"]) ? $_POST["title"] : "" ?>" class="bg-gray-700 rounded mx-10 my-2">
            <textarea name="description" placeholder="Description" value="<?= isset($_POST["description"]) ? $_POST["description"] : "" ?>" class="resize-none h-full bg-gray-700 rounded mx-10 my-4"></textarea>
            <input name="deadline_date" type="datetime-local" value="<?= isset($_POST["deadline_date"]) ? $_POST["deadline_date"] : "" ?>" class="bg-gray-700 rounded mx-10 mb-12">
                        
            <?php
            if (!empty($errors)) {
                echo '<ul class="error-messages" style="position: relative; top: -300px; right: -350px;">';
                foreach ($errors as $error) {
                    echo "<li class='alert-danger'>$error</li>";
                }
                echo '</ul>';
            }
            ?>

<button class="btn btn-success" style="position: relative; top: -38px; right: -95px;" > Submit</button>
        </form>
    </div>
</div>
