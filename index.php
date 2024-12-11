<?php
include('rss_url_connect.php');
?>
<?php include('h.php') ?>
<?php include('navbar.php') ?>

<?php if (isset($_SESSION['username'])) : ?>
    <div class="d-flex py-4">
        <div class="col-lg-2">
            <p></p>
        </div>
        <div class="col-lg-8">
            <div class="text-end mb-3">
                <a class="btn btn-primary px-5 py-3 fw-bolder" href="job_announcement_form.php">ลงประกาศรับสมัครงาน</a>
            </div>
            <div class="card border-0">
                <div class="card-body rounded" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                    <form class="d-block" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-custom-search container-fluid mt-3 fw-semibold" type="button">Search</button>
                        <div class="mt-3">
                            <?php
                            foreach ($rss->job as $job) {
                                if (stripos($job->region, 'Chonburi') !== false) {
                                    echo "
                                    <a href='" . htmlspecialchars($job->link) . "' target='_blank' class='d-flex bg-white rounded p-2 mt-2 cursor-pointer custom-class-card-hightlight' 
                                    style='text-decoration: none; color: inherit;border: 1px solid #E0E0E0;'>
                                        <div class='col-6 ps-2'>
                                            <label class='fs-4 fw-normal d-block' style='cursor: pointer;' style='color:#333333;'>" . htmlspecialchars($job->name) . "</label>
                                            <label class='fs-6 fw-semibold d-block cursor-pointer' style='color:#b3bebe;cursor: pointer;'>" . htmlspecialchars($job->company) . "</label>
                                        </div>
                                        <div class='col-3'>
                                            <label class='fs-6 fw-medium' style='color:#9E9E9E;cursor: pointer;'>" . htmlspecialchars($job->region) . "</label>
                                        </div>
                                        <div class='col-3 text-end pe-2 d-flex flex-column justify-content-center'>
                                            <label class='fs-6 fw-semibold d-block' style='color:#9E9E9E;cursor: pointer;'>" . htmlspecialchars($job->jobtype) . "</label>
                                            <label class='d-block' style='cursor: pointer;'>" . htmlspecialchars($job->updated) . "</label>
                                        </div>

                                    </a>
                                ";
                                }
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