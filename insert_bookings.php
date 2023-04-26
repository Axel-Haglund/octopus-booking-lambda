<?php
require("db-connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $bookings = json_decode($json, true);
    foreach ($bookings as $booking) {

        echo  var_dump($booking);
        $date = $_SESSION["selectedDate"];
        $user_id = $_SESSION["loggedInMember"]["user_id"];
        $query = "INSERT INTO meeting (room_id, user_id, hour, date) Values ('{$booking["room"]}','{$user_id}','{$booking["hour"]}', '{$date}');";
        // echo $query;
        mysqli_query($connection, $query);
    }
    echo 'Data received successfully';
}

// insert bookings i databasen