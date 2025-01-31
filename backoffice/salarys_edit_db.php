<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_salary_data'])) {
    $salary_id = (int) $_POST['salary_id'];
    $salary_data = $_POST['salary_data'];

    $query = "UPDATE salarys
            SET salary_data = ?
            WHERE salary_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $salary_data, $salary_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['update_salary'] = 'อัปเดตข้อมูลเรียบร้อยแล้ว';
            header('Location: salarys.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}