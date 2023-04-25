<!DOCTYPE html>
<html lang="se">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Email users</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
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

        for (var i = 0; i < selected_users.length; i++) {
          var email = selected_users[i];
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

    <button onclick="sendEmails()">Send</button>
  </div>

</body>

</html>