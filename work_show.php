<?php
session_start();
include('condb.php');
include('h.php');
include('navbar.php');

if (isset($_GET['job_id'])) {
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
            WHERE job_id = $job_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $company_name = $row['company_name'];
        $company_address = $row['company_address'];
        $company_tel = $row['company_tel'];
        $company_website = $row['company_website'];
        $business_type = $row['business_type_name'];
        $job_position = $row['job_position'];
        $acceptance_rate = $row['acceptance_rate'];
        $work_format = $row['work_format_name'];
        $type_of_work = $row['type_of_work_name'];
        $workplace = $row['workplace'];
        $salary = $row['salary_data'];
        $duty = $row['duty'];
        $gender = $row['gender'];
        $age = $row['age'];
        $education = $row['education'];
        $required_abilities = $row['required_abilities'];
        $required_experience = $row['required_experience'];
        $benefit = $row['benefit'];
        $tel_name = $row['tel_name'];
        $tel = $row['tel'];
        $email = $row['email'];
        $create_date = $row['create_date'];
        $post_date = $row['post_date'];
        $expiry_date = $row['expiry_date'];
        $updated_at = $row['updated_at'];
        $job_status = $row['job_status'];
        $company_logo = $row['company_logo'];

?>

        <div class="d-flex py-4">
            <div class="col-lg-2">
                <p></p>
            </div>
            <div class="col-lg-8">
                <div class="row mb-3">
                    <label class="col-lg-6 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i><?php echo $company_name; ?></label>
                    <h6 class="col-lg-6 text-end"><?php echo $post_date; ?></h6>
                </div>
                <div class="card rounded-4">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <img width="200px" height="200px" class="rounded-4" style="object-fit: cover;" src="<?php echo $company_logo; ?>" alt="Company Logo" />
                            </div>
                            <div class="col-lg-9 mb-4" style="align-content: end;">
                                <div>
                                    <label class="fs-2 fw-medium"><?php echo $company_name; ?></label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                                    </div>
                                    <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $business_type; ?></label></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="fs-3 fw-medium mb-2">รายละเอียดงาน</label>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">ตำแหน่งงาน :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $job_position; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">อัตราที่รับ :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $acceptance_rate; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">รูปแบบงาน :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $work_format; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">ประเภทงาน :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $type_of_work; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">สถานที่ปฏิบัติงาน :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $workplace; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4"><label class="fs-5 fw-normal">เงินเดือน(บาท) :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $salary; ?></label></div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="fs-3 fw-medium mb-2">หน้าที่ความรับผิดชอบ</label>
                                <div><label class="fs-5 fw-normal"> <?php echo $duty; ?> </label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="fs-3 fw-medium mb-2">คุณสมบัติ</label>
                                <div class="row mb-1">
                                    <div class="col-lg-5"><label class="fs-5 fw-normal">เพศ :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $gender; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-5"><label class="fs-5 fw-normal">อายุ :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $age; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-5"><label class="fs-5 fw-normal">วุฒิการศึกษา :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $education; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-5"><label class="fs-5 fw-normal">ความสามารถที่ต้องการ :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $required_abilities; ?></label></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-5"><label class="fs-5 fw-normal">ประสบการณ์ที่ต้องการ :</label></div>
                                    <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $required_experience; ?></label></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="fs-3 fw-medium">สวัสดิการ</label>
                                <div>
                                    <label class="fs-5 fw-normal">
                                        <?php echo $benefit; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <label class="fs-3 fw-medium bg-light container mb-3">สมัครงานติดต่อ</label>
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
                            <label class="fs-3 fw-medium bg-light container mb-3">ข้อมูลติดต่อบริษัท</label>
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
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>

<?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Job ID not provided.";
}

include('footer.php');
?>