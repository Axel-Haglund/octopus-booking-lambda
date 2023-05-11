<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="project.css" />
    <title>Uppdatera register</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo">OctopusBooking</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="admin.php"> Min sida </a></li>
                <li><a href="booking-admin.php">Boka</a></li>
                <li><a href="hantera-bokning.php">Hantera bokningar</a></li>
                <li><a href="api/logout.php"> Logga ut</a></li>
            </div>
        </ul>
    </nav>
    <h1>Uppdatera register</h1>

</html>

<div class="Register_change-container">
    <?php
    // Start session and connect to database
    session_start();
    $connection = mysqli_connect("localhost", "root", "", "big-squid-booking");

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle form submission
    if (isset($_POST['user_id']) && isset($_POST['action'])) {
        $user_id = $_POST['user_id'];
        $action = $_POST['action'];

        // Rest of code
    }

    if (isset($_POST['user_id']) && isset($_POST['action'])) {
        $user_id = $_POST['user_id'];
        $action = $_POST['action'];

        if ($action == 'modify') {
            // Redirect to modify page with user ID
            header("Location: add-member.php?id=$user_id");
            exit;
        } else if ($action == 'delete') {
            // Delete user from database
            $query = "DELETE FROM user WHERE user_id = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
        }
    }


    // Retrieve all users from database
    $query = "SELECT * FROM user";
    $result = mysqli_query($connection, $query);

    // Display users in table
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Password</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
        echo "<button type='submit' name='action' value='modify'>Modify</button>";
        echo "<button type='submit' name='action' value='delete'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>

<div class="addmember-container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ta emot formulärdata
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $action = isset($_POST['action']) ? $_POST['action'] : '';

        if ($action === 'add') {
            // Skapa SQL-insertfrågan
            $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

            // Skicka SQL-insertfrågan till databasen
            if (mysqli_query($connection, $sql)) {
                echo "<script>alert('Användare tillagd.')</script>";
            } else {
                echo "<script>alert('Fel: " . $sql . "<br>" . mysqli_error($connection) . "')</script>";
            }
        }
    }

    ?>

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