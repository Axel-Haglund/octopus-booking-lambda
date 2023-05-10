<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <?php
  $admin = $_GET["admin"];
  ?>

  <link rel="stylesheet" href="project.css" />
  <nav class="navbar">
    <div class="logo">Octopus booking</div>
    <ul class="nav-links">
      <div class="menu">
        <li><a href="admin.php">Min sida</a></li>
        <li><a href="/">Hantera bokningar</a></li>
        <li><a href="api/logout.php">Logga ut</a></li>
      </div>
    </ul>
  </nav>



  <div class="calender">
    <div class="header">
      <button id="prev" onclick="prevButtonOnClick()">Föregående</button>
      <h1 id="month"></h1>
      <button id="next" onclick="nextButtonOnClick()">Nästa</button>
    </div>
    <table name="calender-table">
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
      <tbody id="calender-body" name="calender-body"></tbody>
    </table>
  </div>

  <!-- script för kalender -->
  <script>
    let selectedDate = "";

    let currentMonthIndex = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    rendercalender();

    function rendercalender() {
      const monthNames = [
        "Januari",
        "Februari",
        "Mars",
        "April",
        "Maj",
        "Juni",
        "Juli",
        "Augusti",
        "September",
        "Oktober",
        "November",
        "December",
      ];

      const currentMonthName = monthNames[currentMonthIndex];

      const daysOfWeek = ["Mån", "Tis", "Ons", "Tor", "Fre", "Lör", "Sön"];

      const daysInMonth = new Date(
        currentYear,
        currentMonthIndex + 1,
        0
      ).getDate();
      const firstDayOfMonth = new Date(
        currentYear,
        currentMonthIndex,
        1
      ).getDay();

      const calenderBody = document.getElementById("calender-body");

      // Ta bort tidigare månaders datum
      calenderBody.innerHTML = "";

      // Skapa månadshuvudet
      const monthHeader = document.getElementById("month");
      monthHeader.innerText = currentMonthName;

      // Skapa datumceller
      let date = 1;
      for (let i = 0; i < 6; i++) {
        const weekRow = document.createElement("tr");

        for (let j = 0; j < 7; j++) {
          const dateCell = document.createElement("td");
          dateCell.classList.add("date-cell");

          if (i === 0 && j < firstDayOfMonth - 1) {
            // Lägg till tomma celler före första dagen i månaden
          } else if (date > daysInMonth) {
            // Lägg till tomma celler efter sista dagen i månaden
          } else {
            // Lägg till datum i cellen
            const selectedMonth = currentMonthIndex + 1;
            const selectedYear = currentYear;
            let dateString = `${selectedYear}-${selectedMonth}-${date}`;
            dateCell.innerHTML = `<a href="?date=${dateString}" class="day-of-month">${date}</a>`;
            date++;

          }

          weekRow.appendChild(dateCell);
        }

        calenderBody.appendChild(weekRow);
      }
    }

    function nextButtonOnClick() {
      currentMonthIndex++;
      if (currentMonthIndex > 11) {
        currentMonthIndex = 0;
        currentYear++;
      }
      rendercalender();
    }

    function prevButtonOnClick() {
      currentMonthIndex--;
      if (currentMonthIndex < 0) {
        currentMonthIndex = 11;
        currentYear--;
      }
      rendercalender();
    }
  </script>

  <div class="table-2" name="room">
    <?php require_once('api/generate_table.php');

    // Define the text and variable
    $text = "boknings tabell";
    $date = $_GET["date"];
    $currentday = date("Y-m-d");

    // Output the text and variable above the table
    if (!$date) {
      echo '<p>' . $text . ' ' . $currentday . '</p>';
    } else {
      echo '<p>' . $text . ' ' . $date . '</p>';
    }

    ?>

    <table id="myTable">
      <tbody>
        <?php generate_table($_GET["date"], $_GET["today"]); ?>
      </tbody>
    </table>
  </div>

  <div class="invite-user">
    <h1>Bjud in kollegor</h1>

    <div class="dropdown-email">
      <label for="Email">Välj kollegor:</label>

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
      var selected_users = [];

      select.addEventListener('change', function() {
        var selected_email = select.options[select.selectedIndex].value;
        selected_users.push(selected_email);
        console.log(selected_users);
        updateSelectedUsersList();
      });

      function updateSelectedUsersList() {
        var selectedUsersDiv = document.querySelector('.selected-users');
        selectedUsersDiv.innerHTML = '';

        var participant;

        for (var i = 0; i < selected_users.length; i++) {
          var email = selected_users[i];
          participant = participant + "," + email;
          var li = document.createElement('li');
          li.innerText = email;
          var deleteBtn = document.createElement('button');
          deleteBtn.innerText = 'Delete';
          deleteBtn.dataset.index = i; // add index as data attribute
          deleteBtn.addEventListener('click', function(e) {
            var index = e.target.dataset.index; // retrieve index from clicked button
            selected_users.splice(index, 1);
            updateSelectedUsersList();
          });
          li.appendChild(deleteBtn);
          selectedUsersDiv.appendChild(li);
        }
      }

      function sendEmails() {
        var message = prompt("Enter your message:");
        if (message) {
          console.log("Sending message: " + message);
          console.log("To users: " + selected_users.join(", "));
          alert("Your message has been sent!");
          selected_users = [];
          updateSelectedUsersList();
        } else {
          alert("Please enter a message.");
        }
      }
    </script>

    <div class="selected-users"></div>

    <form>
      <button class="send-emails-button" onclick="sendEmails(); document.getElementById('submitBookingButton').click();" type="button">
        Bekräfta
      </button>
      <button id="submitBookingButton" class="submit-button" type="submit" style="display:none">
        Submit
      </button>
    </form>

    <script src="booking.js"></script>
</body </html>