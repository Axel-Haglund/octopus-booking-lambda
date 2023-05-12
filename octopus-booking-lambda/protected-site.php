<?php

session_start();

if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
    echo "Välkommen inloggad invändare  " . $_SESSION["loggedInMember"]["first_name"];
} else {
    header("location: .");
}
