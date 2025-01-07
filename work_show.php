<?php
session_start();
include('condb.php');
include('h.php');
include('navbar.php');

if (isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    $query = "SELECT jobs.*,  
                     work_formats.work_format_name, 
                     types_of_work.type_of_work_name,
                     salarys.salary_data,
                     business_types.business_type_name
            FROM ((((jobs
            INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id)
            INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id)
            INNER JOIN salarys ON jobs.salary = salarys.salary_id)
            INNER JOIN business_types ON jobs.business_type = business_types.business_type_id)
            WHERE job_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $job_id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $company_name = $row['company_name'] ?? 'ไม่ระบุ';
                $company_address = $row['company_address'] ?? 'ไม่ระบุ';
                $company_tel = $row['company_tel'] ?? 'ไม่ระบุ';
                $company_website = $row['company_website'] ?? 'ไม่ระบุ';
                $business_type = $row['business_type_name'] ?? 'ไม่ระบุ';
                $job_position = $row['job_position'] ?? 'ไม่ระบุ';
                $acceptance_rate = $row['acceptance_rate'] ?? 'ไม่ระบุ';
                $work_format = $row['work_format_name'] ?? 'ไม่ระบุ';
                $type_of_work = $row['type_of_work_name'] ?? 'ไม่ระบุ';
                $workplace = $row['workplace'] ?? 'ไม่ระบุ';
                $salary = $row['salary_data'] ?? 'ไม่ระบุ';
                $duty = $row['duty'] ?? 'ไม่ระบุ';
                $gender = $row['gender'] ?? 'ไม่ระบุ';
                $age = $row['age'] ?? 'ไม่ระบุ';
                $education = $row['education'] ?? 'ไม่ระบุ';
                $required_abilities = $row['required_abilities'] ?? 'ไม่ระบุ';
                $required_experience = $row['required_experience'] ?? 'ไม่ระบุ';
                $benefit = $row['benefit'] ?? 'ไม่ระบุ';
                $tel_name = $row['tel_name'] ?? 'ไม่ระบุ';
                $tel = $row['tel'] ?? 'ไม่ระบุ';
                $email = $row['email'] ?? 'ไม่ระบุ';
                $create_date = $row['create_date'] ?? 'ไม่ระบุ';
                $post_date = $row['post_date'] ?? 'ไม่ระบุ';
                $expiry_date = $row['expiry_date'] ?? 'ไม่ระบุ';
                $updated_at = $row['updated_at'] ?? 'ไม่ระบุ';
                $job_status = $row['job_status'] ?? 'ไม่ระบุ';
                $company_logo = $row['company_logo'] ?? 'default_logo.png';
            } else {
                echo "No data found";
            }
        } else {
            echo "Error executing statement: " . mysqli_error($conn);
        }
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid job_id";
}

?>

        <div class="d-flex py-4">
            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1">
                <p></p>
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                <div class="row mb-3 d-flex align-items-center">
                    <label class="col-lg-6 col-md-6 col-sm-6 col-12 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i><?php echo $company_name; ?></label>
                    <h6 class="col-lg-6 col-md-6 col-sm-6 col-12 text-lg-end text-md-end text-sm-end text-start"><?php echo $post_date; ?></h6>
                </div>
                <div class="card rounded-4">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-md-0 mb-sm-3">
                                <img width="200px" height="200px" class="rounded-4" style="object-fit: cover;box-shadow: 0 0 10px #e2e8f0;border: 2px solid #e2e8f0;" src="uploads/<?php echo $company_logo; ?>" alt="Company Logo" />
                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 mb-md-4 mb-1" style="align-content: end;">
                                <div>
                                    <label class="fs-2 fw-medium"><?php echo $company_name; ?></label>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-3 col-4">
                                        <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                                    </div>
                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-9 col-8"><label class="fs-5 fw-normal"><?php echo $business_type; ?></label></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="fs-4 fw-medium mb-2">รายละเอียดงาน</label>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">ตำแหน่งงาน :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $job_position; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">อัตราที่รับ :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $acceptance_rate; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">รูปแบบงาน :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $work_format; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">ประเภทงาน :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $type_of_work; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">สถานที่ปฏิบัติงาน :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $workplace; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">เงินเดือน(บาท) :</label></div>
                                    <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $salary; ?></label></div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="fs-4 fw-medium mb-2">หน้าที่ความรับผิดชอบ</label>
                                <div><label class="fs-6 fw-normal"> <?php echo $duty; ?> </label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <label class="fs-4 fw-medium mb-2">คุณสมบัติ</label>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">เพศ :</label></div>
                                    <div class="col-xxl-8 col-xl-9 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $gender; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">อายุ :</label></div>
                                    <div class="col-xxl-8 col-xl-9 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $age; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">วุฒิการศึกษา :</label></div>
                                    <div class="col-xxl-8 col-xl-9 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $education; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-4 col-sm-5 col-5"><label class="fs-6 fw-bolder">ความสามารถที่ต้องการ :</label></div>
                                    <div class="col-xxl-8 col-xl-9 col-lg-9 col-md-8 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $required_abilities; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-4 col-sm-5 col-5"><label class="fs-6 fw-bolder">ประสบการณ์ที่ต้องการ :</label></div>
                                    <div class="col-xxl-8 col-xl-9 col-lg-9 col-md-8 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $required_experience; ?></label></div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label class="fs-4 fw-medium">สวัสดิการ</label>
                                <div>
                                    <label class="fs-5 fw-normal">
                                        <?php echo $benefit; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <label class="fs-4 fw-medium bg-light container mb-3">สมัครงานติดต่อ</label>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">ชื่อผู้ติดต่อ :</label></div>
                                <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $tel_name; ?></label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">เบอร์โทร :</label></div>
                                <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $tel; ?></label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">อีเมล :</label></div>
                                <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $email; ?></label></div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <label class="fs-4 fw-medium bg-light container mb-3">ข้อมูลติดต่อบริษัท</label>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">ที่อยู่บริษัท :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $company_address; ?></label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">เบอร์โทรบริษัท :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $company_tel; ?></label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-2"><label class="fs-5 fw-normal">เว็บไซต์ของบริษัท :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $company_website; ?></label></div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button class="btn btn-lg btn-light fw-medium px-5" style="font-family: 'Kanit', sans-serif !important;" onclick="window.history.back()">กลับ</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1"></div>
        </div>

<?php

include('footer.php');
?>