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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update user in database
    $query = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE user_id = $user_id";
    mysqli_query($connection, $query);

    // Redirect back to user list
    header("Location: test.php");
    exit;
}

// Retrieve user information from database
$user_id = $_GET['id'];
$query = "SELECT * FROM user WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);

// Display form to modify user information
echo "<form method='post'>";
echo "<input type='hidden' name='user_id' value='" . $user['user_id'] . "'>";
echo "<label>First name:</label> <input type='text' name='first_name' value='" . $user['first_name'] . "'><br>";
echo "<label>Last name:</label> <input type='text' name='last_name' value='" . $user['last_name'] . "'><br>";
echo "<label>Email:</label> <input type='text' name='email' value='" . $user['email'] . "'><br>";
echo "<label>Password:</label> <input type='text' name='password' value='" . $user['password'] . "'><br>";
echo "<button type='submit'>Save</button>";
echo "</form>";
