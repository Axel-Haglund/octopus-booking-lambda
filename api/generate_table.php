<?php


// hämtar möten från databas
function getMeetings($date)
{
    require __DIR__ . "/../db-connection.php";
    $query = "select * from meeting WHERE date = '{$date}' ";
    $result = mysqli_query($connection, $query);
    //echo var_dump($result->fetch_assoc());

    // while loop som lagrar alla meetings
    $meetings = [];
    while ($meeting = $result->fetch_assoc()) {
        $meetings[] = $meeting;
    }
    return $meetings;

    // skriver ut bokningar som en lista
    // echo var_dump($meetings);

}

function generate_table($date)
{
    $meetings = getMeetings($date);
    // Loop through rows
    for ($roomNumber = 1; $roomNumber <= 15; $roomNumber++) {

        echo "<tr>";

        // Loop through columns
        for ($hour = 6; $hour <= 19; $hour++) {

            $time = sprintf(
                "%02d:%02d",
                $hour,
                "00"
            );

            $isBooked = checkIfBooked($hour, $roomNumber, $meetings);
            // echo $isBooked;
            if ($isBooked) {
                echo "<td class='cell booked' id='room' data-hour = '$hour' data-room = '$roomNumber' > rum $roomNumber   $time</td>";
            } else {
                echo "<td class='cell' id='room' data-hour = '$hour' data-room = '$roomNumber' > rum $roomNumber   $time</td>";
            }
        }

        echo "</tr>";
    }
}

function checkIfBooked($hour, $roomNumber,  $meetings)
{

    $length = count($meetings);
    for ($i = 0; $i < $length; $i++) {

        if ($hour == $meetings[$i]["hour"] && $roomNumber == $meetings[$i]["room_id"]) {
            // echo var_dump($meetings[$i]);
            return true;
        }
    }
    return false;
}
