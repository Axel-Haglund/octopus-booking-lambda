<?php
session_start();


$roomNumber = 1;


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
    <link rel="stylesheet" href="roomvy-style.css" />
    <nav class="navbar">
        <div class="logo">Octpous booking</div>
        <h1> Rum <?php echo $roomNumber ?> </h1>
        <ul class="nav-links">
            <div class="menu">
            </div>
        </ul>
    </nav>
    <div class="room-view" name="room-view">

        <?php require_once('api/generate_table.php');
        $date = date("Y-m-d");
        echo $date;
        ?>

        <table id="roomViewTable">
            <tbody>
                <?php generate_room_table($roomNumber, $date); ?>
            </tbody>
        </table>
    </div>

    <div class="confirm-booking">

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selected_email = $_POST['email'];
            echo "You selected email: $selected_email";
        }
        ?>
        <form method="POST" action="insert_room_bookings.php">
            <div class="dropdown-email">
                <label for="Email">Användare:</label>
                <select name="email" id="user">
                    <?php
                    // Connect to the database
                    $connection = mysqli_connect("localhost", "root", "", "big-squid-booking");

                    // Check connection
                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Query the database
                    $sql = "SELECT email FROM user";
                    $result = mysqli_query($connection, $sql);

                    // Loop through the query results and populate the dropdown list
                    while ($row = mysqli_fetch_assoc($result)) {
                        $email = $row['email'];
                        $selected = ($email == $selected_email) ? 'selected' : '';
                        echo "<option value=\"$email\" $selected>$email</option>";
                    }

                    // Close the database connection
                    mysqli_close($connection);
                    ?>
                </select>
            </div>

            <!-- Tells user who made the booking (only applies to booked timeslots ie red cells) -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const bookedCells = document.querySelectorAll(".cell.booked");

                    bookedCells.forEach((cell) => {
                        cell.addEventListener("click", function() {
                            const email = this.getAttribute("data-email");
                            alert(`E-postadress för den som bokat rummet: ${email}`);
                        });
                    });
                });
            </script>

            <input id="submitBookingButton" class="submit-room-button" type="submit" value="Submit">

        </form>

        <script src="booking.js"></script>
    </div>

</body>

</html>