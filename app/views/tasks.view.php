<?php require "components/head.php" ?>
<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<?php if (isset($_SESSION["user_id"])) { ?>
    <a href="logout" class="transition-all text-white hover:no-underline duration-300 rounded-full px-2 py-1 absolute top-7 left-10 border-2 border-red-500 hover:bg-red-500">Log out</a>
    <a href="create" class="transition-all text-white hover:no-underline duration-300 rounded-full px-2 py-1 absolute top-7 right-10 border-2 border-purple-700 hover:bg-purple-700">Add task</a>

<?php } else { ?>
    <a href="login" class="btn btn-outline-success"
    style="position: absolute; top: 20px; right: 20px;">Log in</a>
<?php } ?>

<script defer src="public/cards.js"></script>
<link rel="stylesheet" href="public/style.css">






<div class="content">
    <form class="form relative">
        <div class="input-group top-5">
            <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-labelledby="search" class="w-5 h-5 text-gray-700">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
            <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>'
                class="input rounded-full px-8 py-2 border-2 border-transparent focus:outline-none focus:border-blue-500 placeholder-gray-400 transition-all duration-300 shadow-md"
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

    <div id="container">
    <div class="inline-block h-12 w-12 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"></div>
    </div>
</div>
</body>

</html>