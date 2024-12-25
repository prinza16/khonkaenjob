<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center my-5">
    <div class="card card-width-custom" style="border-radius: 20px;">
        <div class="card-body d-flex justify-content-center align-items-center">
            <form class="col-12" action="register_db.php" method="POST" enctype="multipart/form-data">
                <div class="container text-center">
                    <label class="fs-1 fw-bold">Register</label>
                </div>
                <div class="image_profile">
                    <div class="wrapper-custom">
                        <input type="file" class="image_profile_custom" name="profile_image" id="profile_image" onchange="previewProfileImage(event)">
                    </div>
                </div>
                <div class="container my-3">
                    <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="container my-3">
                    <label for="fullname" class="fs-5 fw-bolder" style="color: #64748b;">Fullname</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="container my-3">
                    <label for="email" class="fs-5 fw-bolder" style="color: #64748b;">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="container my-3">
                    <label for="password" class="fs-5 fw-bolder" style="color: #64748b;">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="container my-3">
                    <label for="c_password" class="fs-5 fw-bolder" style="color: #64748b;">Confirm password</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" required>
                </div>
                <div class="container my-3">
                    <button type="submit" name="register" class="btn btn-custom-login container fw-bold">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
    function previewProfileImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var wrapper = document.querySelector('.wrapper-custom');
            wrapper.style.backgroundImage = "url('" + reader.result + "')";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .card-width-custom {
        width: 30%;
    }

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
</style>