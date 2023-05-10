<?php
require("db-connection.php");
session_start();

if ($_SESSION["isLoggedIn"]) {
    $sender = $_SESSION["loggedInMember"]["email"];
    insertLoggedIn($sender);
} else {
    insertRoom();
}

function insertLoggedIn($sender)
{
    require("db-connection.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $participant = $_GET["participant"];
        echo "participant are: " . $participant;
        $json = file_get_contents('php://input');
        $bookings = json_decode($json, true);


        //query, insert participants
        $query = "INSERT INTO participant (sender, receiver) Values ('{$sender}','{$participant}');";
        mysqli_query($connection, $query);

        // hämta ut id av den som skapades
        $participant_id = mysqli_insert_id($connection);

        foreach ($bookings as $booking) {

            echo  var_dump($booking);
            $date = $_SESSION["selectedDate"];
            $user_id = $_SESSION["loggedInMember"]["user_id"];

            $query = "INSERT INTO meeting (room_id, user_id, participant_id, hour, date) Values ('{$booking["room"]}','{$user_id}','{$participant_id}','{$booking["hour"]}','{$date}');";
            // insert the participants aswell
            echo $query;
            mysqli_query($connection, $query);
        }
        echo 'Data received successfully';
    }
}

function insertRoom()
{
    require("db-connection.php");

    // Kolla upp vilket id som hör till email adressen :)
    $email = $_GET["email"];

    $query = "SELECT user_id FROM user WHERE email ='{$email}';";
    echo $query;
    $result = mysqli_query($connection, $query);
    $user_id = mysqli_fetch_assoc($result)["user_id"];
    echo $user_id;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
