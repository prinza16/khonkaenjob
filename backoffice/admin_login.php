<?php
session_start(); 

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    unset($_SESSION['username']);
    header("Location: admin_login.php");
    exit();
}
?>
<?php include('./h.php'); ?>
<?php
if (isset($_SESSION['error'])) {
    echo "<p class='text-center' style='color:red;z-index: 1000;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card col-lg-5 col-md-10 col-sm-10 col-10" style="border-radius: 20px; height: 50%;">
            <div class="card-body d-flex justify-content-center align-items-center">
                <form action="admin_login_db.php" method="post" class="col-12">
                    <div class="container text-center">
                        <label class="fs-1 fw-bold">Login</label>
                    </div>
                    <div class="container my-3">
                        <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="container my-3">
                        <label for="password" class="fs-5 fw-bolder" style="color: #64748b;">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="container my-3">
                        <button type="submit" name="admin_login" class="btn btn-primary container fw-bold">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include('./footer.php'); ?>