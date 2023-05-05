<?php
echo "hello world \n";


// Get values
$email = $_POST["email"];
$password = $_POST["password"];

// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "big-squid-booking";

$connection = mysqli_connect($hostname, $username, $password, $database);

// Verify member #_#
$query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($connection, $query);
show($result);


$member = mysqli_fetch_assoc($result);

show($member);


// $_POST ['password'] är entered password och 
// member password_hash är lösenordet i databasen
//(password_verify($_POST['password'], $member["password"]))  

if ($_POST['password'] == $member["password"]) {
    echo "valid";
    show($_SESSION);
    session_start();
    $_SESSION["isLoggedIn"] = true;
    $_SESSION["loggedInMember"] = [
        "user_id" => $member["user_id"],
        "first_name" => $member["first_name"],
        "last_name" => $member["last_name"],
        "email" => $member["email"],
        "admin" => $member["admin"]

    ];

    
if ($_SESSION["loggedInMember"]["admin"] == 1) {
    show($_SESSION);
    header("location: ../admin.php");
} else {
    show($_SESSION);
    header("location: ../member.php");
}
} else {
    echo "invalid";
    header("location: ../login.php");
}



function show($variable)
{
    echo "<pre>";
    echo var_dump($variable);
    echo "</pre>";
}
