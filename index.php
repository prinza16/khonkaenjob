<?php
include('rss_url_connect.php');
?>
<?php include('condb.php'); ?>
<?php include('h.php') ?>
<?php include('navbar.php') ?>

<?php if (isset($_SESSION['username'])) : ?>
    <div class="d-flex py-4">
        <div class="col-lg-2">
            <p></p>
        </div>
        <div class="col-lg-8">
            <div class="text-end mb-3">
                <a class="btn btn-primary px-5 py-3 fw-medium" href="job_announcement_form.php" style="font-family: 'Kanit', sans-serif !important; align-content:center;">ลงประกาศรับสมัครงาน</a>
            </div>
            <div class="card border-0">
                <div class="card-body rounded" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                    <form class="d-block" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-custom-search container-fluid mt-3 fw-bolder" type="button" style="font-family: 'Nunito', sans-serif !important; align-content:center;">Search</button>
                        <div class="mt-3">
                            <!-- แสดงข้อมูลจาก RSS -->
                            <?php
                            foreach ($rss->job as $job) {
                                if (stripos($job->region, 'Chonburi') !== false) {
                                    echo "
                                    <a href='" . htmlspecialchars($job->link) . "' target='_blank' class='d-flex rounded p-2 mt-2 cursor-pointer custom-class-card-hightlight-rss'>
                                        <div class='col-6 ps-2'>
                                            <label class='fs-4 fw-normal d-block' >" . htmlspecialchars($job->name) . "</label>
                                            <label class='fs-6 fw-bold d-block cursor-pointer'>" . htmlspecialchars($job->company) . "</label>
                                        </div>
                                        <div class='col-3'>
                                            <label class='fs-6 fw-bold' ></label>
                                        </div>
                                        <div class='col-3 text-end pe-2 d-flex flex-column justify-content-center'>
                                            <label class='fs-6 fw-semibold d-block''>" . htmlspecialchars($job->jobtype) . "</label>
                                            <label class='d-block fw-bold'>" . htmlspecialchars($job->updated) . "</label>
                                        </div>
                                    </a>
                                    ";
                                }
                            }
                            ?>

                            <?php
                            $query = "SELECT * FROM jobs";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <a href='work_show.php' class='d-flex rounded p-2 mt-2 cursor-pointer custom-class-card-hightlight'>
                                        <div class='col-6 ps-2'>
                                            <label class='fs-4 fw-normal d-block'>" . htmlspecialchars($row['job_position']) . "</label>
                                            <label class='fs-6 fw-semibold d-block cursor-pointer'>" . htmlspecialchars($row['company_name']) . "</label>
                                        </div>
                                        <div class='col-3'>
                                            <label class='fs-6 fw-medium'></label>
                                        </div>
                                        <div class='col-3 text-end pe-2 d-flex flex-column justify-content-center'>
                                            <label class='fs-6 fw-semibold d-block'>" . htmlspecialchars($row['job_type']) . "</label>
                                            <label class='d-block fw-bold'>" . htmlspecialchars($row['updated_at']) . "</label>
                                        </div>
                                    </a>
                                    ";
                                }
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2"> </div>
    </div>
<?php endif ?>

<?php include('footer.php') ?>
