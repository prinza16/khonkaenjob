<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_type_of_work'])) {
    $types_of_work_id = (int) $_POST['types_of_work_id'];
    $type_of_work_name = $_POST['type_of_work_name'];

    $query = "UPDATE types_of_work
            SET type_of_work_name = ?
            WHERE types_of_work_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $type_of_work_name, $types_of_work_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: types_of_work.php');
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}