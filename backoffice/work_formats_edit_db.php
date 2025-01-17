<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_work_format'])) {
    $work_formats_id = (int) $_POST['work_formats_id'];
    $work_format_name = $_POST['work_format_name'];

    $query = "UPDATE work_formats
            SET work_format_name = ?
            WHERE work_formats_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $work_format_name, $work_formats_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: work_formats.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}