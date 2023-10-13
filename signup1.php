<!DOCTYPE html>
<html>
<head>
  <title>Image Test</title>
</head>
<body>
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
  $sql = "SELECT * FROM doc where department='Cardiology' and availability='A'";
  $result = $conn->query($sql);
  $total = mysqli_num_rows($result);
  $rows = $result->fetch_assoc();
  $photoBlob = $rows['photo']; // Assuming 'photo' contains the picture in blob format
  $photoBase64 = base64_encode($photoBlob);
  $photoDataUrl = "data:image/jpeg;base64,{$photoBase64}";
  ?>
  <script>
    alert($rows['Description']);
    </script>
  <img src="<?php echo $photoDataUrl; ?>" alt="Test Image">
</body>
</html>
