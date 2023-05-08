<?php
// Start session and connect to database
session_start();
$connection = mysqli_connect("localhost", "root", "", "big-squid-booking");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action == 'modify') {
        // Redirect to modify page with user ID
        header("Location: test2.php?id=$user_id");
        exit;
    } else if ($action == 'delete') {
        // Delete user from database
        $query = "DELETE FROM user WHERE user_id = $user_id";
        mysqli_query($connection, $query);
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
