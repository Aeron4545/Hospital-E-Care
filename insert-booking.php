<?php
$data = json_decode(file_get_contents('php://input'), true);
$doctor = $data['doctor'];
$timeSlot = $data['timeSlot'];
$date = $data['date'];
$user_name = $data['user_name'];
$user_id = $data['user_id'];
$doctor_id=$data['doctor_id'];
$department=$data['department'];

$currentDate = date('Y-m-d');
if ($date < $currentDate) {
    echo 'Cannot book for a date that has already passed.';
    exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM bookings WHERE user_id = ? AND doctor_id = ? AND date = ?");
$stmt->bind_param("sss", $user_id, $doctor_id, $date);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];
if ($count > 0) {
    echo 'You have already made a booking for this day with the same doctor.';
    exit;
}
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM bookings WHERE doctor_id = ? AND time_slot = ? AND date = ?");
$stmt->bind_param("sss", $doctor_id, $timeSlot, $date);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $row['count'];
$stmt = $conn->prepare("SELECT lim FROM availability WHERE Sno = ? AND inter = ?");
$stmt->bind_param("ss", $doctor_id, $timeSlot);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$limit = $row['lim'];
if ($count >= $limit) {
    echo 'Booking limit for this time slot has been reached. Please select another time slot.';
    exit;
}
$stmt = $conn->prepare("INSERT INTO bookings (user_name, user_id,doctor_id,doctor,department, time_slot, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss",$user_name, $user_id, $doctor_id, $doctor,$department, $timeSlot, $date);
if ($stmt->execute()) {
    echo 'Booking submitted successfully.';
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>