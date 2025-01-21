<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>
<?php 
    include('../condb.php');
    $query = "SELECT COUNT(*) AS job_count FROM jobs WHERE job_status = 2";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $job_count = $row['job_count'];
?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include('./sidebarmenu.php') ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                    
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light text-dark mb-4">
                                <p class="card-title d-flex justify-content-center align-middle pt-4 pb-3"><label class="fw-bolder">จำนวนผู้ขออนุมัติประกาศงาน</label></p>
                                <hr class="p-0 m-0">
                                <div class="card-body row p-1">
                                    <div class="col-xl-6 d-flex justify-content-center align-middle">
                                        <label class="fs-1"><i class="fa-solid fa-user"></i></label>
                                    </div>
                                    <div class="col-xl-6 d-flex justify-content-center align-middle">
                                        <label class="fs-1 fw-bold"><?php echo $job_count; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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
<?php include('footer.php'); ?>