<?php include('./h.php'); ?>
<?php

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

?>
<?php include('./navbar.php'); ?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Jobpost</label>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="employers.php">Jobpost</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Job not approve</li>
                </ol>
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
             AND jobs.job_status = 3";

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
<?php include('footer.php'); ?>