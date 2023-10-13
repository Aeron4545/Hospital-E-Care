<?php
session_start();

if (isset($_GET['user_id'], $_GET['doctor_id'], $_GET['time_slot'], $_GET['date'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = 'doctors';

    $conn = new mysqli($servername, $username, $password, $dbName);
    if ($conn->connect_errno) {
        echo "Connection failed";
        exit();
    }

    // Sanitize the inputs
    $user_id = $_GET['user_id'];
    $doctor_id = $_GET['doctor_id'];
    $time_slot = $_GET['time_slot'];
    $date = $_GET['date'];

    // Use a prepared statement to delete the booking based on parameters
    if ($stmt = $conn->prepare("DELETE FROM bookings WHERE user_id = ? AND doctor_id = ? AND time_slot = ? AND date = ?")) {
        $stmt->bind_param("ssss", $user_id, $doctor_id, $time_slot, $date);

        if ($stmt->execute()) {
            echo "<script>alert('Booking Cancelled');</script>";
            header("Location: my_bookings.php"); // Redirect to the bookings page
            exit();
        } else {
            echo "Error deleting booking: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid parameters.";
}
?>
