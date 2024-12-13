<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="border-radius: 20px; width: 30%;">
        <div class="card-body d-flex justify-content-center align-items-center">
            <form class="col-12" action="register_db.php" method="POST" enctype="multipart/form-data">
                <div class="container text-center">
                    <label class="fs-1 fw-bold">Register</label>
                </div>
                <div class="container my-3">
                    <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Fullname</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="container my-3">
                <label for="username" class="fs-5 fw-bolder" style="color: #64748b;">Confirm password</label>
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