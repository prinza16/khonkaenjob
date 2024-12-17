<?php

session_start();
include('condb.php');

$errors = array();

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $profile_image = mysqli_real_escape_string($conn, $_POST['profile_image']);

    if ($password != $c_password) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' ";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($result['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $logo_temp_name = $_FILES['profile_image']['tmp_name'];
        $logo_name = $_FILES['profile_image']['name'];
        $logo_size = $_FILES['profile_image']['size'];
        $logo_type = $_FILES['profile_image']['type'];

        $target_dir = "profile/";
        $target_file = $target_dir . basename($logo_name);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($logo_temp_name, $target_file)) {
                $profile_image = $target_file;
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $errors[] = "No file was uploaded or there was an error.";
    }

    if (count($errors) == 0) {
        $password = md5($password);

        $sql = "INSERT INTO users (username, fullname, email, password, role, image_profile) VALUES ('$username', '$fullname', '$email', '$password', 'user', '$profile_image')";
        mysqli_query($conn, $sql);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}
