<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="project.css" />
    <title>Startsida</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo">OctopusBooking</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="admin.php">Min sida</a></li>
                <li><a href="booking-admin.php">Boka</a></li>
                <li> <a href="admin_hantering.php"> Uppdatera register </a> </li>
                <li><a href="login.php">Logga ut</a></li>
            </div>
        </ul>
    </nav>
    <div>
        <h1>Samtliga bokningar</h1>
    </div>
</body>

<h2 class="all-bookings-title">Alla bokningar</h2>
<div class="booking-container">
    <?php
    $connection = mysqli_connect("localhost", "root", "", "big-squid-booking");
    $user_id = $_SESSION["loggedInMember"]["user_id"];

    $sql = "SELECT meeting.room_id, meeting.hour, meeting.date, user.email FROM meeting INNER JOIN user ON meeting.user_id = user.user_id;";
    $result = mysqli_query($connection, $sql);

    // Print the table headers
    echo "<table>";
    echo "<tr><th>Rum</th><th>Datum</th><th>Klockslag</th><th>Email</th><th></th></tr>";

    // Loop through the query results and populate the table rows with a delete button for each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['room_id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['hour'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='room' value='" . $row['room_id'] . "'>";
        echo "<input type='hidden' name='hour' value='" . $row['hour'] . "'>";
        echo "<input type='hidden' name='date' value='" . $row['email'] . "'>";
        echo "<input type='hidden' name='date' value='" . $row['date'] . "'>";
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Check if the delete button was clicked and delete the corresponding record
    if (isset($_POST['delete'])) {
        $room_id = $_POST['room'];
        $hour = $_POST['hour'];
        $date = $_POST['date'];
        $query = "DELETE FROM meeting WHERE room_id = '{$room_id}'  AND hour = '{$hour}' AND date = '{$date}';";
        mysqli_query($connection, $query);
        header("Refresh:0");
        mysqli_close($connection);
    }
    ?>
</div>
<div class="statisticsroom-container">
    <div class="scroll-statisticsroom">
        <?php require_once('api/generate_table.php'); ?>
        <?php displayRoomUsageStatistics(); ?>
    </div>
</div>

</html>