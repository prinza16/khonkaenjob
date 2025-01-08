<?php 
    session_start(); 
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>
<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center my-5">
    <div class="card container" style="border-radius: 20px;border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
        <div class="card-body d-flex justify-content-center align-items-center" >
            <form class="col-lg-12" action="register_db.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="role" value="user">
                <div class="container text-center">
                    <label class="fs-2 fw-semibold">สมัครสมาชิก</label>
                </div>
                <div class="container my-3">
                    <label for="username" class="fs-5 fw-medium mb-3" style="color: #64748b;">ยูสเซอร์เนม (ใช้สำหรับเข้าสู่ระบบ)</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="container my-3">
                    <label for="fullname" class="fs-5 fw-medium mb-3" style="color: #64748b;">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="container my-3">
                    <label for="password" class="fs-5 fw-medium mb-3" style="color: #64748b;">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="container my-3">
                    <label for="c_password" class="fs-5 fw-medium mb-3" style="color: #64748b;">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <div class="container my-3">
                    <label for="email" class="fs-5 fw-medium mb-3" style="color: #64748b;">อีเมล</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="container my-3 text-center">
                    <button type="submit" name="register" class="btn btn-lg btn-custom-login fw-medium"><label class="text-white" style="cursor: pointer;">ลงทะเบียน</label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>