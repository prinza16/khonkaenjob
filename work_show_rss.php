<?php
session_start();
include('condb.php');
include('h.php');
include('navbar.php');
include('rss_url_connect.php');

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    $query = "//job[@id='" . htmlspecialchars($job_id) . "']";

    $item = $rss->xpath($query);
    if (!empty($item)) {
        $item = $item[0];

        $company = htmlspecialchars($item->company);
        $job_position = htmlspecialchars($item->name);
        $duty = htmlspecialchars($item->description);
        $qualifications = htmlspecialchars($item->qualifications);
        $email = htmlspecialchars($item->email);
        $phone = htmlspecialchars($item->phone);
        $salary = htmlspecialchars($item->salary);
        $region = htmlspecialchars($item->region);
        $apply_url = htmlspecialchars($item->apply_url);
        $pubdate = htmlspecialchars($item->pubdate);
        $update = htmlspecialchars($item->update);
        $expire = htmlspecialchars($item->expire);
        $jobtype = htmlspecialchars($item->jobtype);
    } else {
        echo 'ไม่พบรายการที่มี id: ' . htmlspecialchars($job_id);
    }
} else {
    echo 'Job ID not found.';
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
                        <!-- <div class="row">
                            <div class="col-lg-2">
                                <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                            </div>
                            <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $business_type; ?></label></div>
                        </div> -->
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
                        <!-- <div class="row mb-1">
                            <div class="col-lg-4"><label class="fs-5 fw-normal">อัตราที่รับ :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $acceptance_rate; ?></label></div>
                        </div> -->
                        <div class="row mb-1">
                            <div class="col-lg-4"><label class="fs-5 fw-normal">รูปแบบงาน :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $jobtype; ?></label></div>
                        </div>
                        <!-- <div class="row mb-1">
                            <div class="col-lg-4"><label class="fs-5 fw-normal">ประเภทงาน :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $type_of_work; ?></label></div>
                        </div> -->
                        <!-- <div class="row mb-1">
                            <div class="col-lg-4"><label class="fs-5 fw-normal">สถานที่ปฏิบัติงาน :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal"><?php echo $workplace; ?></label></div>
                        </div> -->
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
                        <label class="fs-3 fw-medium">คุณสมบัติ</label>
                        <div>
                            <label class="fs-5 fw-normal">
                                <?php echo $qualifications; ?>
                            </label>
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
                        <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $phone; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-2"><label class="fs-5 fw-normal">อีเมล :</label></div>
                        <div class="col-lg-10"><label class="fs-5 fw-normal"><?php echo $email; ?></label></div>
                    </div>
                </div>
                <!-- <hr>
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
                </div> -->
                <hr>
                <div>
                    <button class="btn btn-lg btn-primary fw-medium px-5" style="font-family: 'Kanit', sans-serif !important;" onclick="window.location.href='<?php echo $apply_url; ?>'">สมัครงาน</button>
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