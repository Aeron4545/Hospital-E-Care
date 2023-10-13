<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("1.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .table-container {
            overflow: auto;
            max-height: 400px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn-action {
            margin-right: 5px;
        }
        .btn-delete {
            background-color: red;
            color: white;
        }
        .header {
            background-color: #16f5f5;
            padding: 10px;
            color: #fff;
            text-align: right;
        }
        .header button {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }
        .header button:hover {
            background-color: #45a049;
        }
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <button onclick="window.location.href='display_bookings.html'">Bookings</button>
        <button onclick="window.location.href='admin.php'">Doctors</button>
        <button onclick="window.location.href='admin1.php'">Availability</button>
        <button onclick="window.location.href='nurse.php'">Logout</button>
    </div>
    <div class="container my-5">
        <a class="btn btn-primary" href="/E Care/create1.php" role="button">New Time Slot</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Time Slot</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Patient Limit</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = 'doctors';
            
            $conn = new mysqli($servername, $username, $password, $dbName);
            if ($conn->connect_errno) {
                echo "connection failed";
                exit();
            }
            $sql = "SELECT * FROM availability";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query:" . $conn->error);
            }
            while ($rows = $result->fetch_assoc()) {
                echo "
                <tr>
                <td>$rows[Sno]</td>
                <td>$rows[NAME]</td>
                <td>$rows[inter]</td>
                <td>$rows[start_date]</td>
                <td>$rows[end_date]</td>
                <td>$rows[lim]</td>
                <td>
                <a class='btn btn-primary btn-sm' href='/E Care/edit1.php?sno=$rows[Sno]&inter=$rows[inter]'>Edit</a>
                <a class='btn btn-primary btn-sm' href='/E Care/delete1.php?sno=$rows[Sno]&inter=$rows[inter]'>Delete</a>
                </td>
                </tr>
                ";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
