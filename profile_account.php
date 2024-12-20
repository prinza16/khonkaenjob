<?php
include('h.php');
session_start();
include('condb.php');

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $image_profile = $_FILES['image_profile'];

    $image_profile2 = $_POST['image_profile2'];
    $upload = $_FILES['image_profile']['name'];

    if ($upload != '') {
        $allow = array('jpg', 'jpeg', 'png');

        $extension = explode(".", $image_profile['name']);
        $fileActExt = strtolower(end($extension));

        $fileNew = $extension[0] . '.' . $fileActExt;
        $filePath = "profile/" . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($image_profile['size'] > 0 && $image_profile['error'] == 0) {
                move_uploaded_file($image_profile['tmp_name'], $filePath);
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    } else {
        $fileNew = $image_profile2;
    }

    $query = "UPDATE users 
          SET fullname = '$fullname',
              email = '$email',
              image_profile = '$fileNew'
          WHERE user_id = " . $_SESSION['user_id'] . " ";

    if (mysqli_query($conn, $query)) {
        header('location: profile.php');
    } else {
        echo "Error: " . mysqli_error($conn);
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
                <form name="update_profile" action="profile_account.php" method="post" enctype="multipart/form-data" class="height-content-profile_account">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];

                        $query = "SELECT * FROM users WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $fullname = $row['fullname'];
                            $email = $row['email'];
                            $image_profile = $row['image_profile'];
                        }
                    }
                    ?>
                    <label class="fw-semibold mb-4 fs-1">Profile</label>
                    <div class="card mb-4 rounded-3">
                        <div class="card-body p-5 shadow-sm">
                            <label class="fw-bold mb-4 fs-3">Profile Picture</label>
                            <div class="d-flex align-items-center">
                                <input type="hidden" value="<?php echo $user_id; ?>" required class="form-control" name="user_id">
                                <input type="hidden" value="<?php echo $image_profile; ?>" required class="form-control" name="image_profile2">
                                <div class="mb-3 d-flex align-items-center gap-3">
                                    <div class="wrapper-custom">
                                        <input type="file" class="image_profile_custom" id="imgInput" name="image_profile">
                                        <img src="profile/<?php echo $image_profile; ?>" id="previewImg" class="profile-img" alt="Profile Picture">
                                    </div>
                                    <label class="fs-4 fw-bold">Your Photo</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-3">
                        <div class="card-body p-5 shadow-sm">
                            <h4 class="mb-1">Account Information</h4>
                            <div class="col-lg-6 col-md-12 mb-1">
                                <label for="fullname" class="fs-5 fw-bold" style="color: #64748b;">Fullname</label>
                                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="email" class="fs-5 fw-bold" style="color: #64748b;">Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                            <div class="col-12 mt-4">
                                <button name="update" class="btn btn-primary me-2 fw-bold" type="submit">Save Change</button>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    let imgInput = document.getElementById('imgInput');
                    let previewImg = document.getElementById('previewImg');

                    imgInput.onchange = evt => {
                        const [file] = imgInput.files;
                        if (file) {
                            previewImg.src = URL.createObjectURL(file);
                        }
                    }
                </script>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <style>
                    .wrapper-custom {
                        height: 100px;
                        width: 100px;
                        position: relative;
                        border-radius: 50%;
                        background: url('profile/noprofile.jpg') no-repeat center center;
                        background-size: cover;
                        margin: 20px auto;
                        overflow: hidden;
                    }

                    .image_profile_custom {
                        position: absolute;
                        bottom: 0;
                        outline: none;
                        color: transparent;
                        width: 100%;
                        box-sizing: border-box;
                        padding: 0;
                        cursor: pointer;
                        transition: 0.5s;
                        background: rgba(0, 0, 0, 0.5);
                        opacity: 0;
                    }

                    .image_profile_custom::-webkit-file-upload-button {
                        visibility: hidden;
                    }

                    .image_profile_custom::before {
                        content: '\f030';
                        font-family: 'FontAwesome';
                        font-size: 20px;
                        color: #fff;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    }

                    .image_profile_custom:hover {
                        opacity: 1;
                    }

                    .profile-img {
                        object-fit: cover;
                        width: 100%;
                        height: 100%;
                    }

                    .height-content-profile_account {
                        height: 619px;
                    }
                </style>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include('footer.php') ?>