<?php 
    session_start(); 
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>
<?php include('h.php'); ?>
<?php include('navbar.php'); ?>
<?php
if (isset($_SESSION['error'])) {
    echo "<p class='text-center' style='color:red;z-index: 1000;'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>
<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card col-lg-5 col-md-10 col-sm-10 col-10" style="border-radius: 20px; height: 50%;">
        <div class="card-body d-flex justify-content-center align-items-center">
            <form action="login_db.php" method="post" class="col-12">
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
                    <button type="submit" name="login" class="btn btn-custom-login container fw-bold">Login</button>
                </div>
                <div class="container my-3 text-end">
                    <label>Forgot <a href="#">Password?</a></label>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>