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
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET["sno"]) || !isset($_GET["inter"])) {
            header("location: /E Care/admin1.php");
            exit;
        }
        $sno = $_GET["sno"];
        $inter = $_GET["inter"];
        $sql = "SELECT * FROM availability WHERE Sno='$sno' AND inter='$inter'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location:/E Care/admin1.php");
            exit;
        }
        $sno = $row["Sno"];
        $name = $row["NAME"];
        $inter = $row["inter"];
        $lim = $row["lim"];
        $start_date = $row["start_date"];
        $end_date = $row["end_date"];
    } else {
        $sno = $_POST["sno"];
        $name = $_POST["name"];
        $inter = $_POST["time_slot"];
        $lim = $_POST["patient_limit"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        do {
            if (empty($sno) || empty($name) || empty($inter) || empty($lim) || empty($start_date) || empty($end_date)) {
                $errorMessage = "All fields are required";
                break;
            }
            $sql = "UPDATE availability SET Sno='$sno', NAME='$name', inter='$inter', lim='$lim', start_date='$start_date', end_date='$end_date'
            WHERE Sno='$sno' AND inter='$inter'";

            $result = $conn->query($sql);
            if (!$result) {
                $errorMessage = "Invalid query:" . $conn->error;
                break;
            }

            $successMessage = "Slot Updated Correctly";
            header("location:/E Care/admin1.php");
            exit;
        } while (false);
    }
    ?>
    <div class="container my-5">
        <h2>Update</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";
        }
        ?>
        <form method="post">
            <input type="hidden" name="sno" value="<?php echo $sno; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id_input" value="<?php echo $sno; ?>">
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
                    <input type="text" class="form-control" name="time_slot" value="<?php echo $inter; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="color: white;">Patient Limit</label>
                <div class="col-sm-6">
                    <input type="int" class="form-control" name="patient_limit" value="<?php echo $lim; ?>">
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
                    <a class="btn btn-outline-primary" href="/E Care/admin.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
