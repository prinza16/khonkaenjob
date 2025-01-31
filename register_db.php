<?php

session_name('user_session');
session_start();
include('condb.php');

$errors = array();

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $companyname = mysqli_real_escape_string($conn, trim($_POST['companyname']));
    $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);
    $contactname = mysqli_real_escape_string($conn, trim($_POST['contactname']));
    $company_address = mysqli_real_escape_string($conn, trim($_POST['company_address']));
    $province = mysqli_real_escape_string($conn, trim($_POST['province_name']));
    $amphure = mysqli_real_escape_string($conn, trim($_POST['amphure_name']));
    $tambon = mysqli_real_escape_string($conn, trim($_POST['tambon_name']));
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $company_tel = mysqli_real_escape_string($conn, $_POST['company_tel']);
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));

    // เช็คว่า password กับ confirm password ตรงกันหรือไม่
    if ($password !== $c_password) {
        $_SESSION['error_password'] = "รหัสผ่านไม่ตรงกัน";
        header("Location: register.php");
        exit();
    }

    // ตรวจสอบว่า username หรือ email ซ้ำในฐานข้อมูลหรือไม่
    $user_check_query = "SELECT * FROM users WHERE username = ? OR email = ? OR company_name = ?";
    if ($stmt = mysqli_prepare($conn, $user_check_query)) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $companyname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['username'] === $username) {
                $_SESSION['error_username'] = "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว";
            }
            if ($row['email'] === $email) {
                $_SESSION['error_email'] = "อีเมลนี้มีอยู่ในระบบแล้ว";
            }
            if ($row['company_name'] === $companyname) {
                $_SESSION['error_companyname'] = "ชื่อบริษัทนี้นี้มีอยู่ในระบบแล้ว";
            }
            header("Location: register.php");
            exit();
        }
        mysqli_stmt_close($stmt);
    }


    if (count($errors) == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, company_name, business_type, contact_name, company_address, province, amphure, tambon, zipcode, company_tel, email) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $username, $password, $companyname, $business_type, $contactname, $company_address, $province, $amphure, $tambon, $zipcode, $company_tel, $email);

            if (mysqli_stmt_execute($stmt)) {
                $user_id = mysqli_insert_id($conn);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['contact_name'] = $contactname;

                $_SESSION['success'] = "ลงทะเบียนสำเร็จ";
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
                header("Location: register.php");
                exit();
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
            header("Location: register.php");
        }
    }
}
