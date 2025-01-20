<?php
include('h.php');
session_name('user_session');
session_start();
include('condb.php');

if (isset($_GET['logout'])) {
    session_name('user_session');
    session_start();
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT jobs.*, 
       work_formats.work_format_name, 
       types_of_work.type_of_work_name, 
       salarys.salary_data, 
       business_types.business_type_name,
       users.company_name,     
       users.contact_name,       
       users.company_address,  
       users.province,           
       users.amphure,      
       users.tambon,        
       users.zipcode,       
       users.company_tel, 
       users.email   
FROM ((((jobs
INNER JOIN work_formats ON jobs.work_format = work_formats.work_formats_id)
INNER JOIN types_of_work ON jobs.type_of_work = types_of_work.types_of_work_id)
INNER JOIN salarys ON jobs.salary = salarys.salary_id)
INNER JOIN users ON jobs.user_id = users.user_id)
INNER JOIN business_types ON users.business_type = business_types.business_type_id
WHERE job_id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $_GET['job_id']);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $job_id = $row['job_id'];
            $company_name = $row['company_name'];
            $company_address = $row['company_address'];
            $province = $row['province'];
            $amphure = $row['amphure'];
            $tambon = $row['tambon'];
            $zipcode = $row['zipcode'];
            $company_tel = $row['company_tel'];
            $company_website = $row['company_website'];
            $business_type = $row['business_type_name'];
            $business_result = $row['business_type'];
            $job_position = $row['job_position'];
            $acceptance_rate = $row['acceptance_rate'];
            $work_format = $row['work_format_name'];
            $work_result = $row['work_format'];
            $type_of_work = $row['type_of_work_name'];
            $type_of_result = $row['type_of_work'];
            $workplace = $row['workplace'];
            $salary = $row['salary_data'];
            $salary_result = $row['salary'];
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

        mysqli_stmt_close($stmt);
    }
}
?>
<?php include('navbar.php') ?>
<div class="container-fluid py-4 px-5">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <?php include('menu_left_profile.php') ?>
        </div>
        <div class="col-lg-9 col-md-8">
            <label class="fw-semibold mb-4 fs-1">Job Poster</label>
            <div class="card border-0">
                <div class="card-body rounded px-5" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                    <form class="row g-3" action="job_announcement_form_edit_db.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="job_id" value="<?php echo $_GET['job_id']; ?>">
                        <input type="hidden" name="job_status" value="2">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="fw-medium py-4 fs-3">รับสมัครพนักงาน</label>
                            <a href="delete.php?del=<?php echo $job_id; ?>&type=job" onclick="return confirmDelete()" class="btn-lg btn btn-light fw-bold" style="height: 60%;">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>

                        <div class="col-lg-12 col-md-12 row mt-2">
                            <div class="col-lg-6">
                                <img width="100%" src="uploads/<?php echo $company_logo; ?>" id="previewcompany_logo" style="border-radius: 10px 10px 0px 0px;height: 350px;object-fit: cover;">
                                <input type="file" class="form-control" id="company_logoInput" name="company_logo" style="border-radius: 0px 0px 10px 10px" />
                                <input type="hidden" value="<?php echo $company_logo; ?>" required class="form-control" name="company_logo2">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <label for="company_name" class="form-label fw-medium fs-5">ชื่อบริษัท</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_name; ?>" readonly />
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <label for="business_type" class="form-label fw-medium fs-5">ประเภทธุรกิจ</label>
                            <select class="form-select" id="business_type" name="business_type" disabled>
                                <option selected value="<?php echo $business_result; ?>"><?php echo $business_type; ?></option>
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
                            <label class="form-label fw-medium fs-5">รายละเอียดงาน</label>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="job_position" class="form-label fw-medium">ตำแหน่งงาน</label>
                                <input type="text" class="form-control" id="job_position" name="job_position" value="<?php echo $job_position; ?>" />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4 mt-1">
                                <label for="acceptance_rate" class="form-label fw-medium">อัตราที่รับ</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="acceptance_rate" name="acceptance_rate" value="<?php echo $acceptance_rate; ?>" />
                                    <span class="input-group-text">คน</span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="work_format" class="form-label fw-medium">รูปแบบงาน</label>
                                <select class="form-select" id="work_format" name="work_format">
                                    <option selected value="<?php echo $work_result; ?>"><?php echo $work_format; ?></option>
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
                                <label for="type_of_work" class="form-label fw-medium">ประเภทงาน</label>
                                <select class="form-select" id="type_of_work" name="type_of_work">
                                    <option selected value="<?php echo $type_of_result; ?>"><?php echo $type_of_work; ?></option>
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
                                <label for="workplace" class="form-label fw-medium">สถานที่ปฏิบัติงาน</label>
                                <input type="text" class="form-control" id="workplace" name="workplace" style="background:#E9ECEF;cursor: auto;" value="<?php echo $amphure . " " . $province; ?>" readonly />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="salary" class="form-label fw-medium">เงินเดือน</label>
                                <div class="input-group">
                                    <select class="form-select" id="salary" name="salary">
                                        <option selected value="<?php echo $salary_result; ?>"><?php echo $salary; ?></option>
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
                            <label for="duty" class="form-label fw-medium fs-5">หน้าที่ความรับผิดชอบ</label>
                            <textarea class="form-control" id="duty" name="duty" rows="4" value="<?php echo $duty; ?>"><?php echo $duty; ?></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label class="form-label fw-medium fs-5">คุณสมบัติที่ต้องการ</label>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="gender" class="form-label fw-medium">เพศ</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option selected value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    <option value="ไม่ระบุเพศ">ไม่ระบุเพศ</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="age" class="form-label fw-medium">อายุ</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>" />
                                    <span class="input-group-text">ปี</span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="education" class="form-label fw-medium">วุฒิการศึกษา</label>
                                <input type="text" class="form-control" id="education" name="education" value="<?php echo $education; ?>" />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="required_abilities" class="form-label fw-medium">ความสามารถที่ต้องการ</label>
                                <textarea class="form-control" id="required_abilities" name="required_abilities" rows="4" value="<?php echo $required_abilities; ?>"><?php echo $required_abilities; ?></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="required_experience" class="form-label fw-medium">ประสบการณ์ที่ต้องการ</label>
                                <input type="text" class="form-control" id="required_experience" name="required_experience" value="<?php echo $required_experience; ?>" />
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <label for="benefit" class="form-label fw-medium fs-5">สวัสดิการ</label>
                            <textarea class="form-control" id="benefit" name="benefit" rows="4" value="<?php echo $benefit; ?>"><?php echo $benefit; ?></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <label class="form-label fw-medium fs-5">สมัครงานติดต่อ</label>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="tel_name" class="form-label fw-medium">ชื่อผู้ติดต่อ</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" style="background:#E9ECEF;cursor: auto;" value="<?php echo $contact_name; ?>" readonly />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="tel" class="form-label fw-medium">เบอร์โทร</label>
                                <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $tel; ?>" />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="email" class="form-label fw-medium">อีเมล</label>
                                <input type="email" class="form-control" id="email" name="email" style="background:#E9ECEF;cursor: auto;" value="<?php echo $email; ?>" readonly />
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="form-label fw-medium fs-5">ข้อมูลติดต่อบริษัท</label>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="company_address" class="form-label fw-medium">ที่อยู่บริษัท</label>
                                <textarea class="form-control" id="company_address" name="company_address" style="background:#E9ECEF;cursor: auto;" rows="4" readonly><?php echo $company_address . " " . $tambon . " " . $amphure . " " . $province . " " . $zipcode; ?></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4">
                                <label for="company_tel" class="form-label fw-medium">เบอร์โทรบริษัท</label>
                                <input type="text" class="form-control" id="company_tel" name="company_tel" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_tel; ?>" readonly />
                            </div>
                            <div class="col-lg-12 col-md-12 ps-4 ">
                                <label for="company_website" class="form-label fw-medium">เว็บไซต์ของบริษัท</label>
                                <input type="text" class="form-control" id="company_website" name="company_website" value="<?php echo $company_website; ?>" />
                            </div>
                        </div>

                        <div class="row d-flex container">
                            <button class="btn btn-sm btn-primary fw-medium px-3 col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="font-family: 'Kanit', sans-serif !important;" name="update" type="submit">อัปเดต</button>
                            <button class="btn btn-sm btn-light fw-medium px-3 col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="color: #334155;font-family: 'Kanit', sans-serif !important;" type="button" onclick="window.history.back()">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let imgInput = document.getElementById('company_logoInput');
    let previewImg = document.getElementById('previewcompany_logo');

    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
        }
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>

<?php include('footer.php') ?>