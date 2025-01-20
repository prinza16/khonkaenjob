<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_business_type'])) {
    $business_type_id = (int) $_POST['business_type_id'];
    $business_type_name = $_POST['business_type_name'];

    $query = "UPDATE business_types
            SET business_type_name = ?
            WHERE business_type_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $business_type_name, $business_type_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: business_type.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> be90c4152549ffaeabecd300948f52670e415214
