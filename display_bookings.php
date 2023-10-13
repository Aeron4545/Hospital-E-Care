<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$doctorId = $_GET['doctor_id'];
$date = $_GET['date'];
$sql = "SELECT * FROM bookings";
if (!empty($doctorId)) {
  $sql .= " WHERE doctor_id = '$doctorId'";
}
if (!empty($date)) {
  $sql .= (!empty($doctorId)) ? " AND date = '$date'" : " WHERE date = '$date'";
}
$result = $conn->query($sql);
$bookings = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
  }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($bookings);
?>
