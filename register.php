<?php
session_name('user_session');
session_start();
include('condb.php');
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include('h.php'); ?>
<?php include('navbar.php'); ?>
<?php
$url = "https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json";

$jsonData = file_get_contents($url);

$data = json_decode($jsonData);
?>

<div class="d-flex justify-content-center align-items-center my-5">
    <div class="card container" style="border-radius: 20px;border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
        <div class="card-body d-flex justify-content-center align-items-center">
            <form class="col-lg-12" action="register_db.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="province_name" id="province_name">
                <input type="hidden" name="amphure_name" id="amphure_name">
                <input type="hidden" name="tambon_name" id="tambon_name">
                <div class="container text-center">
                    <label class="fs-2 fw-semibold">สมัครสมาชิก</label>
                </div>
                <div class="container my-3">
                    <label for="username" class="fs-5 fw-medium mb-3" style="color: #64748b;">ยูสเซอร์เนม (ใช้สำหรับเข้าสู่ระบบ)</label>
                    <input type="text" class="form-control" name="username" id="username" required>
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
                    <label for="companyname" class="fs-5 fw-medium mb-3" style="color: #64748b;">ชื่อบริษัท</label>
                    <input type="text" class="form-control" name="companyname" id="companyname" required>
                </div>
                <div class="container my-3">
                    <label for="business_type" class="fs-5 fw-medium mb-3" style="color: #64748b;">ประเภทธุรกิจ</label>
                    <select class="form-select" id="business_type" name="business_type">
                        <option selected disabled value="">--กรุณาเลือกประเภทธุรกิจ--</option>
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
                <div class="container my-3">
                    <label for="contactname" class="fs-5 fw-medium mb-3" style="color: #64748b;">ชื่อผู้ติดต่อ</label>
                    <input type="text" class="form-control" name="contactname" id="contactname" required>
                </div>
                <div class="container my-3">
                    <label for="company_address" class="fs-5 fw-medium mb-3" style="color: #64748b;">ที่อยู่บริษัท</label>
                    <textarea class="form-control" id="company_address" name="company_address" rows="3"></textarea>
                </div>
                <div class="container my-3">
                    <label for="province" class="fs-5 fw-medium mb-3" style="color: #64748b;">จังหวัด</label>
                    <select class="form-select" id="province" name="province" required>
                        <option selected disabled value="">จังหวัด</option>
                        <?php foreach ($data as $province): ?>
                            <option value="<?php echo $province->id; ?>"><?php echo $province->name_th; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="container my-3">
                    <label for="amphure" class="fs-5 fw-medium mb-3" style="color: #64748b;">อำเภอ/เขต</label>
                    <select class="form-select" id="amphure" name="amphure" required>
                        <option selected disabled value="">อำเภอ/เขต</option>
                    </select>
                </div>
                <div class="container my-3">
                    <label for="tambon" class="fs-5 fw-medium mb-3" style="color: #64748b;">ตำบล/แขวง</label>
                    <select class="form-select" id="tambon" name="tambon" required>
                        <option selected disabled value="">ตำบล/แขวง</option>
                    </select>
                </div>
                <div class="container my-3">
                    <label for="zipcode" class="fs-5 fw-medium mb-3" style="color: #64748b;">รหัสไปรษณีย์</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcode" required readonly>
                </div>
                <div class="container my-3">
                    <label for="company_tel" class="fs-5 fw-medium mb-3" style="color: #64748b;">เบอร์โทร</label>
                    <input type="text" class="form-control" name="company_tel" id="company_tel" required>
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

<script>
    let provinces = <?php echo json_encode($data); ?>;

    document.getElementById('province').addEventListener('change', function() {
        let provinceId = this.value;
        let amphureSelect = document.getElementById('amphure');
        let tambonSelect = document.getElementById('tambon');
        let zipcodeInput = document.getElementById('zipcode');

        amphureSelect.innerHTML = '<option selected disabled value="">อำเภอ/เขต</option>';
        tambonSelect.innerHTML = '<option selected disabled value="">ตำบล/แขวง</option>';
        zipcodeInput.value = '';

        let selectedProvince = provinces.find(p => p.id == provinceId);
        if (selectedProvince) {
            // เก็บชื่อจังหวัดใน hidden input สำหรับส่งค่า
            document.getElementById('province_name').value = selectedProvince.name_th;

            selectedProvince.amphure.forEach(amphure => {
                let option = document.createElement('option');
                option.value = amphure.id;
                option.textContent = amphure.name_th;
                amphureSelect.appendChild(option);
            });
        }
    });

    document.getElementById('amphure').addEventListener('change', function() {
        let amphureId = this.value;
        let tambonSelect = document.getElementById('tambon');
        let zipcodeInput = document.getElementById('zipcode');

        tambonSelect.innerHTML = '<option selected disabled value="">ตำบล/แขวง</option>';
        zipcodeInput.value = '';

        let selectedProvince = provinces.find(p => p.amphure.some(a => a.id == amphureId));
        if (selectedProvince) {
            let selectedAmphure = selectedProvince.amphure.find(a => a.id == amphureId);
            if (selectedAmphure) {
                // เก็บชื่ออำเภอใน hidden input สำหรับส่งค่า
                document.getElementById('amphure_name').value = selectedAmphure.name_th;

                selectedAmphure.tambon.forEach(tambon => {
                    let option = document.createElement('option');
                    option.value = tambon.id;
                    option.textContent = tambon.name_th;
                    tambonSelect.appendChild(option);
                });
            }
        }
    });

    document.getElementById('tambon').addEventListener('change', function() {
        let tambonId = this.value;
        let zipcodeInput = document.getElementById('zipcode');

        let selectedProvince = provinces.find(p => p.amphure.some(a => a.tambon.some(t => t.id == tambonId)));
        if (selectedProvince) {
            let selectedAmphure = selectedProvince.amphure.find(a => a.tambon.some(t => t.id == tambonId));
            if (selectedAmphure) {
                let selectedTambon = selectedAmphure.tambon.find(t => t.id == tambonId);
                if (selectedTambon) {
                    // เก็บชื่อตำบลใน hidden input สำหรับส่งค่า
                    document.getElementById('tambon_name').value = selectedTambon.name_th;

                    // เก็บรหัสไปรษณีย์ใน input
                    zipcodeInput.value = selectedTambon.zip_code;
                }
            }
        }
    });
</script>

<?php include('footer.php'); ?>