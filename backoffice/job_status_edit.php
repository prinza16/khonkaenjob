<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>
<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['job_status_id'])) {
    $jobstatus_id = $_GET['job_status_id'];

    $query = "SELECT * FROM job_status WHERE jobstatus_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $jobstatus_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $jobstatus_name = $row['jobstatus_name'];
        } else {
            echo "ไม่พบข้อมูลผู้ใช้";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Job status</label>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="types_of_work.php">Job status</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Job status edit</li>
                </ol>
                <hr>
                <form method="post" action="job_status_edit_db.php" enctype="multipart/form-data" class="height-content-profile_account">
                    <input type="hidden" name="jobstatus_id" value="<?php echo $jobstatus_id; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="jobstatus_name" class="fs-5 fw-normal" style="color: #64748b;">ชื่อสถานะ</label>
                            <input type="text" name="jobstatus_name" class="form-control" value="<?php echo $jobstatus_name ?>">
                        </div>
                        <div class="col-12 mt-4">
                            <button name="update_job_status" class="btn btn-lg btn-primary me-2 fw-medium" type="submit" style="font-family: 'Kanit', sans-serif !important;">บันทึก</button>
                            <button class="btn btn-lg btn-light fw-medium" style="color: #334155;font-family: 'Kanit', sans-serif !important;" type="button" onclick="window.history.back()">ยกเลิก</button>
                        </div>
                    </div>
                </form>
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
