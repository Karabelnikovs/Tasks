<?php require "components/head.php" ?>
<div
    class="-z-40 bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<script>
    function redirectAfterSeconds() {
        setTimeout(function () {
            window.location.href = "tasks";
        }, 5000);
    }
</script>
<div class="flex flex-col w-screen h-screen items-center justify-center">
    <h1 class="font-semibold text-4xl text-white mb-3">Succes!</h1>
    <p class="flex flex-row gap-2 items-center justify-center text-sm opacity-75 text-gray-300">Redirecting to login in
        5
        seconds, or press <a href="/" class=" p-1 w-20 justify-center group transition-all w-22 flex flex-nowrap text-white over:no-underline
                duration-300 rounded-full border-2 border-violet-500 hover:bg-violet-500">here</a> if it doesn't
        redirect!
    </p>
    <script>redirectAfterSeconds();</script>

</div>
</body>

</html>