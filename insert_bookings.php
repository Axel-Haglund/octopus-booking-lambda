<?php
require("db-connection.php");
session_start();

if ($_SESSION["isLoggedIn"] == false) {
    insertLoggedIn();
} else {
    insertRoom();
}

function insertLoggedIn()
{
    require("db-connection.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo $_POST["email"];

        $json = file_get_contents('php://input');
        $bookings = json_decode($json, true);
        foreach ($bookings as $booking) {

            echo  var_dump($booking);
            $date = $_SESSION["selectedDate"];
            $user_id = $_SESSION["loggedInMember"]["user_id"];
            $query = "INSERT INTO meeting (room_id, user_id, hour, date) Values ('{$booking["room"]}','{$user_id}','{$booking["hour"]}', '{$date}');";
            echo $query;
            mysqli_query($connection, $query);
        }
        echo 'Data received successfully';
    }
}

function insertRoom()
{
    require("db-connection.php");
    session_start();

    // Kolla upp vilket id som hör till email adressen :)
    $email = $_POST["email"];

    $query = "SELECT 'user_id' FROM 'user' WHERE 'email' = '{$email};";
    echo $query;
    // $user_id = mysqli_query($connection, $query);

    $user_id = 1;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        echo $_POST["email"];

        $json = file_get_contents('php://input');
        $bookings = json_decode($json, true);
        foreach ($bookings as $booking) {

            echo  var_dump($booking);
            $date = $_SESSION["selectedDate"];
            $query = "INSERT INTO meeting (room_id, user_id, hour, date) Values ('{$booking["room"]}','{$user_id}','{$booking["hour"]}', '{$date}');";
            echo $query;
            mysqli_query($connection, $query);
        }
        echo 'Data received successfully';
    }
}
