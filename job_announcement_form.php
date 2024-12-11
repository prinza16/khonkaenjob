<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center">
<form class="col-12" action="" method="POST">
                <div class="container text-center">
                    <label class="fs-1 fw-bold">Register</label>
                </div>
                <div class="container my-3">
                    <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">ตำแหน่งงาน</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">จังหวัด</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">ประเภทงาน</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">ประเภทหน่อยงาน</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">รายละเอียด เช่น คุณสมบัติ เงินเดือน สวัสดิการ</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">ช่องทางการสมัคร ระบุอีเมล หรือเว็บไซต์</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">เงินเดือน/ค่าตอบแทน</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">หน่วยเงินเดือน</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">ชื่อหน่วยงาน</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">เว็บไซต์/เพจ</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">รายละเอียดหน่อยงาน</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">โทรศัพท์</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">โลโก้/รูปภาพ</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <div class="container my-3">
                    <button type="submit" name="register"  class="btn btn-custom-login container fw-bold">Register</button>
                </div>
            </form>
</div>

<?php include('footer.php'); ?>