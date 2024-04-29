<?php

function generateCalendar($month, $year, $tasks, $user_id)
{
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $daysInMonth = date('d', mktime(0, 0, 0, $month + 1, 0, $year));
    $dayOfWeek = date('w', $firstDay);

    $calendar = "<table class='table'>";
    $calendar .= "<tr class='border-b border-gray-200 calendar-head'>";
    $calendar .= "<th class='text-left px-4 py-2 font-medium text-gray-700 uppercase tracking-wider'>" . date('F', $firstDay) . " " . $year . "</th></tr>";

    $calendar .= "<tr class='border-b border-gray-200'>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Sun</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Mon</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Tue</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Wed</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Thu</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Fri</th>";
    $calendar .= "<th class='text-center px-4 py-2 text-xs font-medium text-gray-400'>Sat</th></tr>";

    for ($i = 0; $i < $dayOfWeek; $i++) {
        $calendar .= "<td></td>";
    }

    $dayCounter = 1;
    for ($i = $dayOfWeek; $i < 42; $i++) {
        $dateString = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $dayCounter);

        if ($dayCounter > $daysInMonth) {
            break;
        }

        $calendar .= "<td class='z-20 bg-neutral-800 text-white text-ne utral-300 p-4 gap-3 hover:bg-gray-1000 hover:shadow-lg hover:shadow-purple-400 hover:z-44 transition-shadow"
            . (date('Y-m-d') === $dateString ? 'calendar-day-today' : '') . "'>";

        // var_dump($tasks);
        $deadlines = [];
        foreach ($tasks as $key => $task) {

            if (substr($task['deadline_date'], 0, 10) === $dateString) {
                if ($user_id == $task["user_created"]) {
                    $deadlines[$key]['title'] = $task['title'];
                    $deadlines[$key]['time'] = substr($task['deadline_date'], -8);
                }
            }
        }
        $calendar .= $dayCounter;
        if (!empty($deadlines)) {
            $calendar .= "<div class='deadline-list text-white'>";
            foreach ($deadlines as $deadline) {
                $calendar .= "<p>" . $deadline['title'] . " - " . $deadline['time'] . "</p>";
            }
            $calendar .= "</div>";
        }

        $calendar .= "</td>";

        if (($i + 1) % 7 === 0) {
            $calendar .= "</tr>";
        }

        $dayCounter++;
    }


    $remaining = ($i % 7);
    for ($i = 0; $i < (6 - $remaining); $i++) {
        $calendar .= "<td></td>";
    }

    $calendar .= "</table>";

    return $calendar;
}
