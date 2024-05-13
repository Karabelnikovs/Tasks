<?php require "components/head.php" ?>

<div
    class="bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
<svg class="absolute rotate-180 top-0 left-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#fff" fill-opacity="1"
        d="M0,0L40,42.7C80,85,160,171,240,197.3C320,224,400,192,480,154.7C560,117,640,75,720,74.7C800,75,880,117,960,154.7C1040,192,1120,224,1200,213.3C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
    </path>
</svg>
<div class="absolute flex flex-row justify-center items-center w-screen mt-10">
    <form class="form absolute left-10">
        <div class="input-group ">
            <button class="absolute left-2 -translate-y-1/2 top-1/2 p-1">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
                    aria-labelledby="search" class="w-5 h-5 text-purple-400 font-bold">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
                        stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                </svg>
            </button>
            <input name="title" id="search" type="text" class="input rounded-full px-8
                transition-all
                w-0
                py-2 border-2
                max-w-40
                sm:max-w-48
                md:max-w-52
                lg:max-w-60
                xl:max-w-64
                2xl:max-w-72
                bg-gray-700
                focus:w-full
                border-transparent
                focus:outline-none
                focus:border-purple-400 placeholder-gray-400
                font-bold
                shadow-md" placeholder="Search..." required="" />
            <button type="reset" class="absolute right-3 -translate-y-1/2
             top-1/2 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-400 font-bold" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </form>

    <a href="/calendar"
        class="top-9 text-purple-500 absolute flex flex-row align-center justify-center gap-1 py-2 border-2 group transition-all w-26 flex flex-nowrap text-black hover:no-underline duration-300 rounded-full px-2 py-1 border-2 border-purple-500 hover:bg-purple-500 hover:text-black">Calendar<svg
            width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg ">
            <path
                d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z"
                stroke="#000000" stroke-width="2" stroke-linecap="round" />
        </svg>
    </a>

    <a href="logout"
        class="right-10 py-2 border-2 group transition-all w-24 flex flex-nowrap text-red-500 hover:no-underline duration-300 rounded-full px-2 py-1 absolute border-2 border-red-500 hover:bg-red-500 hover:text-black">Log
        out<svg
            class="group-hover:stroke-black stroke-red-500 transition-all duration-300 relative -right-1 top-1 w-5 h-5 "
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 12h-9.5m7.5 3l3-3-3-3m-5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h5a2 2 0 002-2v-1" />
        </svg>
    </a>

</div>

<script defer src="public/cards.js"></script>
<link rel="stylesheet" href="public/style.css">







<div class="flex flex-col items-center justify-center">
    <div id="container">
        <div class="inline-block h-12 w-12 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"
            style="margin-left: 49vw;">
        </div>
    </div>
    <div class="absolute flex align-center justify-center h-fit w-screen bottom-16 gap-5">
    <div 
    class=" w-fit h-fit flex flex-nowrap pointer transition-all text-white p-2 hover:no-underline duration-300 rounded-full bottom-16 sm:hidden border-2 border-purple-700 hover:bg-purple-700"
    onclick="prevCard()">
    &larr;
    </div>
    <div class=" w-fit flex font-bold flex-nowrap pointer transition-all text-white hover:no-underline duration-300 rounded-full bottom-16  border-2  border-purple-700 hover:bg-purple-700"
        onclick="promptNew()">
        <svg class="hover:stroke-black stroke-white transition-all duration-300 relative stroke-2  w-10 h-10"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="relative top-0 right-0 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </div>
    <div 
    class="w-fit h-fit font-bold flex flex-nowrap pointer transition-all text-white p-2 hover:no-underline duration-300 rounded-full bottom-16  sm:hidden border-2 border-purple-700 hover:bg-purple-700"
    onclick="nextCard()">
        &rarr;
    </div>

    </div>

</div>
</body>

</html>