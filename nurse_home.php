<?php

function check_login($con)
{
    if (isset($_SESSION['Username'])) {
        $Username = mysqli_real_escape_string($con, $_SESSION['Username']);
        $query = "SELECT * FROM login WHERE Email = '$Username' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        } else {
            // Handle query error
            die("Failed to fetch user data: " . mysqli_error($con));
        }
    }

    // Redirect to login
    header("Location: nurse.php");
    die;
}