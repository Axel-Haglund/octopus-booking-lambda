<?php

function getMeetings($date)
{
    require __DIR__ . "/../db-connection.php";

    $query = "SELECT meeting.*, user.email FROM meeting JOIN user ON meeting.user_id = user.user_id WHERE date = '{$date}'";
    $result = mysqli_query($connection, $query);

    $meetings = [];
    while ($meeting = $result->fetch_assoc()) {
        $meetings[] = $meeting;
    }
    return $meetings;
}

function checkIfBooked($hour, $roomNumber, $meetings)
{
    $length = count($meetings);
    for ($i = 0; $i < $length; $i++) {
        if ($hour == $meetings[$i]["hour"] && $roomNumber == $meetings[$i]["room_id"]) {
            return $meetings[$i];
        }
    }
    return false;
}

function generate_table($date)
{
    $_SESSION["selectedDate"] = $date;

    $meetings = getMeetings($date);
    for ($roomNumber = 1; $roomNumber <= 15; $roomNumber++) {

        echo "<tr>";

        for ($hour = 7; $hour <= 17; $hour++) {

            $time = sprintf(
                "%02d:%02d",
                $hour,
                "00"
            );

            $isBooked = checkIfBooked($hour, $roomNumber, $meetings);
            if ($isBooked) {
                echo "<td class='cell booked' id='room' data-hour='$hour' data-room='$roomNumber' data-email='{$isBooked['email']}'> rum $roomNumber $time</td>";
            } else {
                echo "<td class='cell' id='room' data-hour='$hour' data-room='$roomNumber'> rum $roomNumber $time</td>";
            }
        }

        echo "</tr>";
    }
}

function generate_room_table($roomNumber, $date)
{
    $meetings = getMeetings($date);
    for ($hour = 7; $hour <= 17; $hour++) {

        $time = sprintf(
            "%02d:%02d",
            $hour,
            "00"
        );

        $isBooked = checkIfBooked($hour, $roomNumber, $meetings);
        if ($isBooked) {
            echo "<td class='cell booked' id='room' data-hour='$hour' data-room='$roomNumber' data-email='{$isBooked['email']}'> rum $roomNumber $time</td>";
        } else {
            echo "<td class='cell' id='room' data-hour='$hour' data-room='$roomNumber'> rum $roomNumber $time</td>";
        }
    }
}

function getRoomUsageStatistics()
{
    require __DIR__ . "/../db-connection.php";

    $query = "SELECT room.room_id, COUNT(meeting.room_id) as total_bookings
              FROM room
              LEFT JOIN meeting ON room.room_id = meeting.room_id
              GROUP BY room.room_id
              ORDER BY total_bookings DESC";
    $result = mysqli_query($connection, $query);

    $statistics = [];
    while ($row = $result->fetch_assoc()) {
        $statistics[] = $row;
    }
    return $statistics;
}


function displayRoomUsageStatistics()
{
    $statistics = getRoomUsageStatistics();

    echo "<h2>Rumsanvändning</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Rum</th>";
    echo "<th>Antal bokningar</th>";
    echo "</tr>";

    foreach ($statistics as $stat) {
        echo "<tr>";
        echo "<td>Rum {$stat['room_id']}</td>";
        echo "<td>{$stat['total_bookings']}</td>";
        echo "</tr>";
    }

    echo "</table>";
}
