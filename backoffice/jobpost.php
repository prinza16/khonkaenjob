<?php
session_start();
include('../condb.php');

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: ../index.php');
}

// รับค่าคำค้นหาจากฟอร์ม (ถ้ามี)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Jobpost - Admin</title>
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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="get">
            <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Search for..." value="<?php echo htmlspecialchars($searchTerm); ?>" />
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include('./sidebarmenu.php') ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Job post</h1>
                    <hr>
                    <?php
                    $query = "SELECT jobs.*,
                    users.company_name,
                    business_types.business_type_name,
                    work_formats.work_format_name, 
                    types_of_work.type_of_work_name,
                    salarys.salary_data
             FROM jobs
             INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id
             INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id
             INNER JOIN salarys ON jobs.salary = salarys.salary_id
             INNER JOIN users ON jobs.user_id = users.user_id
             INNER JOIN business_types ON users.business_type = business_types.business_type_id
             INNER JOIN job_status ON jobs.job_status = job_status.jobstatus_id
             WHERE (jobs.job_position LIKE ? OR users.company_name LIKE ?)
             AND jobs.job_status = 2";

                    if ($stmt = mysqli_prepare($conn, $query)) {
                        $searchParam = "%$searchTerm%";
                        mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
               <a href='work_confirm.php?job_id=" . $row['job_id'] . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight row'>
                   <div class='col-lg-6 col-md-8 col-sm-12 col-12 ps-2'>
                       <label class='fs-4 fw-normal d-block'>" . htmlspecialchars($row['job_position']) . "</label>
                       <label class='fs-6 fw-semibold d-block cursor-pointer'>" . htmlspecialchars($row['company_name']) . "</label>
                   </div>
                   <div class='col-lg-6 col-md-4 col-sm-12 col-12 text-lg-end text-md-end text-sm-start text-start d-flex flex-column justify-content-center px-2'>
                       <label class='fs-6 fw-semibold d-block'>" . htmlspecialchars($row['work_format_name']) . "</label>
                       <label class='d-block fw-bold'>" . htmlspecialchars($row['updated_at']) . "</label>
                   </div>
               </a>
               ";
                            }
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error preparing statement: " . mysqli_error($conn);
                    }
                    ?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/lang_change.js"></script>
</body>

</html>