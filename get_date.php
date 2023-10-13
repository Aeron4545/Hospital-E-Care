<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'doctors';
$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}
if (isset($_GET['sno']) && isset($_GET['inter'])) {
    $sno = mysqli_real_escape_string($connection, $_GET['sno']);
    $selectedTimeSlot = mysqli_real_escape_string($connection, $_GET['inter']);
    $query = "SELECT start_date, end_date FROM availability WHERE Sno = '$sno' AND inter = '$selectedTimeSlot'";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $availabilityData = mysqli_fetch_assoc($result);
        mysqli_close($connection);
        header('Content-Type: application/json');
        echo json_encode($availabilityData);
        exit;
    } else {
        if ($result === false) {
            header('HTTP/1.1 500 Internal Server Error');
            echo "Error fetching availability data: " . mysqli_error($connection);
        } else {
            header('HTTP/1.1 404 Not Found');
            echo "No availability data found for the provided sno and inter.";
        }
        exit;
    }
}
header('HTTP/1.1 400 Bad Request');
echo "Missing parameters: sno and/or inter";
exit;
?>
