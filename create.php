<?php

$servername="localhost";
$username="root";
$password="";
$dbName='doctors';

$conn=new mysqli($servername ,$username,$password,$dbName);


$sno="";
$name="";
$department="";
$experience="";
$gender="";
$price="";
$availability="";
$description="";
$photo = "";

$errorMessage="";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sno=$_POST["sno"];
    $name=$_POST["name"];
    $department=$_POST["department"];
    $experience=$_POST["experience"];
    $gender=$_POST["gender"];
    $price=$_POST["price"];
    $availability=$_POST["availability"];
    $description=$_POST["description"];

if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) 
    if ($_FILES['photo']['error'] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
         // Check if the uploaded file is an image
         $check = getimagesize($_FILES["photo"]["tmp_name"]);
         if ($check !== false) {
             // Generate a unique filename for the image
             $photo = uniqid() . "." . $imageFileType;
 
             // Move the uploaded file to the "uploads" folder
             if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetDir . $photo)) {
                 // Image upload successful
             } else {
                 $errorMessage = "Failed to upload the image.";
             }
         } else {
             $errorMessage = "Invalid image file.";
         }
     }
 
    do{
        if(empty($sno)||empty($name)||empty($department)||empty($experience)||empty($gender)||empty($price)||empty($availability)||empty($description)){
            $errorMessage="All fields are required";
            break;
        }
        $sql = "INSERT INTO doc(sno,NAME,department,experience,gender,price,availability,Description,photo) " .
            "VALUES ('$sno','$name','$department','$experience','$gender','$price','$availability','$description','$photo')";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query:" . $conn->error;
            break;
        }

        $successMessage = "Doctor added correctly";
        header("location:/E Care/admin.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      body {
    background-image: url("1.jpg");
    background-size: cover; /* Adjust the background size to cover the entire body */
    background-repeat: no-repeat; /* Prevent the background image from repeating */
}
</style>
</head>
<body>
    <div class="container my-5">
        <h2 style="color: white;">New Doctor</h2>
        <?php
        
        if(!empty($errorMessage)){
            echo "<div class='alert alert-warning-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";
        }
        ?>


        <form method="post" enctype="multipart/form-data">
           <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sno" value="<?php echo $sno;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="department" value="<?php echo $department;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Experience</label>
                <div class="col-sm-6">
                    <input type="int" class="form-control" name="experience" value="<?php echo $experience;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Gender</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="gender" value="<?php echo $gender;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Price</label>
                <div class="col-sm-6">
                    <input type="int" class="form-control" name="price" value="<?php echo $price;?>">
                </div>
            </div>
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label" style="color: white;">Availability</label>
            <div class="col-sm-6">
            <select class="form-select" name="availability" required>
            <option value="Available" <?php echo ($availability === 'Available') ? 'selected' : ''; ?>>Available</option>
            <option value="Leave" <?php echo ($availability === 'Leave') ? 'selected' : ''; ?>>Leave</option>
            </select>
            </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Photo</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="photo" accept="image/*">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "<div class='alert alert-warning-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";

            }
            ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/E Care/admin.php"rol="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    
</body>
</html>