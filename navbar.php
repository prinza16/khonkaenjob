<?php
session_start();
include('h.php');
include('condb.php');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $fullname = $row['fullname'];
            $email = $row['email'];
            $image_profile = $row['image_profile'];
        } else {
            echo "No user found.";
        }
    }

    mysqli_stmt_close($stmt);
}
?>
<nav class="navbar navbar-expand-lg px-5" style="box-shadow: 0 .125rem .25rem rgba(2,6,23,.075);padding: .5rem;background: #ffffff;">
    <div class="container-fluid">
        <a class="navbar-brand text-black" href="#"><label>Navbar</label></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item btn-custom-navbar-menu">
                    <?php
                    $activeClass = (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '';
                    ?>
                    <a class="nav-link <?php echo $activeClass; ?> text-custom-navbar-menu fs-6 fw-bold" aria-current="page" href="index.php"><label style="cursor:pointer;">Home</label></a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li class="nav-item d-flex align-items-center p-1 btn btn-light me-2">
                            <img src="profile/' . $image_profile . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                            <a class="nav-link fw-semibold" href="profile_account.php" style="color:#64748b">' . $fullname . '</a>
                            </li>
                            <li class="nav-item btn btn-light">
                                <a class="nav-link fw-semibold" href="index.php?logout=true"><span>Logout</span></a>   
                            </li>
                            ';
                } else {
                    echo '
                            <li class="nav-item">
                                <a class="nav-link btn-custom-login-navbar fs-6 fw-bold me-3 px-3" href="login.php">Login</a>
                            </li>
                        ';
                    echo '
                            <li class="nav-item">
                                <a class="nav-link btn-custom-register-navbar fs-6 fw-bold px-3" data-bs-toggle="modal" data-bs-target="#Modal_register" style="cursor:pointer;">Register</a>
                            </li>
                        ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="Modal_register" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <div class="container text-center">
            <label class="modal-title text-white fs-4 fw-medium" >สมัครสมาชิก</label>
        </div>
        <button type="button" class="fa-solid fa-xmark text-white fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <div class="pb-3">
                        <label class="fw-medium fs-5"><i class="fa-regular fa-circle-user me-2 fa-lg fw-bold"></i>ผู้สมัครงาน</label>
                    </div>
                    <div>
                        <a href="register_applicants.php" class="btn btn-primary container">สมัครงาน</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="pb-3">
                        <label class="fw-medium fs-5"><i class="fa-regular fa-circle-user me-2 fa-lg fw-bold"></i>ผู้ประกอบการ</label>
                    </div>
                    <div>
                        <a href="register_applicants.php" class="btn btn-primary container">สมัครงาน</a>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>