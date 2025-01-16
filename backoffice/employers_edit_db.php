<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_user'])) {
    // var_dump($_POST);
    // exit;
    $user_id = (int) $_POST['user_id'];
    $contact_name = $_POST['contact_name'];
    $email = $_POST['email'];
    $company_name = $_POST['company_name'];
    $business_type = (int) $_POST['business_type'];
    $company_address = $_POST['company_address'];
    $province = $_POST['province'];
    $amphure = $_POST['amphure'];
    $tambon = $_POST['tambon'];
    $zipcode = $_POST['zipcode'];
    $company_tel = $_POST['company_tel'];

    $query = "UPDATE users
            SET company_name = ?,
                business_type = ?,
                contact_name = ?,
                company_address = ?,
                province = ?,
                amphure = ?,
                tambon = ?,
                zipcode = ?,
                company_tel = ?,
                email = ?
            WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // ผูกค่าตัวแปร
        mysqli_stmt_bind_param($stmt, "sissssssssi", $company_name, $business_type, $contact_name, $company_address, $province, $amphure, $tambon, $zipcode, $company_tel, $email, $user_id);

        // ทำการอัพเดต
        if (mysqli_stmt_execute($stmt)) {
            header('Location: employers.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}
