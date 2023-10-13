<!DOCTYPE html>
<html>
<head>
  <title>Feedback Form</title>
  <link rel="stylesheet" href="styling.css">
  <style>
   body {
    background-image: url("1.jpg");
    background-size: cover; /* Adjust the background size to cover the entire body */
    background-repeat: no-repeat; /* Prevent the background image from repeating */
}
.container {
position: absolute;
top: 200px;
left:500px;
max-width: 500px;
margin: 0 auto;
padding: 20px;
border: 1px solid #ccc;
border-radius: 5px;
background-color: #f9f9f9;
} 
h2 {
 text-align: center;
}
 .form-group {
margin-bottom: 15px;
}
label {
display: block;
margin-bottom: 5px;
}
 input[type="text"],
 input[type="email"],
 textarea {
 width: 450px;
 padding: 10px;
 border: 1px solid #ccc;
border-radius: 5px;
 }
 
 input[type="submit"] {
  display: block;
 width: 100%;
 padding: 10px;
 background-color: #4CAF50;
color: #ffffff;
 border: none;
 border-radius: 5px;
 cursor: pointer;
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
  <div class="container">
    <h2>Feedback Form</h2>
    <form action="fb2.php" method="post" name="feedbackForm">
      <div class="form-group">
        <label for="doctor">Doctor:</label>
        <?php
          $doctorID = $_GET['doctorID'] ?? '';
          $doctorName = $_GET['doctorName'] ?? '';
          $escapedDoctorName = htmlspecialchars($doctorName);
          echo '<input type="text" id="doctor" name="doctor" value="' . $escapedDoctorName . '" required readonly>';
          echo '<input type="hidden" name="doctorID" value="' . htmlspecialchars($doctorID) . '">';
        ?>
      </div>
      <div class="form-group">
        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" rows="5" required></textarea>
      </div>
      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>
