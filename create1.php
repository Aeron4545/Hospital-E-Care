<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = 'doctors';

$conn = new mysqli($servername, $username, $password, $dbName);

$sno = "";
$name = "";
$inter = "";
$lim = "";
$start_date = "";
$end_date = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sno = $_POST["sno"];
    $name = $_POST["name"];
    $inter = $_POST["inter"];
    $lim = $_POST["lim"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    do {
        if (empty($sno) || empty($name) || empty($inter) || empty($lim) || empty($start_date) || empty($end_date)) {
            $errorMessage = "All fields are required";
            break;
        }
        $sql = "INSERT INTO availability(Sno, NAME, inter, lim, start_date, end_date)" .
            "VALUES ('$sno', '$name', '$inter', '$lim', '$start_date', '$end_date')";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query:" . $conn->error;
            break;
        }

        $successMessage = "New Time Slot Added Correctly";
        header("location:/E Care/admin1.php");
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
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2 style="color: white;">New Availability</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sno" value="<?php echo $sno; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Time Slot</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="inter" value="<?php echo $inter; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Patient Limit</label>
                <div class="col-sm-6">
                    <input type="int" class="form-control" name="lim" value="<?php echo $lim; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Start Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">End Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
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
                    <a class="btn btn-outline-primary" href="/E Care/admin1.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
