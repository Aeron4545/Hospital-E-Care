<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['doctor'];
    $feedback = $_POST['feedback'];
    $doctorID = $_POST['doctorID']; // Assuming you have the doctor's ID in $_POST['doctorID']

    $stmt = $conn->prepare("INSERT INTO feedback (doctor_id, doc_name, feed) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $doctorID, $name, $feedback);

    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("Location: /E Care/data.php");
    exit();
}
?>
