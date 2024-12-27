<?php
session_start();
include('condb.php');
include('h.php');
include('navbar.php');
include('rss_url_connect.php');

if (isset($_GET['id'])) {
    var_dump($_GET);
    exit;
    $job_id = $_GET['id'];
    $link = isset($_GET['link']) ? htmlspecialchars($_GET['link'], ENT_QUOTES, 'UTF-8') : '';
    $name = isset($_GET['name']) ? htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') : '';
    $region = isset($_GET['region']) ? htmlspecialchars($_GET['region'], ENT_QUOTES, 'UTF-8') : '';
    $salary = isset($_GET['salary']) ? htmlspecialchars($_GET['salary'], ENT_QUOTES, 'UTF-8') : '';
    $description = isset($_GET['description']) ? htmlspecialchars($_GET['description'], ENT_QUOTES, 'UTF-8') : '';
    $qualifications = isset($_GET['qualifications']) ? htmlspecialchars($_GET['qualifications'], ENT_QUOTES, 'UTF-8') : '';
    $apply_url = isset($_GET['apply_url']) ? htmlspecialchars($_GET['apply_url'], ENT_QUOTES, 'UTF-8') : '';
    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8') : '';
    $phone = isset($_GET['phone']) ? htmlspecialchars($_GET['phone'], ENT_QUOTES, 'UTF-8') : '';
    $company = isset($_GET['company']) ? htmlspecialchars($_GET['company'], ENT_QUOTES, 'UTF-8') : '';
    $pubdate = isset($_GET['pubdate']) ? htmlspecialchars($_GET['pubdate'], ENT_QUOTES, 'UTF-8') : '';
    $updated = isset($_GET['updated']) ? htmlspecialchars($_GET['updated'], ENT_QUOTES, 'UTF-8') : '';
    $expire = isset($_GET['expire']) ? htmlspecialchars($_GET['expire'], ENT_QUOTES, 'UTF-8') : '';
    $jobtype = isset($_GET['jobtype']) ? htmlspecialchars($_GET['jobtype'], ENT_QUOTES, 'UTF-8') : '';
} else {

    echo "Job ID not found.";
}

?>

<div class="d-flex py-4">
    <div class="col-lg-2">
        <p></p>
    </div>
    <div class="col-lg-8">
        <div class="row mb-3">
            <label class="col-lg-6 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i><?php echo $company; ?></label>
            <h6 class="col-lg-6 text-end"><?php echo $pubdate; ?></h6>
        </div>
        <div class="card rounded-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-3">
                        <img width="200px" height="200px" class="rounded-4" style="object-fit: cover;box-shadow: 0 0 10px #e2e8f0;border: 2px solid #e2e8f0;" src="uploads/<?php echo $company_logo; ?>" alt="Company Logo" />
                    </div>
                    <div class="col-lg-9 mb-4" style="align-content: end;">
                        <div>
                            <label class="fs-2 fw-medium"><?php echo $company; ?></label>
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
                <div>
                    <button class="btn btn-lg btn-primary fw-medium px-5" style="font-family: 'Kanit', sans-serif !important;">สมัครงาน</button>
                    <button class="btn btn-lg btn-light fw-medium px-5" style="font-family: 'Kanit', sans-serif !important;" onclick="window.history.back()">กลับ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>

<?php

include('footer.php');
?>