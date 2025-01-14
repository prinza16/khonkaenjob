<?php
    include('../condb.php'); 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .kanit-font {
            font-family: "Kanit", sans-serif !important;
            color: #64748b;
        }

        .nunito-font {
            font-family: "Nunito", sans-serif !important;
            color: #64748b;
        }

        .custom-class-card-hightlight {
            background: #f8f9fa;
            text-decoration: none;
            color: #334155;
            border: 1px solid #f8f9fa;
        }

        .custom-class-card-hightlight:hover {
            background: #e2e6ea !important;
            color: #334155 !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">