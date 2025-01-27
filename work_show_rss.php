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

        $company_logo_url = getCompanyLogo($apply_url);
        if ($company_logo_url) {
            $company_logo = $company_logo_url;
        } else {
            $company_logo = 'uploads/noicon.png';
        }

        $contact_details = getContactDetails($apply_url);

        if ($contact_details) {
            $tel_name = $contact_details[6] ?? 'ไม่มีข้อมูล';
        } else {
            $tel_name = 'ไม่มีข้อมูล';
        }

        $business_data = getBusinessType($apply_url);

        if ($business_data) {
            $business_type = $business_data[0]['name'] ?? 'ไม่มีข้อมูล';
        } else {
            $business_type = 'ไม่มีข้อมูล';
        }

        $aboutcompany_data = getAboutcompany($apply_url);

        if ($aboutcompany_data) {
            $aboutcompany_name = $aboutcompany_data[0]['name'] ?? 'ไม่มีข้อมูล';
        } else {
            $aboutcompany_name = 'ไม่มีข้อมูล';
        }

        $job_details = getJobDetails($apply_url);

        if ($job_details) {
            $job_position = $job_details['job_title'] ?? 'ไม่มีข้อมูล';
            $acceptance_rate = $job_details['vacancy_count'] ?? 'ไม่มีข้อมูล';
            $jobtype = $job_details['job_type'] ?? 'ไม่มีข้อมูล';
            $type_of_work = $job_details['job_category'] ?? 'ไม่มีข้อมูล';
            $workplace = $job_details['job_location'] ?? 'ไม่มีข้อมูล';
            $salary = $job_details['salary'] ?? 'ไม่มีข้อมูล';
        } else {
            $job_position = $acceptance_rate = $jobtype = $type_of_work = $workplace = $salary = 'ไม่มีข้อมูล';
        }

        $li_texts = getLiTextFromSecList($apply_url);

        if ($li_texts) {

            $company_tel = array_filter($li_texts, function ($item) {
                return preg_match('/Tel\s*:\s*/', $item);
            });

            if (is_array($company_tel) && !empty($company_tel)) {
                $clean_tel = 'Tel: ' . preg_replace('/Tel\s*:\s*/', '', trim(reset($company_tel)));

                $tel_position = array_search(trim(reset($company_tel)), $li_texts);

                if ($tel_position !== false) {
                    $new_position = $tel_position - 1;

                    if ($new_position >= 0 && $new_position < count($li_texts)) {
                        $company_address = $li_texts[$new_position];
                        $company_tel = $clean_tel;
                    }
                }
            } else {
                $company_tel = ''; // ถ้าไม่พบข้อมูล Tel ให้ตั้งค่าตัวแปร $company_tel เป็นค่าว่าง
            }

            $company_website = array_filter($li_texts, function ($item) {
                return preg_match('/Website\s*:\s*/', $item);
            });

            if (is_array($company_website) && !empty($company_website)) {
                $company_website = 'Website: ' . preg_replace('/Website\s*:\s*/', '', trim(reset($company_website)));
            } else {
                $company_website = ''; // ถ้าไม่มีข้อมูลให้ตั้งเป็นค่าว่าง
            }

            // ค้นหาข้อมูล Facebook
            $company_facebook = array_filter($li_texts, function ($item) {
                return preg_match('/Facebook\s*.*(?:Fanpage)?\s*.*:/', $item);
            });

            if (is_array($company_facebook) && !empty($company_facebook)) {
                $company_facebook = 'Facebook: ' . preg_replace('/Facebook\s*.*(?:Fanpage)?\s*.*:/', '', trim(reset($company_facebook)));
            } else {
                $company_facebook = ''; // ถ้าไม่มีข้อมูล Facebook ก็ให้เป็นค่าว่าง
            }

            // ค้นหาข้อมูล Line
            $company_line = array_filter($li_texts, function ($item) {
                return preg_match('/Line\s*.*:\s*/', $item);
            });

            if (is_array($company_line) && !empty($company_line)) {
                $company_line = 'Line: ' . preg_replace('/Line\s*.*:\s*/', '', trim(reset($company_line)));
            } else {
                $company_line = ''; // ถ้าไม่มีข้อมูล Line ก็ให้เป็นค่าว่าง
            }
        } else {
            $company_tel = $company_website = $company_facebook = $company_line = '';
        }
    } else {
        echo 'ไม่พบรายการที่มี id: ' . htmlspecialchars($job_id);
    }

    $benefits = getBenefits($apply_url);

    if ($benefits) {
        $benefit = $benefits[1] ?? 'ไม่มีข้อมูล';
    } else {
        $benefit = 'ไม่มีข้อมูล';
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
            <label class=" col-lg-6 col-md-6 col-sm-6 col-12 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i><?php echo $company; ?></label>
            <h6 class="col-lg-6 col-md-6 col-sm-6 col-12 text-lg-end text-md-end text-sm-end text-start"><?php echo $pubdate; ?></h6>
        </div>
        <div class="card rounded-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-md-0 mb-sm-3">
                        <img width="200px" height="200px" class="rounded-4" style="object-fit: contain; box-shadow: 0 0 10px #e2e8f0; border: 2px solid #e2e8f0;" src="<?php echo $company_logo; ?>" alt="Company Logo" />
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12 mb-md-4 mb-1" style="align-content: end;">
                        <div>
                            <label class="fs-2 fw-medium"><?php echo $company; ?></label>
                        </div>
                        <div class="row">
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-3 col-4">
                                <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                            </div>
                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8 col-sm-9 col-8"><label class="fs-5 fw-normal"><?php echo $business_type; ?></label></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12"><label class="fs-6 fw-normal"><?php echo $aboutcompany_name; ?></label></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label class="fs-4 fw-medium mb-2">รายละเอียดงาน</label>
                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">ตำแหน่งงาน :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $job_position; ?></label>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">อัตราที่รับ :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $acceptance_rate; ?></label>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">รูปแบบงาน :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $jobtype; ?></label>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">ประเภทงาน :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $type_of_work; ?></label>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">สถานที่ปฏิบัติงาน :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $workplace; ?></label>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xxl-4 col-xl-2 col-lg-3 col-md-3 col-sm-5 col-5">
                                <label class="fs-6 fw-bolder">เงินเดือน(บาท) :</label>
                            </div>
                            <div class="col-xxl-8 col-xl-10 col-lg-9 col-md-9 col-sm-7 col-7">
                                <label class="fs-6 fw-normal"><?php echo $salary; ?></label>
                            </div>
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
                <hr>
                <div>
                    <label class="fs-4 fw-medium bg-light container mb-3">ข้อมูลติดต่อบริษัท</label>
                    <div class="row mb-1">
                        <div class="col-lg-10 col-md-10 col-sm-8 col-12"><label class="fs-6 fw-normal"><?php echo $company; ?></label></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-10 col-md-10 col-sm-8 col-12"><label class="fs-6 fw-normal"><?php echo $company_address; ?></label></div>
                    </div>
                    <?php if ($company_tel): ?>
                        <div class="row mb-1">
                            <div class="col-lg-10 col-md-9 col-sm-8 col-12">
                                <label class="fs-6 fw-normal"><?php echo $company_tel; ?></label>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($company_website): ?>
                        <div class="row mb-1">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-12">
                                <a href="<?php echo $company_website; ?>" class="fs-6 fw-normal"><?php echo $company_website; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($company_facebook)): ?>
                        <div class="row mb-1">
                            <div class="col-lg-10 col-md-9 col-sm-8 col-12">
                                <a href="<?php echo $company_facebook; ?>" class="fs-6 fw-normal"><?php echo $company_facebook; ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($company_line)): ?>
                        <div class="row mb-1">
                            <div class="col-lg-10 col-md-9 col-sm-8 col-12">
                                <label class="fs-6 fw-normal"><?php echo $company_line; ?></label>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
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