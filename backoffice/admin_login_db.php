<?php

session_name('admin_session');
session_start();
include('../condb.php');

$errors = array();

if (isset($_POST['admin_login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (count($errors) == 0) {
        $query = "SELECT * FROM admins WHERE admin_username = ?";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['admin_password'])) {
                    $_SESSION['admin_id'] = $user['admin_id'];
                    $_SESSION['admin_username'] = $user['admin_username'];

                    header("location: index.php");
                    exit();
                } else {
                    array_push($errors, "Wrong username/password combination");
                    $_SESSION['error'] = "Wrong username or password, please try again!";
                    header("location: admin_login.php");
                }
            } else {
                array_push($errors, "Wrong username/password combination");
                $_SESSION['error'] = "Wrong username or password, please try again!";
                header("location: admin_login.php");
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error in preparing statement.";
        }
    }
}