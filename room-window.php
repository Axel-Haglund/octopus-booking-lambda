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
    <link rel="stylesheet" href="roomvy-style.css" />
    <nav class="navbar">
        <div class="logo">Octpous booking</div>
        <h1> Rum 1 </h1>
        <ul class="nav-links">
            <div class="menu">
            </div>
        </ul>
    </nav>
    <div class="room-view" name="room-view">

        <?php require_once('api/generate_table.php');
        $date = date("Y-m-d");
        $roomNumber = 1;
        echo $date, $roomNumber;
        ?>

        <table id="roomViewTable">
            <tbody>
                <?php generate_room_table($roomNumber, $date); ?>
            </tbody>
        </table>
    </div>

    <div class="confirm-booking">
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
                    echo "<option>" . $row['email'] . "</option>";
                }

                // Close the database connection
                mysqli_close($connection);
                ?>
            </select>
        </div>

        <script>
            var select = document.getElementById('user');
            var selected_email = '';

            select.addEventListener('change', function() {
                selected_email = select.options[select.selectedIndex].value;
                console.log(selected_email);
                $sql = "SELECT user_id FROM user WHERE email = '{selected_email}'";
                $user_id = mysqli_query($connection, $sql);
                LogInRoomMember($user_id);

            });

            function LogInRoomMember() {

                console.log("valid");
                show($_SESSION);
                session_start();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["loggedInMember"] = [
                    "user_id" = $user_id
                ];
            }

            function sendEmails() {
                var message = prompt("Enter your message:");
                if (message && selected_email) {
                    console.log("Sending message: " + message);
                    console.log("To user: " + selected_email);
                    selected_email = '';
                    select.selectedIndex = 0;
                } else if (!selected_email) {
                    alert("Please select a user.");
                }

            }
        </script>

        <form>
            <button class="send-emails-button" onclick="sendEmails(); document.getElementById('submitBookingButton').click();" type="button">
                Bekräfta
            </button>
            <button id="submitBookingButton" class="submit-button" type="submit" style="display:none">

                Submit
            </button>
        </form>

        <script src="booking.js"></script>
    </div>

</body>

</html>