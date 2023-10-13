<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctors";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function validateInput($input) {
    return htmlspecialchars(trim($input));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = isset($_POST['Name']) ? validateInput($_POST['Name']) : '';
    $DOB = isset($_POST['DOB']) ? $_POST['DOB'] : '';
    $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
    $Email = isset($_POST['Email']) ? validateInput($_POST['Email']) : '';
    $PhoneNumber = isset($_POST['PhoneNumber']) ? validateInput($_POST['PhoneNumber']) : '';
    $Address = isset($_POST['Address']) ? validateInput($_POST['Address']) : '';
    $Pincode = isset($_POST['Pincode']) ? validateInput($_POST['Pincode']) : '';
    $Password = isset($_POST['Password']) ? validateInput($_POST['Password']) : '';
    if ($Name && $DOB && $Gender && $Email && $PhoneNumber && $Address && $Pincode && $Password) {
        $sql = "INSERT INTO login (Name, DOB, Gender, Email, PhoneNumber, Address, Pincode, Password) 
                VALUES ('$Name', '$DOB', '$Gender', '$Email', '$PhoneNumber', '$Address', '$Pincode', '$Password')";
        if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Signup Successful');</script>";
          header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill all required fields.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="signup.css" />
  <title>Signup Page</title>
  <style type="text/css">
    body {
    background-image: url("1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
}
  </style>
</head>
<body>
<h2 style="color: white;">Signup</h2>
  <form action="signup.php" method="POST">
    <label for="Name">Name:</label>
    <input type="text" id="Name" Name="Name" required><br><br>
    
    <label for="DOB">Date of Birth:</label>
    <input type="date" id="DOB" name="DOB" required><br><br>
    <label for="Gender">Gender:</label>
    <select id="Gender" name="Gender" required>
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select><br><br>
    <label for="Email">Email:</label>
    <input type="email" id="email" name="Email" required><br><br>
    
    <label for="PhoneNumber">Phone Number:</label>
    <input type="tel" id="PhoneNumber" name="PhoneNumber" required><br><br>
    
    <label for="Address">Address:</label>
    <input type="text" id="address" name="Address" required><br><br>
    
    <label for="Pincode">Pincode:</label>
    <input type="text" id="Pincode" name="Pincode" required><br><br>
    
    <label for="Password">Password:</label>
    <input type="Password" id="Password" name="Password" required><br><br>
    <input type="submit" value="Sign Up">
  </form>
</body>
</html>
