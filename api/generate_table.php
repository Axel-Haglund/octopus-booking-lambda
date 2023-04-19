<?php
function generate_table()
{


    // Loop through rows
    for ($i = 0; $i < 16; $i++) {
        $time = "06:30";

        echo "<tr>";

        // Loop through columns
        for ($j = 0; $j < 22; $j++) {


            if ($i == 0) {
                // echo "<td class='cell' id='header' data-time = '$time'> $time </td>";
            } else {
                // creates time increments 
                list($hour, $minute) = explode(':', $time);
                $minute += 30;
                if ($minute == 60) {
                    $hour++;
                    $minute = 0;
                }
                $time = sprintf(
                    "%02d:%02d",
                    $hour,
                    $minute
                );
                echo "<td class='cell' data-row = '$j' data-room = '$i' > rum $i   $time</td>";
            }
        }

        echo "</tr>";
    }
}
