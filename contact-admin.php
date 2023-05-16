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
    <link rel="stylesheet" href="project.css" />
    <nav class="navbar">
        <div class="logo">OctopusBooking</div>
        <ul class="nav-links">
            <div class="menu">
                <li><a href="member.php">Min sida</a></li>
                <li><a href="booking-member.php">Boka</a></li>
                <li><a href="api/logout.php">Logga ut</a></li>
            </div>
        </ul>
    </nav>

    <div class="container">
        <h2>Problem med bokningsystemet?</h2>
        <form action="send-email.php" class="form" id="contact" method="post">
            Fyll i följande uppgifter så kontaktar vi dig som sanbbt som möjligt.
            <label class="form-item" for="name" id="name-label">Namn <span class="red-text"> *</span></label>
            <input class="form-item" type="text" name="name" id="name" required />

            <label class="form-item" for="email">Mejladress <span class="red-text"> *</span></label>
            <input class="form-item" type="email" name="email" id="email" required />

            <label for="description">Beskriv ditt problem <span class="red-text"> *</span></label>
            <textarea class="form-item" name="description" id="description" cols="30" rows="10"></textarea>

            <br>

            <button>Skicka</button>

        </form>
    </div>

</html>