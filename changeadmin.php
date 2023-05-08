<!DOCTYPE html>
<?php
session_start();
// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "big-squid-booking");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ta emot formulärdata
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $action = $_POST['action'];

    if ($action === 'add') {
        // Skapa SQL-insertfrågan
        $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

        // Skicka SQL-insertfrågan till databasen
        if (mysqli_query($connection, $sql)) {
            echo "Användare tillagd.";
        } else {
            echo "Fel: " . $sql . "<br>" . mysqli_error($connection);
        }
    } elseif ($action === 'update') {
        // Skapa SQL-uppdateringsfrågan
        $sql = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', password='$password' WHERE user_id=$user_id";

        // Skicka SQL-uppdateringsfrågan till databasen
        if (mysqli_query($connection, $sql)) {
            echo "Användare uppdaterad.";
        } else {
            echo "Fel: " . $sql . "<br>" . mysqli_error($connection);
        }
    }
}

// Stäng anslutningen till databasen
mysqli_close($connection);
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="project.css" />
    <title>Uppdatera information</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo">OctopusBooking</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="admin.php"> Min sida </a></li>
                <li><a href="booking-admin.php">Boka</a></li>
                <li><a href="hantera-bokning.php">Hantera bokningar</a></li>
                <li><a href="login.php"> Logga ut</a></li>
            </div>
        </ul>
    </nav>
    <h1>Uppdatera information</h1>

    <div class="addmember-container">
        <h2>Lägg till användare</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="action" value="add">
            <label for="first_name">Förnamn:</label>
            <input type="text" id="first_name" name="first_name" required>
            <br>
            <label for="last_name">Efternamn:</label>
            <input type="text" id="last_name" name="last_name" required>
            <br>
            <label for="email">E-postadress:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Lägg till">
        </form>
    </div>

    <div class="Updatemember-container">
        <h2>Uppdatera användarinformation</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="action" value="update">
            <label for="user_id">Användar-ID:</label>
            <input type="text" id="user_id" name="user_id" required>
            <br>
            <label for="first_name">Förnamn:</label>
            <input type="text" id="first_name" name="first_name" required>
            <br>
            <label for="last_name">Efternamn:</label>
            <input type="text" id="last_name" name="last_name" required>
            <br>
            <label for="email">E-postadress:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Lösenord:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Uppdatera">
        </form>
    </div>

    <div class="addRoom">
        <h2>Lägg till rum</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <input type="submit" value="Lägg till">
        </form>
    </div>

    <div class="uppdateRoom">
        <h2>Uppdatera rum</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <input type="submit" value="Lägg till">
        </form>
    </div>
</body>

</html>