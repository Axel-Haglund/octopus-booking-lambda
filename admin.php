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
        <li><a href="booking.php">Boka</a></li>
        <li><a href="/">Hantera bokningar</a></li>
        <li><a href="index.php">Logga ut</a></li>
      </div>
    </ul>
  </nav>
  <div>
    <h1>Välkommen!</h1>
  </div>
</body>

</html>

<div class="calender">
  <div class="header">
    <button id="prev">Föregående</button>
    <h1 id="month"></h1>
    <button id="next">Nästa</button>
  </div>
  <table>
    <thead>
      <tr>
        <th>Mån</th>
        <th>Tis</th>
        <th>Ons</th>
        <th>Tor</th>
        <th>Fre</th>
        <th>Lör</th>
        <th>Sön</th>
      </tr>
    </thead>
    <tbody id="calender-body"></tbody>
  </table>
</div>
<div class="booking-list">
  <?php
  $connection = mysqli_connect("localhost", "root", "", "big-squid-booking");
  $user_id = $_SESSION["loggedInMember"]["user_id"];

  $sql = "SELECT room_id, hour, date FROM meeting WHERE user_id = '{$user_id}';";
  $result = mysqli_query($connection, $sql);

  // Loop through the query results and populate the dropdown list
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<option>"  . $row['room_id'] . ", " . $row['date'] . ", " . $row['hour'] . "</option>";
  }
  ?>
  <script>
    deleteBooking();

    function deleteBooking() {

    }
  </script>
</div>