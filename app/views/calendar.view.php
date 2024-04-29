<?php

require_once ('app/controllers/modules/generateCalendar.php');

$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$previousMonth = date('Y-m', strtotime('-1 month'));
$nextMonth = date('Y-m', strtotime('+1 month'));

$calendar = generateCalendar($month, $year, $tasks, $user_id);

?>

<?php require "components/head.php" ?>
<div
    class="-z-40 bg-purple-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-purple-800 bottom-0 leading-5 h-full w-full overflow-hidden">

</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
<div class="flex flex-col  items-center h-screen w-full">
    <h1 class="font-semibold text-4xl text-white my-10">Calendar</h1>
    <div class="flex flex-row gap-5">
        <button
            class="bg-purple-700 cursor-pointer text-center text-white w-28 font-extrabold flex flex-row items-center px-4 py-3 rounded-xl hover:bg-purple-400 transition-all text-sm">
            <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"
                class="-scale-x-1">
                <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001
    c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213
    C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606
    C255,161.018,253.42,157.202,250.606,154.389z" />
            </svg>
            <?= $previousMonth ?>
        </button>
        <button
            class="bg-purple-700 cursor-pointer text-center text-white w-28 font-extrabold flex flex-row items-center px-4 py-3 rounded-xl hover:bg-purple-400 transition-all text-sm">
            <?= $nextMonth ?>
            <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                <path id="XMLID_222_" d="M250.606,154.389l-150-149.996c-5.857-5.858-15.355-5.858-21.213,0.001
    c-5.857,5.858-5.857,15.355,0.001,21.213l139.393,139.39L79.393,304.394c-5.857,5.858-5.857,15.355,0.001,21.213
    C82.322,328.536,86.161,330,90,330s7.678-1.464,10.607-4.394l149.999-150.004c2.814-2.813,4.394-6.628,4.394-10.606
    C255,161.018,253.42,157.202,250.606,154.389z" />
            </svg>

        </button>
    </div>
    <?= $calendar ?>
</div>
</body>

</html>