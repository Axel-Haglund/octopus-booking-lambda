<?php

function remove_booking($booking_id)
{
    // Create a connection to the database
    $conn = new mysqli("localhost", "root", "", "big-squid-booking");

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct the SQL DELETE query
    $sql = "DELETE FROM bookings WHERE id = $booking_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Booking with ID $booking_id has been removed from the database.";
    } else {
        echo "Error removing booking: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
