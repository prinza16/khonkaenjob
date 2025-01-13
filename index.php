<?php
session_start();
?>

<?php include('rss_url_connect.php'); ?>
<?php include('condb.php'); ?>
<?php include('h.php'); ?>
<?php include('navbar.php') ?>

<?php
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
?>

<?php if (isset($_SESSION['username'])) { ?>
    <div class="d-flex py-4">
        <div class="col-lg-1 col-md-1 col-sm-1 col-0">
            <p></p>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-12">
            <div class="text-end mb-3">
                <a class="btn btn-primary px-5 py-3 fw-medium" href="job_announcement_form.php" style="font-family: 'Kanit', sans-serif !important; align-content:center;">ลงประกาศรับสมัครงาน</a>
            </div>
            <div class="card border-0">
                <div class="card-body rounded" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                    <form class="d-block" role="search" method="GET">
                        <input class="form-control me-2" type="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search" aria-label="Search">
                        <button class="btn btn-custom-search container-fluid mt-3 fw-bolder" type="submit" style="font-family: 'Nunito', sans-serif !important; align-content:center;">Search</button>
                        <div class="mt-3">
                            <?php
                            foreach ($rss->job as $job) {
                                if ((stripos($job->region, 'Chonburi') !== false) &&
                                    (stripos($job->name, $searchTerm) !== false || stripos($job->company, $searchTerm) !== false)
                                ) {
                                    $jobId = (string) $job->attributes()->id;

                                    echo "
                                        <a href='work_show_rss.php?id=" . urlencode($jobId) . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight-rss row'>
                                            <div class='col-lg-6 col-md-8 col-sm-12 col-12 ps-2'>
                                                <label class='fs-4 fw-normal d-block'>" . htmlspecialchars($job->name) . "</label>
                                                <label class='fs-6 fw-bold d-block cursor-pointer'>" . htmlspecialchars($job->company) . "</label>
                                            </div>
                                            <div class='col-lg-6 col-md-4 col-sm-12 col-12 text-lg-end text-md-end text-sm-start text-start d-flex flex-column justify-content-center px-2'>
                                                <label class='fs-6 fw-semibold d-block'>" . htmlspecialchars($job->jobtype) . "</label>
                                                <label class='d-block fw-bold'>" . htmlspecialchars($job->updated) . "</label>
                                            </div>
                                        </a>
                                    ";
                                }
                            }
                            ?>

                            <?php
                            $query = "SELECT jobs.*,
                           users.company_name,
                           business_types.business_type_name,
                           work_formats.work_format_name, 
                           types_of_work.type_of_work_name,
                           salarys.salary_data
                    FROM ((((jobs
                    INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id)
                    INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id)
                    INNER JOIN salarys ON jobs.salary = salarys.salary_id)
                    INNER JOIN users ON jobs.user_id = users.user_id)
                    INNER JOIN business_types ON users.business_type = business_types.business_type_id
                    WHERE (jobs.job_position LIKE ? OR users.company_name LIKE ?)
                    AND jobs.job_status = 1";
                            if ($stmt = mysqli_prepare($conn, $query)) {
                                $searchParam = "%$searchTerm%";
                                mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "
                                    <a href='work_show.php?job_id=" . $row['job_id'] . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight row'>
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
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-0"> </div>
    </div>
<?php } else {  ?>
    <div class="d-flex py-4">
        <div class="col-lg-1 col-md-1 col-sm-1 col-0">
            <p></p>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-12">
            <div class="text-end mb-3">
                <!-- หากไม่ได้ล็อกอิน ให้ไปหน้า login.php -->
                <a class="btn btn-primary px-5 py-3 fw-medium" href="login.php" style="font-family: 'Kanit', sans-serif !important; align-content:center;">ลงประกาศรับสมัครงาน</a>
            </div>
            <div class="card border-0">
                <div class="card-body rounded" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                    <form class="d-block" role="search" method="GET">
                        <input class="form-control me-2" type="search" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search" aria-label="Search">
                        <button class="btn btn-custom-search container-fluid mt-3 fw-bolder" type="submit" style="font-family: 'Nunito', sans-serif !important; align-content:center;">Search</button>
                        <div class="mt-3">
                            <?php
                            foreach ($rss->job as $job) {
                                if ((stripos($job->region, 'Chonburi') !== false) &&
                                    (stripos($job->name, $searchTerm) !== false || stripos($job->company, $searchTerm) !== false)
                                ) {
                                    $jobId = (string) $job->attributes()->id;

                                    echo "
                                        <a href='work_show_rss.php?id=" . urlencode($jobId) . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight-rss row'>
                                            <div class='col-lg-6 col-md-8 col-sm-12 col-12 ps-2'>
                                                <label class='fs-4 fw-normal d-block'>" . htmlspecialchars($job->name) . "</label>
                                                <label class='fs-6 fw-bold d-block cursor-pointer'>" . htmlspecialchars($job->company) . "</label>
                                            </div>
                                            <div class='col-lg-6 col-md-4 col-sm-12 col-12 text-lg-end text-md-end text-sm-start text-start d-flex flex-column justify-content-center px-2'>
                                                <label class='fs-6 fw-semibold d-block'>" . htmlspecialchars($job->jobtype) . "</label>
                                                <label class='d-block fw-bold'>" . htmlspecialchars($job->updated) . "</label>
                                            </div>
                                        </a>
                                    ";
                                }
                            }
                            ?>

                            <?php
                            $query = "SELECT jobs.*,
                            users.company_name,
                            business_types.business_type_name,
                            work_formats.work_format_name, 
                            types_of_work.type_of_work_name,
                            salarys.salary_data
                     FROM ((((jobs
                     INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id)
                     INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id)
                     INNER JOIN salarys ON jobs.salary = salarys.salary_id)
                     INNER JOIN users ON jobs.user_id = users.user_id)
                     INNER JOIN business_types ON users.business_type = business_types.business_type_id
                     WHERE (jobs.job_position LIKE ? OR users.company_name LIKE ?)
                     AND jobs.job_status = 1";
                            if ($stmt = mysqli_prepare($conn, $query)) {
                                $searchParam = "%$searchTerm%";
                                mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "
                                    <a href='work_show.php?job_id=" . $row['job_id'] . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight row'>
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
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-0"> </div>
    </div>
<?php } ?>

<?php include('footer.php'); ?>