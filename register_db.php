<?php

session_start();
include('condb.php');

$errors = array();

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
    $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);
    $contactname = mysqli_real_escape_string($conn, $_POST['contactname']);
    $company_address = mysqli_real_escape_string($conn, $_POST['company_address']);
    $province = mysqli_real_escape_string($conn, $_POST['province_name']);
    $amphure = mysqli_real_escape_string($conn, $_POST['amphure_name']);
    $tambon = mysqli_real_escape_string($conn, $_POST['tambon_name']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $company_tel = mysqli_real_escape_string($conn, $_POST['company_tel']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if ($password !== $c_password) {
        $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        header("Location: register.php");
        exit();
    }

    $user_check_query = "SELECT * FROM users WHERE username = ? OR email = ? ";

    if ($stmt = mysqli_prepare($conn, $user_check_query)) {
        if ($stmt === false) {
            array_push($errors, "Error in preparing query: " . mysqli_error($conn));
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['username'] === $username) {
                    array_push($errors, "Username already exists");
                }
                if ($row['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (count($errors) == 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, company_name, business_type, contact_name, company_address, province, amphure, tambon, zipcode, company_tel, email) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // ผูกค่าพารามิเตอร์
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $username, $password, $companyname, $business_type, $contactname, $company_address, $province, $amphure, $tambon, $zipcode, $company_tel, $email);

            // รันคำสั่ง SQL
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "ลงทะเบียนสำเร็จ";
                header("Location: index.php");
            } else {
                $_SESSION['error'] = "เกิดข้อผิดพลาดในการบันทึกข้อมูล";
                header("Location: register.php");
            }

            // ปิด statement
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL";
            header("Location: register.php");
        }
    }
}
