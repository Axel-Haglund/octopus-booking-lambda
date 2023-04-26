<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <link rel="stylesheet" href="project.css" />
  <nav class="navbar">
    <div class="logo">Octpous booking</div>
    <ul class="nav-links">
      <div class="menu">
        <li><a href="admin.html">Min sida</a></li>
        <li><a href="/">Hantera bokningar</a></li>
        <li><a href="index.php">Logga ut</a></li>
      </div>
    </ul>
  </nav>


  <button id="selected-date"></button>

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
            dateCell.innerHTML = `<button class="day-of-month">${date}</button>`;
            date++;
            dateCell.querySelector("button").addEventListener("click", () => {
              // uppdatera tabellen till korrekt dag
              let selectedDate = dateCell.querySelector("button").innerText;
              const selectedMonth = currentMonthIndex + 1;
              const selectedYear = currentYear;
              let dateString = `${selectedYear}-${selectedMonth}-${selectedDate}`;
              selectedDate = dateString;
              document.getElementById("selected-date").innerText = selectedDate;

              console.log(selectedDay);
            });
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
    <?php require_once('api/generate_table.php') ?>
    <table id="myTable">
      <tbody>
        <?php generate_table(); ?>
      </tbody>
    </table>
  </div>

  <form> <button id="submitBookingButton" type="submit">
      Submit
    </button>
  </form>


  <script src="booking.js">
  </script>
</body>

</html>