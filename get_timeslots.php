<?php
$host = 'localhost';
$dbname = 'doctors';
$user = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
$doctorId = $_GET['doctorId'];
$stmt = $pdo->prepare("SELECT inter FROM availability WHERE sno = :doctorId");
$stmt->bindParam(':doctorId', $doctorId, PDO::PARAM_STR);
$stmt->execute();
$timeSlots = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $interval = $row['inter'];
    $timeSlots[] = $interval;
}
header('Content-Type: application/json');
echo json_encode($timeSlots);
?>
