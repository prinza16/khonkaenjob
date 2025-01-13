<?php
include('h.php');
session_start();
include('condb.php');

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $contact_name = $_POST['contact_name'];
    $email = $_POST['email'];

    $query = "UPDATE users
            SET contact_name = ?,
                email = ?
            WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $contact_name, $email, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: profile_account.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing statement: " . mysqli_error($conn);
    }
}
?>
<?php include('navbar.php') ?>


<?php if (isset($_SESSION['username'])) : ?>
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include('menu_left_profile.php') ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="card-body rounded px-5">
                    <form name="update_profile" method="post" enctype="multipart/form-data" class="height-content-profile_account">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
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
                            <div class="card-body p-5 row">
                                <label class="mb-1 fs-3 fw-bolder col-12">Account Information</label>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="contact_name" class="fs-5 fw-normal" style="color: #64748b;">ชื่อ</label>
                                    <input type="text" name="contact_name" class="form-control" value="<?php echo $contact_name; ?>">
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="email" class="fs-5 fw-normal" style="color: #64748b;">อีเมล</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="company_name" class="fs-5 fw-normal" style="color: #64748b;">ชื่อบริษัท</label>
                                    <input type="text" name="company_name" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_name; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="business_type" class="fs-5 fw-normal" style="color: #64748b;">ประเภทธุรกิจ</label>
                                    <input type="text" name="business_type" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $business_type; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="company_address" class="fs-5 fw-normal" style="color: #64748b;">ที่อยู่บริษัท</label>
                                    <input type="text" name="company_address" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $company_address; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="tambon" class="fs-5 fw-normal" style="color: #64748b;">ตำบล/แขวง</label>
                                    <input type="text" name="tambon" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $tambon; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="amphure" class="fs-5 fw-normal" style="color: #64748b;">อำเภอ/เขต</label>
                                    <input type="text" name="amphure" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $amphure; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="province" class="fs-5 fw-normal" style="color: #64748b;">จังหวัด</label>
                                    <input type="text" name="province" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $province; ?>" readonly>
                                </div>
                                <div class="col-lg-6 col-md-12 mb-1">
                                    <label for="zipcode" class="fs-5 fw-normal" style="color: #64748b;">รหัสไปรษณีย์</label>
                                    <input type="text" name="zipcode" class="form-control" style="background:#E9ECEF;cursor: auto;" value="<?php echo $zipcode; ?>" readonly>
                                </div>
                                <div class="col-12 mt-4">
                                    <button name="update" class="btn btn-lg btn-primary me-2 fw-bolder" type="submit" style="font-family: 'Kanit', sans-serif !important;">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include('footer.php') ?>