<?php
session_start();
include('../condb.php');

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
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
    <title>Admin login</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .kanit-font {
            font-family: "Kanit", sans-serif !important;
        }

        .nunito-font {
            font-family: "Nunito", sans-serif !important;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card col-lg-5 col-md-10 col-sm-10 col-10" style="border-radius: 20px; height: 50%;">
            <div class="card-body d-flex justify-content-center align-items-center">
                <form action="login_db.php" method="post" class="col-12">
                    <div class="container text-center">
                        <label class="fs-1 fw-bold">Login</label>
                    </div>
                    <div class="container my-3">
                        <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="container my-3">
                        <label for="password" class="fs-5 fw-bolder" style="color: #64748b;">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="container my-3">
                        <button type="submit" name="login" class="btn btn-primary container fw-bold">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/lang_change.js"></script>
</body>

</html>