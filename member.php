<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

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
        <li><a href="booking-member.php">Boka</a></li>
        <li><a href="contact-admin.php">Kontakta Admin</a></li>
        <li><a href="api/logout.php">Logga ut</a></li>
      </div>
    </ul>
  </nav>
  <div>
    <h1>Välkommen!</h1>

  </div>
</body>

</html>



<div class="home-container">
  <h2>Dina kommande bokningar</h2>
  <br />

  <?php
  $connection = mysqli_connect("localhost", "root", "", "big-squid-booking");
  $user_id = $_SESSION["loggedInMember"]["user_id"];

  $sql = "SELECT room_id, hour, date FROM meeting WHERE user_id = '{$user_id}' AND date >= CURDATE();";
  $result = mysqli_query($connection, $sql);

  // Loop through the query results and populate the list with a delete button for each row
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='booking-row'>";
    echo "<span>" . "rum " . $row['room_id'] . ", " . $row['date'] . ", klockan " . $row['hour'] . "</span>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='room' value='" . $row['room_id'] . "'>";
    echo "<input type='hidden' name='hour' value='" . $row['hour'] . "'>";
    echo "<input type='hidden' name='date' value='" . $row['date'] . "'>";
    echo "<input type='submit' name='delete' value='Delete'>";
    echo "</form>";
    echo "</div>";
  }

  // Check if the delete button was clicked and delete the corresponding record
  if (isset($_POST['delete'])) {
    $room_id = $_POST['room'];
    $hour = $_POST['hour'];
    $date = $_POST['date'];
    $query = "DELETE FROM meeting WHERE room_id = '{$room_id}' AND user_id = '{$user_id}' AND hour = '{$hour}' AND date = '{$date}';";
    mysqli_query($connection, $query);

    // echo  $query;
    mysqli_close($connection);

    // Add code to display a success message or redirect to a different page
  }
  ?>

</div>

<div>
  <a href="booking-member.php"> <!-- Lägg till din önskade webbadress här -->
    <button class="bookroom">Boka rum</button>
  </a>

</div>