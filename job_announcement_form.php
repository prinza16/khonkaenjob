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
                        <input type="text"
                            class="form-control"
                            id="company_name"
                            name="company_name" />
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="logo_company" class="form-label fw-bold" style="color: #64748b;">Logo</h5>
                        <input class="form-control" type="file" id="logo_company" name="logo_company">
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="business_type" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประเภทธุรกิจ</h5>
                        <input type="text"
                            class="form-control"
                            id="business_type"
                            name="business_type" />
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รายละเอียดงาน</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="job_position" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ตำแหน่งงาน</label>
                            <input type="text"
                                class="form-control"
                                id="job_position"
                                name="job_position" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="acceptance_rate" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อัตราที่รับ</label>
                            <input type="text"
                                class="form-control"
                                id="acceptance_rate"
                                name="acceptance_rate" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="work_format" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">รูปแบบงาน</label>
                            <select class="form-select" id="work_format" name="work_format" >
                                <option selected disabled value="">text</option>
                                <option value="1">Job 1</option>
                                <option value="2">Job 2</option>
                                <option value="3">Job 3</option>
                                <option value="4">Job 4</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="type_of_work" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประเภทงาน</label>
                            <input type="text"
                                class="form-control"
                                id="type_of_work"
                                name="type_of_work" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="workplace" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สถานที่ปฏิบัติงาน</label>
                            <input type="text"
                                class="form-control"
                                id="workplace"
                                name="workplace" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="salary" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เงินเดือน</label>
                            <input type="text"
                                class="form-control"
                                id="salary"
                                name="salary" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="duty" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">หน้าที่ความรับผิดชอบ</h5>
                        <textarea class="form-control"
                            id="duty"
                            name="duty"
                            rows="4"></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">คุณสมบัติที่ต้องการ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="gender" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เพศ</label>
                            <select class="form-select" id="gender" name="gender">
                                <option selected disabled value="">เพศ</option>
                                <option value="1">ชาย</option>
                                <option value="2">หญิง</option>
                                <option value="3">ไม่ระบุเพศ</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="age" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อายุ</label>
                            <input type="text"
                                class="form-control"
                                id="age"
                                name="age" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="education" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">วุฒิการศึกษา</label>
                            <input type="text"
                                class="form-control"
                                id="education"
                                name="education" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_abilities" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ความสามารถที่ต้องการ</label>
                            <textarea class="form-control"
                                id="required_abilities"
                                name="required_abilities"
                                rows="4"></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="required_experience" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ประสบการณ์ที่ต้องการ</label>
                            <input type="text"
                                class="form-control"
                                id="required_experience"
                                name="required_experience" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 for="benefit" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สวัสดิการ</h5>
                        <textarea class="form-control"
                            id="benefit"
                            name="benefit"
                            rows="4"></textarea>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">สมัครงานติดต่อ</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel_name" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ชื่อผู้ติดต่อ</label>
                            <input type="text"
                                class="form-control"
                                id="tel_name"
                                name="tel_name" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทร</label>
                            <input type="tel"
                                class="form-control"
                                id="tel"
                                name="tel" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="email" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">อีเมล</label>
                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 mb-3">
                        <h5 class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ข้อมูลติดต่อบริษัท</h5>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_address" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">ที่อยู่บริษัท</label>
                            <textarea class="form-control"
                                id="company_address"
                                name="company_address"
                                rows="4"></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4">
                            <label for="company_tel" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เบอร์โทรบริษัท</label>
                            <input type="text"
                                class="form-control"
                                id="company_tel"
                                name="company_tel" />
                        </div>
                        <div class="col-lg-12 col-md-12 ps-4 ">
                            <label for="company_website" class="form-label fw-medium" style="color: #64748b;font-family: 'Kanit', sans-serif !important;">เว็บไซต์ของบริษัท</label>
                            <input type="text"
                                class="form-control"
                                id="company_website"
                                name="company_website" />
                        </div>
                    </div>
                    <div class="container text-end">
                        <button class="btn-lg btn btn-primary fw-bold me-3" style="width: 10vw;" name="hiring" type="submit">Save</button>
                        <button class="btn-lg btn btn-light fw-bold" style="color: #334155;width: 10vw;" name="hiring" type="submit">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2"> </div>
</div>

<?php include('footer.php'); ?>