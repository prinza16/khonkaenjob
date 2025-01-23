<?php
session_name('user_session');
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
    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1">
        <p></p>
    </div>
    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
        <div class="row mb-3 d-flex align-items-center"">
            <label class="col-lg-6 col-md-6 col-sm-6 col-12 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i><?php echo $company; ?></label>
            <h6 class="col-lg-6 col-md-6 col-sm-6 col-12 text-lg-end text-md-end text-sm-end text-start"><?php echo $pubdate; ?></h6>
        </div>
        <div class="card rounded-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-md-0 mb-sm-3">
                        <img width="200px" height="200px" class="rounded-4" style="object-fit: cover;box-shadow: 0 0 10px #e2e8f0;border: 2px solid #e2e8f0;" src="uploads/<?php echo $company_logo; ?>" alt="Company Logo" />
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 mb-md-4 mb-1" style="align-content: end;">
                        <div>
                            <label class="fs-2 fw-medium"><?php echo $company; ?></label>
                        </div>
                        <!-- <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-3 col-4">
                                <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-9 col-8"><label class="fs-5 fw-normal"><?php echo $business_type; ?></label></div>
                        </div> -->
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
                        <!-- <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">อัตราที่รับ :</label></div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $acceptance_rate; ?></label></div>
                        </div> -->
                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">รูปแบบงาน :</label></div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $jobtype; ?></label></div>
                        </div>
                        <!-- <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">ประเภทงาน :</label></div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $type_of_work; ?></label></div>
                        </div> -->
                        <!-- <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">สถานที่ปฏิบัติงาน :</label></div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-6 fw-normal"><?php echo $workplace; ?></label></div>
                        </div> -->
                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5"><label class="fs-6 fw-bolder">เงินเดือน(บาท) :</label></div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7"><label class="fs-3 fw-normal"><?php echo $salary; ?></label></div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="fs-4 fw-medium mb-2">หน้าที่ความรับผิดชอบ</label>
                        <div><label class="fs-6 fw-normal"> <?php echo $duty; ?> </label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-sm-3 mb-1">
                        <label class="fs-4 fw-medium">คุณสมบัติ</label>
                        <div>
                            <label class="fs-6 fw-normal">
                                <?php echo $qualifications; ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label class="fs-4 fw-medium">สวัสดิการ</label>
                        <div>
                            <label class="fs-6 fw-normal">
                                <?php echo $benefit; ?>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <label class="fs-4 fw-medium bg-light container mb-3">สมัครงานติดต่อ</label>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-4"><label class="fs-6 fw-bolder">ชื่อผู้ติดต่อ :</label></div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-8"><label class="fs-6 fw-normal"><?php echo $tel_name; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-4"><label class="fs-6 fw-bolder">เบอร์โทร :</label></div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-8"><label class="fs-6 fw-normal"><?php echo $phone; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-4"><label class="fs-6 fw-bolder">อีเมล :</label></div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-8"><label class="fs-6 fw-normal"><?php echo $email; ?></label></div>
                    </div>
                </div>
                <!-- <hr>
                <div>
                    <label class="fs-4 fw-medium bg-light container mb-3">ข้อมูลติดต่อบริษัท</label>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-12"><label class="fs-6 fw-bolder">ที่อยู่บริษัท :</label></div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-12"><label class="fs-6 fw-normal"><?php echo $company_address; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-5"><label class="fs-6 fw-bolder">เบอร์โทรบริษัท :</label></div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-7"><label class="fs-6 fw-normal"><?php echo $company_tel; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-12"><label class="fs-6 fw-bolder">เว็บไซต์ของบริษัท :</label></div>
                        <div class="col-lg-10 col-md-9 col-sm-8 col-12"><label class="fs-6 fw-normal"><?php echo $company_website; ?></label></div>
                    </div>
                </div> -->
                <hr>
                <div class="row d-flex container">
                    <button class="btn btn-sm btn-primary fw-medium px-3 col-xxl-1 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="font-family: 'Kanit', sans-serif !important;" onclick="window.open('<?php echo $apply_url; ?>', '_blank')">สมัครงาน</button>
                    <button class="btn btn-sm btn-light fw-medium px-3 col-xxl-1 col-xl-2 col-lg-2 col-md-3 col-sm-5 col-5 mx-1" style="font-family: 'Kanit', sans-serif !important;" onclick="window.history.back()">กลับ</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1"></div>
</div>

<?php

include('footer.php');
?>