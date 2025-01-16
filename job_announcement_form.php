<?php
include('h.php');
session_name('user_session');
session_start();
include('condb.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT users.*,
                     business_types.business_type_name
              FROM users
              INNER JOIN business_types ON users.business_type = business_types.business_type_id
              WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $job_id = $row['job_id'];
            $contact_name = $row['contact_name'];
            $company_name = $row['company_name'];
            $company_address = $row['company_address'];
            $province = $row['province'];
            $amphure = $row['amphure'];
            $tambon = $row['tambon'];
            $zipcode = $row['zipcode'];
            $company_tel = $row['company_tel'];
            $email = $row['email'];
            $business_type = $row['business_type_name'];
            $business_result = $row['business_type'];
            $email = $row['email'];
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<?php include('navbar.php') ?>
<div class="d-flex py-4">
    <div class="col-lg-2">
        <p></p>
    </div>
    <div class="col-lg-8">
        <div class="card border-0">
            <div class="card-body rounded px-5" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
                <form class="row g-3" action="job_announcement_form_db.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="job_status" value="2">

                    <h3 class="fw-medium py-4" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รับสมัครพนักงาน</h3>

                    <div class="col-lg-12 col-md-12">
                        <h5 for="company_name" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ชื่อบริษัท</h5>
                        <input type="text" class="form-control" id="company_name" name="company_name" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_name; ?>" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="company_logo" class="form-label fw-bold" style="color: #64748b;">Logo</h5>
                        <input class="form-control" type="file" id="company_logo" name="company_logo">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="business_type" class="form-label fw-medium fs-5">ประเภทธุรกิจ</label>
                        <select class="form-select" id="business_type" name="business_type" disabled required>
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
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รายละเอียดงาน</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="job_position" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ตำแหน่งงาน</label>
                            <input type="text" class="form-control" id="job_position" name="job_position" required />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4 mt-1">
                            <label for="acceptance_rate" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อัตราที่รับ</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="acceptance_rate" name="acceptance_rate" required />
                                <span class="input-group-text">คน</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="work_format" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รูปแบบงาน</label>
                            <select class="form-select" id="work_format" name="work_format" required>
                                <option selected disabled value="">--กรุณาเลือกรูปแบบงาน--</option>
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
                            <select class="form-select" id="type_of_work" name="type_of_work" required>
                                <option selected disabled value="">--กรุณาเลือกรูปแบบงาน--</option>
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
                            <input type="text" class="form-control" id="workplace" name="workplace" style="background:#E9ECEF;cursor: auto;" value="<?php echo $amphure . " " . $province; ?>" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="salary" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เงินเดือน</label>
                            <div class="input-group">
                                <select class="form-select" id="salary" name="salary" required>
                                    <option selected disabled value="">--กรุณาเลือกเงินเดือน--</option>
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
                        <textarea class="form-control" id="duty" name="duty" rows="4" required></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">คุณสมบัติที่ต้องการ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="gender" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เพศ</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">เพศ</option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="ไม่ระบุเพศ">ไม่ระบุเพศ</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="age" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;" >อายุ</label>
                                <input type="text" class="form-control" id="age" name="age" required />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="education" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">วุฒิการศึกษา</label>
                            <input type="text" class="form-control" id="education" name="education" required />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_abilities" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ความสามารถที่ต้องการ</label>
                            <textarea class="form-control" id="required_abilities" name="required_abilities" rows="4" required></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_experience" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประสบการณ์ที่ต้องการ</label>
                            <input type="text" class="form-control" id="required_experience" name="required_experience" required />
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <h5 for="benefit" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สวัสดิการ</h5>
                        <textarea class="form-control" id="benefit" name="benefit" rows="4"></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สมัครงานติดต่อ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel_name" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ชื่อผู้ติดต่อ</label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" style="background:#E9ECEF;cursor: auto;" value="<?php echo $contact_name; ?>" readonly />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทร</label>
                            <input type="tel" class="form-control" id="tel" name="tel" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="email" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" style="background:#E9ECEF;cursor: auto;" value="<?php echo $email; ?>" readonly />
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 mb-3">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ข้อมูลติดต่อบริษัท</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_address" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ที่อยู่บริษัท</label>
                            <textarea class="form-control" id="company_address" name="company_address" style="background:#E9ECEF;cursor: auto;" rows="4" readonly><?php echo $company_address . " " . $tambon . " " . $amphure . " " . $province . " " . $zipcode; ?></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทรบริษัท</label>
                            <input type="text" class="form-control" id="company_tel" name="company_tel" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_tel; ?>" readonly />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4 ">
                            <label for="company_website" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เว็บไซต์ของบริษัท</label>
                            <input type="text" class="form-control" id="company_website" name="company_website" />
                        </div>
                    </div>

                    <div class="row d-flex container">
                        <button class="btn btn-sm btn-primary fw-medium px-3 col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="font-family: 'Kanit', sans-serif !important;" name="hiring" type="submit">บันทึก</button>
                        <button class="btn btn-sm btn-light fw-medium px-3 col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="color: #334155;font-family: 'Kanit', sans-serif !important;" name="hiring" type="button" onclick="window.history.back()">กลับ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2"> </div>
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