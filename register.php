<?php include('h.php'); ?>
<?php include('navbar.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="border-radius: 20px; width: 30%;">
        <div class="card-body d-flex justify-content-center align-items-center">
            <form class="col-12" action="register_db.php" method="POST">
                <div class="container text-center">
                    <label class="fs-1 fw-bold">Register</label>
                </div>
                <div class="container my-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                </div>
                <div class="container my-3">
                    <input type="text" class="form-control" placeholder="Fullname" name="fullname" id="fullname" required>
                </div>
                <div class="container my-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                </div>
                <div class="container my-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="container my-3">
                    <input type="password" class="form-control" placeholder="Confirm password" name="c_password" id="c_password" required>
                </div>
                <div class="container my-3">
                    <button type="submit" name="register" class="btn btn-custom-login container fw-bold">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>