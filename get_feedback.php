<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$doctorName = $_GET['doctor'];
$stmt = $conn->prepare("SELECT feed FROM feedback WHERE doc_name = ?");
$stmt->bind_param("s", $doctorName);
$stmt->execute();
$result = $stmt->get_result();
$feedbackArray = array();
while ($row = $result->fetch_assoc()) {
    $feedbackArray[] = $row['feed'];
}
$feedback = implode("\n", $feedbackArray);
echo $feedback;
$stmt->close();
$conn->close();
