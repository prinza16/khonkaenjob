<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_job_status'])) {
    $jobstatus_id = (int) $_POST['jobstatus_id'];
    $jobstatus_name = $_POST['jobstatus_name'];

    $query = "UPDATE job_status
            SET jobstatus_name = ?
            WHERE jobstatus_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $jobstatus_name, $jobstatus_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['update_jobstatus'] = 'อัปเดตข้อมูลเรียบร้อยแล้ว';
            header('Location: job_status.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}