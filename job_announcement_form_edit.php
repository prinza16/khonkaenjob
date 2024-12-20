<?php

session_start();
include('condb.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user_id'])) {
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
            INNER JOIN business_types ON jobs.business_type = business_types.business_type_id)
            WHERE user_id = $user_id";
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
    }
}

?>

<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex py-4">
    <div class="col-lg-2">
        <p></p>
    </div>
    <div class="col-lg-8">
        <div class="card border-0">
            <div class="card-body rounded px-5" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                <form class="row g-3" action="job_announcement_form_db.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                    <h3 class="fw-medium py-4" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รับสมัครพนักงาน</h3>

                    <div class="col-lg-12 col-md-12">
                        <h5 for="company_name" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ชื่อบริษัท</h5>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>" />
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="logo_company" class="form-label fw-bold" style="color: #64748b;">Logo</h5>
                        <input class="form-control" type="file" id="logo_company" name="logo_company">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="business_type" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประเภทธุรกิจ</h5>
                        <select class="form-select" id="business_type" name="business_type">
                                <option selected disabled value="<?php echo $business_type; ?>"><?php echo $business_type; ?></option>
                                <?php
                                $business_types_sql = "SELECT * FROM business_types";
                                $business_types_result = $conn->query($business_types_sql);

                                if ($business_types_result->num_rows > 0) {
                                    $business_types = [];
                                    while ($business_types_row = $business_types_result->fetch_assoc()) {
                                        $business_types[] = $business_types_row;
                                    }
                                } else {
                                    echo "ไม่พบข้อมูลประเภทงาน";
                                }
                                foreach ($business_types as $businesstypes) {
                                    echo "<option value='" . $businesstypes['business_type_id'] . "'>" . $businesstypes['business_type_name'] . "</option>";
                                }
                                ?>
                            </select>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รายละเอียดงาน</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="job_position" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ตำแหน่งงาน</label>
                            <input type="text" class="form-control" id="job_position" name="job_position" value="<?php echo $job_position; ?>" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4 mt-1">
                            <label for="acceptance_rate" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อัตราที่รับ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="acceptance_rate" name="acceptance_rate" value="<?php echo $acceptance_rate; ?>" />
                                <span class="input-group-text">คน</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="work_format" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รูปแบบงาน</label>
                            <select class="form-select" id="work_format" name="work_format">
                                <option selected disabled value="<?php echo $work_format; ?>"><?php echo $work_format; ?></option>
                                <?php
                                $work_formats_sql = "SELECT * FROM work_formats";
                                $work_formats_result = $conn->query($work_formats_sql);

                                if ($work_formats_result->num_rows > 0) {
                                    $work_formats = [];
                                    while ($work_formats_row = $work_formats_result->fetch_assoc()) {
                                        $work_formats[] = $work_formats_row;
                                    }
                                } else {
                                    echo "ไม่พบข้อมูลประเภทงาน";
                                }
                                foreach ($work_formats as $workformat) {
                                    echo "<option value='" . $workformat['work_formats_id'] . "'>" . $workformat['work_format_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="type_of_work" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประเภทงาน</label>
                            <select class="form-select" id="type_of_work" name="type_of_work">
                                <option selected disabled value="<?php echo $type_of_work; ?>"><?php echo $type_of_work; ?></option>
                                <?php
                                $types_of_work_sql = "SELECT * FROM types_of_work";
                                $types_of_work_result = $conn->query($types_of_work_sql);

                                if ($types_of_work_result->num_rows > 0) {
                                    $types_of_work = [];
                                    while ($types_of_work_row = $types_of_work_result->fetch_assoc()) {
                                        $types_of_work[] = $types_of_work_row;
                                    }
                                } else {
                                    echo "ไม่พบข้อมูลประเภทงาน";
                                }
                                foreach ($types_of_work as $typeswork) {
                                    echo "<option value='" . $typeswork['types_of_work_id'] . "'>" . $typeswork['type_of_work_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="workplace" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สถานที่ปฏิบัติงาน</label>
                            <input type="text" class="form-control" id="workplace" name="workplace"  value="<?php echo $workplace; ?>" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="salary" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เงินเดือน</label>
                            <div class="input-group">
                                <select class="form-select" id="salary" name="salary">
                                    <option selected disabled value="<?php echo $salary; ?>"><?php echo $salary; ?></option>
                                    <?php
                                    $salarys_sql = "SELECT * FROM salarys";
                                    $salarys_result = $conn->query($salarys_sql);

                                    if ($salarys_result->num_rows > 0) {
                                        $salarys = [];
                                        while ($salarys_row = $salarys_result->fetch_assoc()) {
                                            $salarys[] = $salarys_row;
                                        }
                                    } else {
                                        echo "ไม่พบข้อมูลประเภทงาน";
                                    }
                                    foreach ($salarys as $salarys_db) {
                                        echo "<option value='" . $salarys_db['salary_id'] . "'>" . $salarys_db['salary_data'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <span class="input-group-text">บาท</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <h5 for="duty" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">หน้าที่ความรับผิดชอบ</h5>
                        <textarea class="form-control" id="duty" name="duty" rows="4" value="<?php echo $duty; ?>"><?php echo $duty; ?></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">คุณสมบัติที่ต้องการ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="gender" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เพศ</label>
                            <select class="form-select" id="gender" name="gender">
                                <option selected disabled value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="ไม่ระบุเพศ">ไม่ระบุเพศ</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="age" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อายุ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>" />
                                <span class="input-group-text">ปี</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="education" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">วุฒิการศึกษา</label>
                            <input type="text" class="form-control" id="education" name="education" value="<?php echo $education; ?>" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_abilities" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ความสามารถที่ต้องการ</label>
                            <textarea class="form-control" id="required_abilities" name="required_abilities" rows="4" value="<?php echo $required_abilities; ?>"><?php echo $required_abilities; ?></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_experience" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประสบการณ์ที่ต้องการ</label>
                            <input type="text" class="form-control" id="required_experience" name="required_experience" value="<?php echo $required_experience; ?>"/>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <h5 for="benefit" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สวัสดิการ</h5>
                        <textarea class="form-control" id="benefit" name="benefit" rows="4" value="<?php echo $benefit; ?>"><?php echo $benefit; ?></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สมัครงานติดต่อ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel_name" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ชื่อผู้ติดต่อ</label>
                            <input type="text" class="form-control" id="tel_name" name="tel_name" value="<?php echo $tel_name; ?>"/>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทร</label>
                            <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $tel; ?>" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="email" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 mb-3">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ข้อมูลติดต่อบริษัท</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_address" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ที่อยู่บริษัท</label>
                            <textarea class="form-control" id="company_address" name="company_address" rows="4" value="<?php echo $company_address; ?>"><?php echo $company_address; ?></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทรบริษัท</label>
                            <input type="text" class="form-control" id="company_tel" name="company_tel" value="<?php echo $company_tel; ?>"/>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4 ">
                            <label for="company_website" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เว็บไซต์ของบริษัท</label>
                            <input type="text" class="form-control" id="company_website" name="company_website" value="<?php echo $company_website; ?>"/>
                        </div>
                    </div>

                    <div class="container text-end">
                        <button class="btn-lg btn btn-primary fw-bold me-3" style="width: 10vw;" name="update" type="submit">Update</button>
                        <button class="btn-lg btn btn-light fw-bold" style="color: #334155;width: 10vw;" name="hiring" type="submit">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2"> </div>
</div>

<?php include('footer.php'); ?>