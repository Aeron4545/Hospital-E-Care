<?php
session_start()
?>
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
header {
  background-color:#00cece;
  ;
  padding: 20px;
  color: #f9f8f8;
  width: 100%;
  text-align: center;
}

h1 {
  margin: 0;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin-right: 10px;
}

nav a {
  color: #fff;
  text-decoration: none;
}

nav a:hover {
  text-decoration: underline;
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
        <button onclick="window.location.href='data.php'">Home</button>
        <button onclick="window.location.href='my_bookings.php'">My Bookings</button>
        <button onclick="window.location.href='login.php'">Logout</button>
</div>
  <div class="container my-5">
    <br>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>User Name</th>
            <th>Doctor</th>
            <th>Doctor Id</th>
            <th>Time Slot</th>
            <th>Date</th>
            <th>Cancel</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $servername="localhost";
        $username="root";
        $password="";
        $dbName='doctors';
        
        $conn=new mysqli($servername ,$username,$password,$dbName);
        if($conn->connect_errno){
          echo "connection failed";
          exit();
        }
        if ($stmt = $conn->prepare("SELECT user_name, user_id, doctor, doctor_id, time_slot, date FROM bookings WHERE user_id = ?")) {
            $stmt->bind_param("s", $_SESSION['user_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($rows = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$rows['user_name']}</td>
                        <td>{$rows['user_id']}</td>
                        <td>{$rows['doctor']}</td>
                        <td>{$rows['doctor_id']}</td>
                        <td>{$rows['time_slot']}</td>
                        <td>{$rows['date']}</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='/E Care/my_delete.php?user_id={$rows['user_id']}&doctor_id={$rows['doctor_id']}&time_slot={$rows['time_slot']}&date={$rows['date']}'>Delete</a>
                   </td>
                </tr>
                ";
            }
            $stmt->close();
        }
        $conn->close();
        ?>
        </tbody>
    </table>
  </div>
</body>
</html>