<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room view</title>
</head>

<body>
    <link rel="stylesheet" href="project.css" />
    <nav class="navbar">
        <div class="logo">Octpous booking</div>
        <ul class="nav-links">
            <div class="menu">

            </div>
        </ul>
    </nav>
    <div class="room-view" name="room-view">

        <?php require_once('api/generate_table.php');
        $date = "2023-04-28";
        $roomNumber = 1;
        echo $date, $roomNumber;
        ?>

        <table id="roomViewTable">
            <tbody>
                <?php generate_room_table($roomNumber, $date); ?>
            </tbody>
        </table>
    </div>
    <script src="booking.js"></script>
</body>

</html>