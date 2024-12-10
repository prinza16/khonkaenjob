<?php 

    session_start();
    include('condb.php');

    $errors = array();

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                $_SESSION['fullname'] = $user['fullname'];

                if ($_SESSION['role'] == 'admin') {
                    header("Location: backoffice/index.php");
                } else {
                    header('Location: index.php');
                }
                exit();
            } else {
                array_push($errors, "Wrong username/password combination");
                $_SESSION['error'] = "Wrong username or password try again!";
                header("location: login.php");
            }
        }
    }

?>