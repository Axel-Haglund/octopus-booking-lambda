<?php



function getMeetings()
{
    require __DIR__ . "/../db-connection.php";
    $query = "select * from meeting";
    $result = mysqli_query($connection, $query);
    //echo var_dump($result->fetch_assoc());

    // while loop som lagrar alla meetings
    $meetings = [];
    while ($meeting = $result->fetch_assoc()) {
        $meetings[] = $meeting;
    }
    echo var_dump($meetings);
    return $meetings;
}

function generate_table()
{
    $meetings = getMeetings();
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
                $isBooked = checkIfBooked($hour, $meetings);
                echo $isBooked;
                if ($isBooked) {
                    echo "<td class='cell booked' id='room' data-row = '$j' data-room = '$i' > rum $i   $time</td>";
                } else {
                    echo "<td class='cell' id='room' data-row = '$j' data-room = '$i' > rum $i   $time</td>";
                }
            }
        }

        echo "</tr>";
    }
}

function checkIfBooked($hour, $meetings)
{
    echo "from if booked " . $hour;
    $length = count($meetings);
    for ($i = 0; $i < $length; $i++) {
        if ($hour == $meetings) {
            return true;
        }
    }
}
