<?php
include('h.php');
session_start();
include('condb.php');

?>
<?php include('navbar.php') ?>


<?php if (isset($_SESSION['username'])) : ?>
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include('menu_left_profile.php') ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <label class="fw-semibold mb-4 fs-1">Job Poster</label>
                <div class="card" style="height: 68vh;">
                    <div class="card-body">
                        <?php
                        $user_id = $_SESSION['user_id'];

                        $query = "SELECT jobs.*,  
                     work_formats.work_format_name, 
                     types_of_work.type_of_work_name,
                     salarys.salary_data,
                     business_types.business_type_name
            FROM ((((jobs
            INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id)
            INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id)
            INNER JOIN salarys ON jobs.salary = salarys.salary_id)
            INNER JOIN business_types ON jobs.business_type = business_types.business_type_id) WHERE user_id = ?";

                        if ($stmt = mysqli_prepare($conn, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $user_id);

                            mysqli_stmt_execute($stmt);

                            $result = mysqli_stmt_get_result($stmt);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "
                                    <a href='job_announcement_form_edit.php?job_id=" . $row['job_id'] . "' class='d-flex rounded p-2 mt-2 mx-1 cursor-pointer custom-class-card-hightlight row'>
                                        <div class='col-xxl-6 col-xl-7 col-lg-8 col-md-12 col-sm-12 col-12 ps-2'>
                                            <label class='fs-4 fw-normal d-block'>" . htmlspecialchars($row['job_position']) . "</label>
                                            <label class='fs-6 fw-semibold d-block cursor-pointer'>" . htmlspecialchars($row['company_name']) . "</label>
                                        </div>
                                        <div class='col-xxl-6 col-xl-5 col-lg-4 col-md-12 col-sm-12 col-12 text-lg-end text-md-start text-sm-start text-start d-flex flex-column justify-content-center px-2'>
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
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include('footer.php') ?>