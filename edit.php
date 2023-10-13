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
$errorMessage="";
$successMessage="";
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["sno"])){
        header("location: /E Care/admin.php");
        exit;
    }
    $sno=$_GET["sno"];
    $sql="SELECT * FROM doc WHERE sno='$sno'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();

    if(!$row){
        header("location:/E Care/admin.php");
        exit;
    }
    $sno=$row["sno"];
    $name=$row["NAME"];
    $department=$row["department"];
    $experience=$row["experience"];
    $gender=$row["gender"];
    $price=$row["price"];
    $availability=$row["availability"];
    $description=$row["Description"];
}
else{
    $sno=$_POST["sno"];
    $name=$_POST["name"];
    $department=$_POST["department"];
    $experience=$_POST["experience"];
    $gender=$_POST["gender"];
    $price=$_POST["price"];
    $availability=$_POST["availability"];
    $description=$_POST["description"];
    do{
        if(empty($sno)||empty($name)||empty($department)||empty($experience)||empty($gender)||empty($price)||empty($availability)||empty($description)){
            $errorMessage="All fields are required";
            break;
    }
    $sql = "UPDATE doc SET sno='$sno', NAME='$name', department='$department', experience='$experience', gender='$gender', price='$price', availability='$availability', Description='$description' WHERE sno='$sno'";

    
    $result=$conn->query($sql);
    if(!$result){
    $errorMessage="Invalid query:".$conn->error;
    break;
}
$successMessage="Client Updated Correctly";

        header("location:/E Care/admin.php");
        exit;
}while(false);
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
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
</head>
<body>
    <div class="container my-5">
        <h2>New Doctor</h2>
        <?php
        
        if(!empty($errorMessage)){
            echo "<div class='alert alert-warning-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";
        }
        ?>
        <form method="post">
           <input type="hidden" name="sno" value="<?php echo $sno;?>">
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
            <select class="form-select" name="availability">
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