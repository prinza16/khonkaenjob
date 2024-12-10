<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="border-radius: 20px; width: 30%; height: 50%;">
            <div class="card-body d-flex justify-content-center align-items-center">
                <form action="login_db.php" method="post" class="col-12">
                    <div class="container text-center">
                        <label class="fs-1 fw-bold">Login</label>
                    </div>
                    <div class="container my-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                    </div>
                    <div class="container my-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                    </div>
                    <div class="container my-3">
                        <button type="submit" name="login" class="btn btn-custom-login container fw-bold">Login</button>
                    </div>
                    <div class="container my-3 text-end">
                        <label>Forgot <a href="#">Password?</a></label>
                    </div>
                    <div class="container my-3 text-end">
                        <label>Don't have an account? <a href="register.php">Register</a></label>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>