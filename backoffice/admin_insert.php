<?php
session_name('admin_session');
session_start();

include('../condb.php');


$username = "admin2";
$password = "123456";
$email = "admin2@gmail.com";

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO admins (username, password, email) VALUES (?, ?, ?)";

if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "ผู้ดูแลระบบใหม่ถูกเพิ่มเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL.";
}

mysqli_close($conn);
?>