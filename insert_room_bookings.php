<?php
require("db-connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $json = file_get_contents('php://input');
    var_dump($json);
    $data = json_decode($json, true);
    var_dump($data);

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $bookings = $data["bookings"];
    $user_id = $data["user_id"];
    foreach ($bookings as $booking) {
        $date = $_SESSION["selectedDate"];
        $query = "INSERT INTO meeting (room_id, user_id, hour, date) Values ('{$booking["room"]}','{$user_id}','{$booking["hour"]}', '{$date}');";
        mysqli_query($connection, $query);
    }
    echo 'Booking made successfully. Redirecting in 5 seconds...';
    // header("refresh:5; url=room-window.php");
    exit();
}
