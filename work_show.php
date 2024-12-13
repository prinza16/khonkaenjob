<?php include('condb.php'); ?>
<?php include('h.php') ?>
<?php include('navbar.php') ?>

<?php if (isset($_SESSION['username'])) : ?>
    <div class="d-flex py-4">
        <div class="col-lg-2">
            <p></p>
        </div>
        <div class="col-lg-8">
            <div class="row mb-3">
                <label class="col-lg-6 fs-3 fw-bold"><i class="fa-solid fa-user me-3"></i>jlkfjdla</label>
                <h6 class="col-lg-6 text-end">fdsfdsfsd</h6>
            </div>
            <div class="card rounded-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <img width="200px" height="200px" class="rounded-4" style="object-fit: cover;" src="https://plus.unsplash.com/premium_photo-1661914978519-52a11fe159a7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bG9nb3xlbnwwfHwwfHx8MA%3D%3D" alt="">
                        </div>
                        <div class="col-lg-9 mb-4" style="align-content: end;">
                            <div><label class="fs-2 fw-medium">ชื่อบริษัท</label></div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="fs-5 fw-normal">ประเภทธุรกิจ:</label>
                                </div>
                                <div class="col-lg-10"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="fs-3 fw-medium mb-2">รายละเอียดงาน</label>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">ตำแหน่งงาน :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">อัตราที่รับ :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">อัตรา</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">รูปแบบงาน :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">พนักงานประจำ</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">ประเภทงาน :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">สถานที่ปฏิบัติงาน :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-4"><label class="fs-5 fw-normal">เงินเดือน(บาท) :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="fs-3 fw-medium mb-2">หน้าที่ความรับผิดชอบ</label>
                            <div>
                                <label class="fs-5 fw-normal">
                                    ttextedfdsaffa
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="fs-3 fw-medium mb-2">คุณสมบัติ</label>
                            <div class="row mb-1">
                                <div class="col-lg-5"><label class="fs-5 fw-normal">เพศ :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">ชาย</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-5"><label class="fs-5 fw-normal">อายุ :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">18 ปีขึ้นไป</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-5"><label class="fs-5 fw-normal">วุฒิการศึกษา :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-5"><label class="fs-5 fw-normal">ความสามารถที่ต้องการ :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">texttexttext</label></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-lg-5"><label class="fs-5 fw-normal">ประสบการณ์ที่ต้องการ :</label></div>
                                <div class="col-lg-6"><label class="fs-5 fw-normal">1-5ปี</label></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="fs-3 fw-medium">สวัสดิการ</label>
                            <div>
                                <label class="fs-5 fw-normal">
                                    ttextedfdsaffa
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <label class="fs-3 fw-medium bg-light container mb-3">สมัครงานติดต่อ</label>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">ชื่อผู้ติดต่อ :</label></div>
                            <div class="col-lg-10"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">เบอร์โทร :</label></div>
                            <div class="col-lg-10"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">อีเมล :</label></div>
                            <div class="col-lg-10"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <label class="fs-3 fw-medium bg-light container mb-3">ข้อมูลติดต่อบริษัท</label>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">ที่อยู่บริษัท :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">เบอร์โทรบริษัท :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-2"><label class="fs-5 fw-normal">เว็บไซต์ของบริษัท :</label></div>
                            <div class="col-lg-6"><label class="fs-5 fw-normal">texttext</label></div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <button class="btn btn-primary px-5 py-2" style="font-family: 'Kanit', sans-serif !important;">สมัคร</button>
                        <button class="btn btn-light px-5 py-2" style="font-family: 'Kanit', sans-serif !important;">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"> </div>
    </div>
<?php endif ?>
<script>
    var elements = document.querySelectorAll('label');

    elements.forEach(function(element) {
        var textContent = element.innerText || element.textContent;

        var hasThai = /[\u0E00-\u0E7F]/.test(textContent);

        if (hasThai) {
            element.classList.add('kanit-font');
        } else {
            element.classList.add('nunito-font');
        }
    });
</script>

<?php include('footer.php') ?>