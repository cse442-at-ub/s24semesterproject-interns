<?php
// Set timezone to your preference
date_default_timezone_set('America/New_York');

$currentDateTime = date("Y-m-d H:i:s");

// Get current date information
$currentYear = date("Y");
$currentMonth = date("m");
$currentDay = date("d");

// Get the first day of the current month
$firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);

// Get the number of days in the current month
$numberOfDaysInMonth = date("t", $firstDayOfMonth);

// Get the name of the current month
$monthName = date("F", $firstDayOfMonth);

// Get the index of the first day of the week for the current month
$dayOfWeek = date("N", $firstDayOfMonth);

// Start the HTML output
echo "Current date and time in New York: $currentDateTime";
echo "<h2>$monthName $currentYear</h2>";
echo "<table border='1'>";
echo "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";

// Start counting the days
$dayCount = 1;

// Create the calendar rows
for ($i = 0; $i < 6; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 7; $j++) {
        if (($i == 0 && $j < $dayOfWeek - 1) || ($dayCount > $numberOfDaysInMonth)) {
            echo "<td></td>";
        } else {
            if ($dayCount == $currentDay) {
                echo "<td style='background-color: #ffff00;'>$dayCount</td>";
            } else {
                echo "<td>$dayCount</td>";
            }
            $dayCount++;
        }
    }
    echo "</tr>";
}

// Close the table
echo "</table>";
?>
