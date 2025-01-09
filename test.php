<div class="col-lg-9 col-md-8">
    <div class="card border-0">
        <div class="card-body rounded px-5" style="border: 1px solid #E0E0E0;box-shadow: 0px 15px 15px rgba(224, 224, 224, 1);">
            <form name="update_profile" action="profile_account.php" method="post" enctype="multipart/form-data" class="height-content-profile_account">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT users.*, 
                                        business_types.business_type_name
                                    FROM users
                                    INNER JOIN business_types ON users.business_type = business_types.business_type_id
                                    WHERE users.user_id = ?;";

                    if ($stmt = mysqli_prepare($conn, $query)) {
                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                        mysqli_stmt_execute($stmt);

                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $contact_name = $row['contact_name'];
                            $email = $row['email'];
                            $company_name = $row['company_name'];
                            $business_type = $row['business_type_name'];
                            $company_address = $row['company_address'];
                            $province = $row['province'];
                            $amphure = $row['amphure'];
                            $tambon = $row['tambon'];
                            $zipcode = $row['zipcode'];
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error preparing statement: " . mysqli_error($conn);
                    }
                }
                ?>
                <label class="fw-semibold mb-4 fs-1">Profile</label>
                <div class="card rounded-3">
                    <div class="card-body p-5 shadow-sm">
                        <h4 class="mb-1">Account Information</h4>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="contact_name" class="fs-5 fw-bold" style="color: #64748b;">ชื่อ</label>
                            <input type="text" name="contact_name" class="form-control" value="<?php echo $contact_name; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="email" class="fs-5 fw-bold" style="color: #64748b;">อีเมล</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="company_name" class="fs-5 fw-bold" style="color: #64748b;">ชื่อบริษัท</label>
                            <input type="text" name="company_name" class="form-control" value="<?php echo $company_name; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="business_type" class="fs-5 fw-bold" style="color: #64748b;">ประเภทธุรกิจ</label>
                            <input type="text" name="business_type" class="form-control" value="<?php echo $business_type; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="company_address" class="fs-5 fw-bold" style="color: #64748b;">ที่อยู่บริษัท</label>
                            <input type="text" name="company_address" class="form-control" value="<?php echo $company_address; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="province" class="fs-5 fw-bold" style="color: #64748b;">จังหวัด</label>
                            <input type="text" name="province" class="form-control" value="<?php echo $province; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="amphure" class="fs-5 fw-bold" style="color: #64748b;">อำเภอ/เขต</label>
                            <input type="text" name="amphure" class="form-control" value="<?php echo $amphure; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="tambon" class="fs-5 fw-bold" style="color: #64748b;">ตำบล/แขวง</label>
                            <input type="text" name="tambon" class="form-control" value="<?php echo $tambon; ?>">
                        </div>
                        <div class="col-lg-6 col-md-12 mb-1">
                            <label for="zipcode" class="fs-5 fw-bold" style="color: #64748b;">รหัสไปรษณีย์</label>
                            <input type="text" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                        </div>
                        <div class="col-12 mt-4">
                            <button name="update" class="btn btn-primary me-2 fw-bold" type="submit">Save Change</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>