<?php require "components/head.php" ?>
<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<?php if (isset($_SESSION["user_id"])) { ?>
    <form class="form absolute  left-10">
        <div class="input-group top-7">
            <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-labelledby="search" class="w-5 h-5 text-gray-700">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
            <input name="title" type="text" value='<?= ($_GET["title"] ?? '') ?>' class="input rounded-full px-8
                transition-all duration-300
                w-px
                py-2 border-2
                focus:w-full
                border-transparent
                focus:outline-none
                focus:border-blue-500 placeholder-gray-400
                shadow-md" placeholder="Search..." required="" />
            <button type="reset" class="absolute right-3 -translate-y-1/2
             top-1/2 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </form>

    <a href="logout"
        class="py-2 border-2 group transition-all w-24 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full px-2 py-1 absolute top-7 right-10 border-2 border-red-500 hover:bg-red-500">Log
        out<svg class="group-hover:stroke-black stroke-white transition-all duration-300 relative -right-1 top-1 w-5 h-5 "
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 12h-9.5m7.5 3l3-3-3-3m-5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h5a2 2 0 002-2v-1" />
        </svg>
    </a>

<?php } else { ?>
    <a href="login" class="btn btn-outline-success" style="position: absolute; top: 20px; right: 20px;">Log in</a>
<?php } ?>

<script defer src="public/cards.js"></script>
<link rel="stylesheet" href="public/style.css">







<div class="content">
    <div id="container">
        <div class="inline-block h-12 w-12 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"
            style="margin-left: 49vw;">
        </div>
    </div>
    <a href="create"
        class="w-fit absolute flex flex-nowrap transition-all text-white hover:no-underline duration-300 rounded-full bottom-24  border-2 border-purple-700 hover:bg-purple-700">
        <svg class="hover:stroke-black stroke-white transition-all duration-300 relative stroke-2  w-10 h-10"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="relative top-0 right-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </a>

</div>
</body>

</html>