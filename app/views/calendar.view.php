<?php

require_once ('app/controllers/modules/generateCalendar.php');

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$previousMonth = date('Y-m', strtotime('-1 month'));
$nextMonth = date('Y-m', strtotime('+1 month'));

$calendar = generateCalendar($month, $year, $tasks, $user_id);
if (isset($_GET["previous"])) {
    $calendar = generateCalendar($previousMonth, $year, $tasks, $user_id);
}
if (isset($_GET["next"])) {
    $calendar = generateCalendar($nextMonth, $year, $tasks, $user_id);
}
?>

<?php require "components/head.php" ?>
<div
    class="-z-40 bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<a href="/"
    class="group transition-all w-22 flex flex-nowrap text-white hover:no-underline duration-300 rounded-full px-4 py-1 absolute top-7 left-10 border-2 border-red-500 hover:bg-red-500">Back
    <svg class="stroke-white stroke-2 transition-all duration-300 relative -right-1 top-1 w-5 h-5 " viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg" fill="none">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
    </svg>
</a>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
<div class="flex flex-col  items-center h-screen w-full">
    <h1 class="font-semibold text-4xl text-white my-8">Calendar</h1>
    <div class="flex flex-row gap-5">
        <input type="hidden" name="previous">
        <button
            class="bg-purple-700 cursor-pointer text-center text-white w-28 font-extrabold flex flex-row items-center px-3 py-3 rounded-xl hover:bg-purple-400 transition-all text-sm">
            <svg class="" width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11 9L8 12M8 12L11 15M8 12H16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <?= $previousMonth ?>
        </button>
        </input>
        <input type="hidden" name="next">
        <button
            class="bg-purple-700 cursor-pointer text-center text-white w-28 font-extrabold flex flex-row items-center px-3 py-3 rounded-xl hover:bg-purple-400 transition-all text-sm">
            <?= $nextMonth ?>
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

        </button>
        </input>
    </div>
    <?= $calendar ?>
</div>
</body>

</html>