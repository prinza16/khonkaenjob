<?php include('./h.php'); ?>
<?php include('./navbar.php'); ?>
<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$url = "https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province_with_amphure_tambon.json";
$jsonData = file_get_contents($url);
$data = json_decode($jsonData);

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $query = "SELECT users.*, business_types.*
                FROM users
                INNER JOIN business_types ON users.business_type = business_types.business_type_id
                WHERE users.user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $contact_name = $row['contact_name'];
            $email = $row['email'];
            $company_name = $row['company_name'];
            $business_type = $row['business_type_id'];
            $business_type_name = $row['business_type_name'];
            $company_address = $row['company_address'];
            $province = $row['province'];
            $amphure = $row['amphure'];
            $tambon = $row['tambon'];
            $zipcode = $row['zipcode'];
            $company_tel = $row['company_tel'];
        } else {
            echo "ไม่พบข้อมูลผู้ใช้";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include('./sidebarmenu.php') ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <label class="mt-4 fs-1 fw-bold">Employers</label>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="employers.php">Employers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employers edit</li>
                </ol>
                <hr>
                <form method="post" action="employers_edit_db.php" enctype="multipart/form-data" class="height-content-profile_account">
                    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="contact_name" class="fs-5 fw-normal" style="color: #64748b;">ชื่อ</label>
                            <input type="text" name="contact_name" class="form-control" value="<?php echo $contact_name ?>">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="email" class="fs-5 fw-normal" style="color: #64748b;">อีเมล</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="company_name" class="fs-5 fw-normal" style="color: #64748b;">ชื่อบริษัท</label>
                            <input type="text" name="company_name" class="form-control" value="<?php echo $company_name ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="business_type" class="fs-5 fw-medium" style="color: #64748b;">ประเภทธุรกิจ</label>
                            <select class="form-select" id="business_type" name="business_type">
                                <option selected value="<?php echo $business_type; ?>"><?php echo $business_type_name; ?></option>
                                <?php
                                $business_types_sql = "SELECT * FROM business_types";
                                $business_types_result = $conn->query($business_types_sql);
                                if ($business_types_result->num_rows > 0) {
                                    while ($business_types_row = $business_types_result->fetch_assoc()) {
                                        echo "<option value='" . $business_types_row['business_type_id'] . "'>" . $business_types_row['business_type_name'] . "</option>";
                                    }
                                } else {
                                    echo "ไม่พบข้อมูลประเภทงาน";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="company_address" class="fs-5 fw-normal" style="color: #64748b;">ที่อยู่บริษัท</label>
                            <input type="text" name="company_address" class="form-control" value="<?php echo $company_address ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="province" class="fs-5 fw-medium" style="color: #64748b;">จังหวัด</label>
                            <select class="form-select" id="province" name="province">
                                <option selected disabled value="">จังหวัด</option>
                                <?php foreach ($data as $provinceData): ?>
                                    <option value="<?php echo $provinceData->name_th; ?>" <?php echo ($provinceData->name_th == $province) ? 'selected' : ''; ?>>
                                        <?php echo $provinceData->name_th; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="amphure" class="fs-5 fw-medium" style="color: #64748b;">อำเภอ/เขต</label>
                            <select class="form-select" id="amphure" name="amphure">
                                <option selected disabled value="">อำเภอ/เขต</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="tambon" class="fs-5 fw-medium" style="color: #64748b;">ตำบล/แขวง</label>
                            <select class="form-select" id="tambon" name="tambon">
                                <option selected disabled value="">ตำบล/แขวง</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="zipcode" class="fs-5 fw-medium" style="color: #64748b;">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo $zipcode; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="company_tel" class="fs-5 fw-normal" style="color: #64748b;">เบอร์โทร</label>
                            <input type="text" name="company_tel" class="form-control" value="<?php echo $company_tel ?>">
                        </div>
                        <div class="col-12 mt-4">
                            <button name="update_user" class="btn btn-lg btn-primary me-2 fw-bolder" type="submit" style="font-family: 'Kanit', sans-serif !important;">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script>
    let provinces = <?php echo json_encode($data); ?>;

    document.getElementById('province').addEventListener('change', function() {
        let provinceName = this.value;
        let amphureSelect = document.getElementById('amphure');
        let tambonSelect = document.getElementById('tambon');
        let zipcodeInput = document.getElementById('zipcode');

        amphureSelect.innerHTML = '<option selected disabled value="">อำเภอ/เขต</option>';
        tambonSelect.innerHTML = '<option selected disabled value="">ตำบล/แขวง</option>';
        zipcodeInput.value = '';

        let selectedProvince = provinces.find(p => p.name_th == provinceName);
        if (selectedProvince) {
            selectedProvince.amphure.forEach(amphure => {
                let option = document.createElement('option');
                option.value = amphure.name_th;
                option.textContent = amphure.name_th;
                amphureSelect.appendChild(option);
            });

            selectedProvince.amphure.forEach(amphure => {
                if (amphure.name_th == '<?php echo $amphure; ?>') {
                    amphureSelect.value = amphure.name_th;
                    amphureSelect.dispatchEvent(new Event('change'));
                }
            });
        }
    });

    document.getElementById('amphure').addEventListener('change', function() {
        let amphureName = this.value;
        let tambonSelect = document.getElementById('tambon');
        let zipcodeInput = document.getElementById('zipcode');

        tambonSelect.innerHTML = '<option selected disabled value="">ตำบล/แขวง</option>';
        zipcodeInput.value = '';

        let selectedProvince = provinces.find(p => p.amphure.some(a => a.name_th == amphureName));
        if (selectedProvince) {
            let selectedAmphure = selectedProvince.amphure.find(a => a.name_th == amphureName);
            if (selectedAmphure) {
                selectedAmphure.tambon.forEach(tambon => {
                    let option = document.createElement('option');
                    option.value = tambon.name_th;
                    option.textContent = tambon.name_th;
                    tambonSelect.appendChild(option);

                    if (tambon.name_th == '<?php echo $tambon; ?>') {
                        tambonSelect.value = tambon.name_th;
                        tambonSelect.dispatchEvent(new Event('change'));
                    }
                });
            }
        }
    });

    document.getElementById('tambon').addEventListener('change', function() {
        let tambonName = this.value;
        let zipcodeInput = document.getElementById('zipcode');

        let selectedProvince = provinces.find(p => p.amphure.some(a => a.tambon.some(t => t.name_th == tambonName)));
        if (selectedProvince) {
            let selectedAmphure = selectedProvince.amphure.find(a => a.tambon.some(t => t.name_th == tambonName));
            if (selectedAmphure) {
                let selectedTambon = selectedAmphure.tambon.find(t => t.name_th == tambonName);
                if (selectedTambon) {
                    zipcodeInput.value = selectedTambon.zip_code;
                }
            }
        }
    });

    document.getElementById('province').dispatchEvent(new Event('change'));
</script>

<?php include('footer.php'); ?>
