<?php
session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (!isset($_SESSION['admin_id'])) {
    $errors[] = "You must be logged in to post a job.";
}

if (isset($_POST['update_user'])) {
    $user_id = (int) $_POST['user_id'];
    $contact_name = trim($_POST['contact_name']);
    $email = trim($_POST['email']);
    $company_name = trim($_POST['company_name']);
    $business_type = (int) $_POST['business_type'];
    $company_address = trim($_POST['company_address']);
    $province = $_POST['province'];
    $amphure = $_POST['amphure'];
    $tambon = $_POST['tambon'];
    $zipcode = $_POST['zipcode'];
    $company_tel = trim($_POST['company_tel']);

    // ดึงข้อมูลอีเมลและชื่อบริษัทเดิมที่เก็บไว้ในฐานข้อมูล
    $query = "SELECT email, company_name FROM users WHERE user_id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $current_email, $current_company_name);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // เช็คว่ามีการเปลี่ยนแปลงอีเมลหรือชื่อบริษัทหรือไม่
    if ($email === $current_email && $company_name === $current_company_name) {
        // ถ้าไม่มีการเปลี่ยนแปลงข้อมูล
        // ไม่ต้องไปตรวจสอบซ้ำในฐานข้อมูล
    } else {
        // ถ้ามีการเปลี่ยนแปลงข้อมูล ให้ตรวจสอบว่ามีอีเมลหรือชื่อบริษัทซ้ำในฐานข้อมูล
        $user_check_query = "SELECT * FROM users WHERE email = ? OR company_name = ?";
        if ($stmt = mysqli_prepare($conn, $user_check_query)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $company_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['email'] === $email) {
                    $_SESSION['error_email'] = "อีเมลนี้มีอยู่ในระบบแล้ว";
                }
                if ($row['company_name'] === $company_name) {
                    $_SESSION['error_companyname'] = "ชื่อบริษัทนี้มีอยู่ในระบบแล้ว";
                }
                header("Location: employers_edit.php?user_id=" . $row['user_id']);
                exit();
            }
            mysqli_stmt_close($stmt);
        }
    }

    // ทำการอัปเดตข้อมูลในฐานข้อมูล   
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
        mysqli_stmt_bind_param($stmt, "sissssssssi", $company_name, $business_type, $contact_name, $company_address, $province, $amphure, $tambon, $zipcode, $company_tel, $email, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['update_employer'] = 'อัปเดตข้อมูลเรียบร้อยแล้ว';
            header('Location: employers.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}
?>